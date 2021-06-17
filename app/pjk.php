<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pjk extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function honors()
    {
        return $this->hasMany(honor::class);
    }
}
