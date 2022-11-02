<?php

namespace Ignite;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = ['name', 'country_id'];
    public $timestamps = false;

    public function models()
    {
        return $this->hasMany('Ignite\CarModel');
    }

    public function country()
    {
        return $this->belongsTo('Ignite\Country');
    }
}
