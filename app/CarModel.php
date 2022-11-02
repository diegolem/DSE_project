<?php

namespace Ignite;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'models';
    protected $fillable = ['name', 'brand_id'];
    public $timestamps = false;

    public function brand()
    {
        return $this->belongsTo('Ignite\Brand');
    }

    public function cars()
    {
        return $this->hasMany('Ignite\Car','model_id');
    }
}
