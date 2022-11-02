<?php

namespace Ignite;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $primaryKey = 'id'; // or null
    public $incrementing = false;

    protected $fillable = ['id', 'name'];
    public $timestamps = false;

    public function brands()
    {
        return $this->hasMany('Ignite\Brand');
    }
}
