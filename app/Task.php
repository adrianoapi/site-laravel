<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function groupTask()
    {
        return $this->hasOne(GroupTask::class, 'id', 'group_task_id');
    }
}
