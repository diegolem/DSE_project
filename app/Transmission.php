<?php

namespace Ignite;

use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{
    protected $table = 'transmissions';
    protected $fillable = ['name', 'description'];
    public $timestamps = false;

    public function vehiculos()
    {
        return $this->hasMany('Ignite\'Car');
    }
}
