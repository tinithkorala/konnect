<?php

namespace App\Models;

use Core\Model;

class UserInterests extends Model
{
    protected static string $table = "user_interests";
    public $user_id, $interest_id;
}