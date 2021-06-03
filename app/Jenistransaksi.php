<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenistransaksi extends Model
{
    public function transaksibendahara()
    {
        return $this->hasMany(Transaksibendahara::class);
    }
}
