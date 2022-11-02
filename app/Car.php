<?php

namespace Ignite;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;
    protected $table = 'cars';
    protected $fillable = [
        'motor', 'displacement ', 'mileage', 'observations', 'year', 'model_id', 'transmission_id', 'license', 'user_id'
    ];
    protected $softDelete = true;

    public function owner()
    {
        return $this->belongsTo('Ignite\User', 'user_id', 'id');
    }

    public function model()
    {
        return $this->belongsTo('Ignite\CarModel');
    }

    public function transmission()
    {
        return $this->belongsTo('Ignite\Transmission');
    }

    public function  repairs()
    {
        return $this->hasMany('Ignite\Repair');
    }

    public function clients()
    {
        return $this->belongsToMany('Ignite\User', 'detail_client_car')->withPivot('enabled');
    }

    public function images()
    {
        return $this->hasMany('Ignite\Image');
    }
}
