<?php

namespace Ignite;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'description'];
    public $timestamps = false;

    public function repairs()
    {
        return $this->belongsToMany('Ignite\Repair','repair_details');
    }

    public function details(){
        return $this->hasMany('Ignite\Detail');
    }
}
