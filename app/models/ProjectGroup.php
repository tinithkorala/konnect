<?php

namespace App\Models;

use Core\Model;

class ProjectGroup extends Model{
    protected static string $table = "project_group";
    public $project_group_id, $project_id;
}
