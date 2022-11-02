<?php

namespace Ignite;

use Illuminate\Database\Eloquent\Model;

class Especialty extends Model
{
    protected $table = 'specialties';
    protected $fillable = ['name', 'description'];
    public $timestamps = false;

    public function mechanics()
    {
        return $this->belongsToMany('Ignite\User','detail_mechanic_specialty','especialty_id','user_id');
    }
}