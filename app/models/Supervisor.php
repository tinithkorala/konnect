<?php

namespace App\Models;

use Core\Model;

class Supervisor extends Model
{
    protected static string $table = "supervisor";
    public $supervisor_id, $user_id, $year;
}