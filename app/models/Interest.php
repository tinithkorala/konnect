<?php

namespace App\Models;

use Core\Model;

class Interest extends Model
{
    protected static string $table = "interests";
    public $interest_id, $interest;
}