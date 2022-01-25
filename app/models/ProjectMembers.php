<?php

namespace App\Models;

use Core\Model;

class ProjectMembers extends Model{
    protected static string $table = "project_members";
    public $member_id, $user_id, $joinedAt, $role, $project_group_id, $project_id;
}
