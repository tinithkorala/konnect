<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;
use Exception;

class Post extends Model
{
    protected static string $table = "notices";
    public static array $fields = ['post' => "Post body cannot be empty"];
    public $post_id, $user_id, $createdAt, $type, $research_group_id, $post;

    /**
     * @return array|string[]
     */
    public static function getFields(): array
    {
        $fields = [];
        foreach (self::$fields as $key => $value) {
            $fields[] = $key;
        }
        return $fields;
    }

    /**
     * @throws Exception
     */
    public function beforeSave()
    {
        $this->timeStamp();
        $fields = self::$fields;
        foreach ($fields as $field => $message) {
            $this->runValidator(new RequiredValidator($this, ["field" => $field, "message" => $message]));
        }
    }

    public function getAllPosts() {

        // $posts = Post::selectBuilder('notices', []);
        // $posts = Post::selectBuilder('user_role', []);
        // return self::queryParamBuilder($posts);
       
        // return self::find($params);

        // $posts = self::selectBuilder('user_role', []);
        $sql = "SELECT 
                    `notices`.* , 
                    `user`.firstName 
                FROM `notices`
                JOIN `user` ON `user`.user_id = `notices`.created_by 
                ORDER BY `notices`.notice_id DESC";
        $response = Post::executeQuery1($sql);
        return $response;
    }
}