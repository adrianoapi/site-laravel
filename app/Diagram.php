<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagram extends Model
{
    public function items()
    {
        return $this->hasMany(DiagramItem::class, 'diagram_id', 'id');
    }
}
