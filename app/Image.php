<?php

namespace Ignite;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'car_images';
    protected $fillable = ['car_id', 'name'];
    public $timestamps = false;

    public function car()
    {
        return $this->belongsTo('Ignite\Car');
    }
}
