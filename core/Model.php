<?php /** @noinspection ALL */

namespace Core;

use App\Models\Users;
use Core\Validators\Validator;
use DateTime;
use DateTimeZone;
use Exception;
use mysql_xdevapi\TableUpdate;
use PDO;
use Core\Database;
use Core\Request;

class Model
{
    protected static string $table = "";
    public array $_errors = [];
    protected array $columns = [];
    private array $_skipUpdate = [];
    private bool $_validationPassed = true;
    protected int $id;
    private string $updatedAt;
    private string $createdAt;

    /**
     * @param $table
     * @param $values
     * @return bool
     */
    public static function insert($table, $values): bool
    {
        $db = static::getDB();
        if ($db) return $db->insert($table, $values);
    }

    /**
     * @param false $setFetchClass
     *
     */
    protected static function getDB($setFetchClass = false)
    {
        $db = Database::getInstance();
        if ($setFetchClass && $db) {
            $db->setClass(get_called_class());
            $db->setFetchType(PDO::FETCH_CLASS);
        }
        if (!$db) {
            Session::message("Failed to connect to database", "warning", "Database connection failed");
        }
        return $db;
    }

    public static function executeQuery($sql, $params)
    {
        $db = static::getDB();
        if ($db) return $db->query($sql, $params)->getResults();
    }

    public static function executeQuery1($sql)
    {
        $db = static::getDB();
        if ($db) return $db->query($sql)->getResults();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public static function find($table, $params = [])
    {
        $db = static::getDB(true);
        list('sql' => $sql, 'bind' => $bind) = self::selectBuilder($table, $params);
        return $db->query($sql, $bind)->getResults();
    }

    /**
     * @param array $params
     * @param string $table
     * @return array
     */
    public static function selectBuilder($table, $params = []): array
    {
        $columns = array_key_exists('columns', $params) ? $params['columns'] : "*";
        $sql = "SELECT {$columns} from {$table}";
        list('sql' => $conds, 'bind' => $bind) = self::queryParamBuilder($params);
        $sql .= $conds;
        return ['sql' => $sql, 'bind' => $bind];
    }

    /**
     * @param array $params
     * @return array
     */
    public static function queryParamBuilder($params = []): array
    {
        $sql = '';
        $bind = array_key_exists('bind', $params) ? $params['bind'] : [];
        $options = [
            'conditions' => 'WHERE',
            'group' => 'GROUP BY',
            'order' => 'ORDER BY',
            'limit' => 'LIMIT',
            'offset' => 'OFFSET'
        ];
        foreach ($options as $key => $value) {
            if (array_key_exists($key, $params)) {
                $conds = $params[$key];
                $sql .= " ${value} ${conds}";
            }
        }
        if (array_key_exists('joins', $params)) {
            $joins = $params['joins'];
            foreach ($joins as $join) {
                $joinTable = $join[0];
                $joinOn = $join[1];
                $joinAlias = $join[2] ?? "";
                $joinType = $join[3] ?? "";
                $sql .= " ${joinType} ${joinTable} ${joinAlias} ON ${joinOn}";
            }
        }
        return ['sql' => $sql, 'bind' => $bind];
    }

    /**
     * @param $id
     * @return false|mixed
     */
    public static function findById($id, $column = 'id')
    {
        return self::findFirst(static::$table,
            [
                'conditions' => $column . ' = :id',
                'bind' => ['id' => $id]
            ]);
    }

    /**
     * @param array $params
     * @return false|Users
     */
    public static function findFirst($table, $params = [])
    {
        $db = static::getDB(true);
        $results = [];
        if ($db) {
            list('sql' => $sql, 'bind' => $bind) = self::selectBuilder($table, $params);
            $results = $db->query($sql, $bind)->getResults();
        }
        return isset($results[0]) ? $results[0] : false;
    }

    /**
     * @param array $params
     * @return int
     */
    public static function findTotal($params = []): int
    {
        unset($params['limit']);
        unset($params['offset']);
        $table = static::$table;
        $sql = "SELECT COUNT(*) AS total FROM {$table}";
        list('sql' => $conds, 'bind' => $bind) = self::queryParamBuilder($params);
        $sql .= $conds;
        $db = static::getDB();
        if ($db) {
            $results = $db->query($sql, $bind);
            $total = sizeof($results->getResults()) > 0 ? $results->getResults()[0]->total : 0;
            return $total;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        $save = false;
        $this->beforeSave();
        if ($this->_validationPassed) {
            $db = static::getDB();
            if ($db) {
                $values = $this->getValuesForSave();
                if ($this->isNew()) {
                    $save = $db->insert(static::$table, $values);
                    if ($save) {
                        $this->id = $db->getLastInsertId();
                    }
                } else $save = $db->update(static::$table, $values, ['id' => $this->id]);
            }
        }
        return $save;
    }

    public function beforeSave()
    {
    }

    /**
     * @return array
     */
    public function getValuesForSave(): array
    {
        $columns = $this->getColumns();
        $values = [];
        foreach ($columns as $column) {
            if (!in_array($column, $this->_skipUpdate)) $values[$column] = $this->$column;
        }
        return $values;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        $db = static::getDB();
        if ($db) {
            $table = static::$table;
            $sql = "SHOW COLUMNS FROM {$table}";
            $results = $db->query($sql)->getResults();
            $tableColumns = [];
            foreach ($results as $column) {
                $tableColumns[] = $column->Field;
            }
            $this->columns = $tableColumns;
        }
        return $this->columns;
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return empty($this->id);
    }

    /**
     * @param string $secondaryTable
     * @return bool | string
     */
    // public function createUser(string $secondaryTable): bool | string
    public function createUser(string $secondaryTable)
    {
        $this->beforeSave();
        $created = '';
        if ($this->_validationPassed) {
            $db = static::getDB();
            if ($db) {
                static::$table = "user";
                $values1 = $this->getValuesForSave();
                $values1["password"] = password_hash($values1["password"], PASSWORD_DEFAULT);
                static::$table = $secondaryTable;
                $values2 = $this->getValuesForSave();
                $statements = ["user" => $values1, $secondaryTable => $values2];
                $created = $db->commitTransaction($statements);
            }
        }
        return $created;
    }

    /**
     * @param Validator $validator
     */
    public function runValidator(Validator $validator)
    {
        $validates = $validator->runValidation();
        if (!$validates) {
            $this->_validationPassed = false;
            $this->_errors[$validator->field] = $validator->message;
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->_errors;
    }

    /**
     * @param $name
     * @param $value
     */
    public function setErrors($name, $value): void
    {
        $this->_errors[$name] = $value;
    }

    /**s
     * @throws Exception
     */
    public function timeStamp()
    {
        $dateTime = new DateTime("now", new DateTimeZone("UTC"));
        $now = $dateTime->format('Y-m-d H:i:s');
        $this->updatedAt = $now;
        if ($this->isNew()) {
            $this->createdAt = $now;
        }
    }

    /**
     * @param $values
     * @param $conditions
     * @return bool
     */
    public function update($values, $conditions): bool
    {
        $db = static::getDB();
        if ($db) return $db->update(static::$table, $values, $conditions);
        else return false;
    }

    /**
     * @return \Core\Database
     */
    public static function delete($param, $cond): \Core\Database
    {
        $db = static::getDB();
        if ($db) {
            $table = static::$table;
            $params = [
                'conditions' => "{$param} = :{$param}",
                'bind' => [$param => $cond]
            ];
            list('sql' => $conditions, 'bind' => $bind) = self::queryParamBuilder($params);
            $sql = "DELETE FROM {$table} {$conditions}";
            return $db->execute($sql, $bind);
        }
    }

    public static function deleteWhere($param, $conds) {
        $db = static::getDB();
        if($db){
            $table = static::$table;
            $params = ['conditions' => $conds, 'bind' => $param];
            list('sql' => $conditions, 'bind' => $bind) = self::queryParamBuilder($params);
            $sql = "DELETE FROM {$table} {$conditions}";
            return $db->execute($sql, $bind);
        }
    }

    /**
     * @param array $params
     * @return array|mixed
     */
    public static function mergeWithPagination($params = [])
    {
        $request = new Request();
        $page = $request->get('p');
        if (!$page || $page < 1) $page = 1;
        $limit = $request->get('limit') ? $request->get('limit') : 25;
        $offset = ($page - 1) * $limit;
        $params['limit'] = $limit;
        $params['offset'] = $offset;
        return $params;
    }
}