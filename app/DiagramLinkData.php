<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagramLinkData extends Model
{
    public function points()
    {
        return $this->hasMany(DiagramLinkDataPoint::class, 'diagram_link_data_id', 'id');
    }
}
