<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class honor extends Model
{
    public function pjks()
    {
        return $this->belongsTo(pjk::class);
    }
}
