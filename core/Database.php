<?php

namespace Core;

use Config\Config;
use Exception;
use PDO;
use PDOException;

class Database
{
    protected static $_db;
    protected $_results, $_class, $_error = false, $statement, $_lastInsertId, $_fetchType = PDO::FETCH_OBJ;
    protected int $_rowCount = 0;
    protected PDO $_dbHandler;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $host = Config::get('db_host');
        $db_name = Config::get('db_name');
        $db_user = Config::get('db_user');
        $db_pass = Config::get('db_password');
        $options = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];
        try {
            $this->_dbHandler = new PDO("mysql:host={$host};dbname={$db_name}", $db_user, $db_pass, $options);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @return Database|bool
     */
    public static function getInstance()
    {
        //Instantiate database if it hasn't been done already
        if (!self::$_db) {
            try {
                self::$_db = new self();
            } catch (Exception $exception) {
                Session::message($exception->getMessage(), "warning", "Database connection failed");
            }
        }
        if (self::$_db) return self::$_db;
        else return false;
    }

    /**
     * @param $sql
     * @param array $bind
     * @return $this
     * Function to execute select queries
     */
    public function query($sql, array $bind = []): Database
    {
        $this->execute($sql, $bind);
        if (!$this->_error) {
            $this->_rowCount = $this->statement->rowCount();
            if ($this->_fetchType == PDO::FETCH_CLASS) $this->_results = $this->statement->fetchAll($this->_fetchType, $this->_class);
            else {
                $this->_results = $this->statement->fetchAll($this->_fetchType);
            }
        }
        return $this;
    }

    /**
     * @param $sql
     * @param array $bind
     * @return $this
     * Returns the updated database connection object after executing the database statement
     */
    public function execute($sql, array $bind = []): Database
    {
        $this->_results = null;
        $this->_lastInsertId = null;
        $this->_error = false;
        $this->statement = $this->_dbHandler->prepare($sql);
        try {
            $this->statement->execute($bind);
            $this->_lastInsertId = $this->_dbHandler->lastInsertId();
        } catch (PDOException $exception) {
            Session::message(htmlspecialchars($exception->getMessage()), "warning", "Error");
            Router::redirect("/");
            $this->_error = true;
        }
        return $this;
    }

    /**
     * @param $table
     * @param $values
     * @param $conditions
     * @return bool
     * Function to execute database update statement
     */
    public function update($table, $values, $conditions): bool
    {
        $binds = [];
        $valuesString = "";
        foreach ($values as $field => $value) {
            $valuesString .= ", `{$field}` = :{$field}";
            $binds[$field] = $value;
        }
        $valuesString = ltrim($valuesString, ', ');
        $sql = "UPDATE " . $table . " SET " . $valuesString;
        if (!empty($conditions)) {
            $conditionString = " WHERE ";
            $lastKey = array_key_last($conditions);
            foreach ($conditions as $field => $value) {
                $conditionString .= "`{$field}` = :cond{$field}";
                if ($field != $lastKey) $conditionString .= " AND ";
                $binds['cond' . $field] = $value;
            }
            $sql .= $conditionString;
        }
        $this->execute($sql, $binds);
        return !$this->_error;
    }

    /**
     * @param $table
     * @param $values
     * @return bool
     * Function to handle insert statements
     */
    public function insert($table, $values): bool
    {
        $sql = $this->prepareInsert($table, $values);
        $this->execute($sql, $values);
        return !$this->_error;
    }

    /**
     * @param $table
     * @param $values
     * @return string
     */
    public function prepareInsert($table, $values): string
    {
        $fields = [];
        $binds = [];
        foreach ($values as $key => $value) {
            $fields[] = $key;
            $binds[] = ":{$key}";
        }
        $fieldString = implode('`, `', $fields);
        $bindString = implode(', ', $binds);
        return "INSERT INTO ${table} (`{$fieldString}`) VALUES ({$bindString})";
    }

    /**
     * @param $sql
     * @param $bind
     * @return bool
     */
    public function executeMisc($sql, $bind): bool
    {
        $this->execute($sql, $bind);
        return !$this->_error;
    }

    /**
     * @param $statements
     */
    public function commitTransaction($statements)
    {
        $committed = false;
        $user_id = 0;
        try {
            $this->_dbHandler->beginTransaction();
            foreach ($statements as $table => $values) {
                if ($table != "user" && !$this->_error) {
                    $values['user_id'] = $this->_lastInsertId;
                    $user_id = $this->_lastInsertId;
                }
                $sql = $this->prepareInsert($table, $values);
                $this->execute($sql, $values);
            }
            if ($this->_error) $this->_dbHandler->rollBack();
            else {
                $this->_dbHandler->commit();
                $committed = true;
            }
        } catch (PDOException $error) {
            Session::message($error->getMessage(), "warning", "Error");
            $this->_dbHandler->rollBack();
            $this->_error = true;
        }
        if ($committed) return $user_id;
        else return false;
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->_results;
    }

    /**
     * @return int
     */
    public function getRowCount(): int
    {
        return $this->_rowCount;
    }

    /**
     * @return mixed
     */
    public function getLastInsertId()
    {
        return $this->_lastInsertId;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class): void
    {
        $this->_class = $class;
    }

    /**
     * @param int $fetchType
     */
    public function setFetchType(int $fetchType): void
    {
        $this->_fetchType = $fetchType;
    }
}