<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksibendahara extends Model
{
    public function jenistransaksi()
    {
        return $this->belongsTo(Jenistransaksi::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
