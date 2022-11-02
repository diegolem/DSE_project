<?php

namespace Ignite;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'repair_details';

    protected $fillable = ['detail', 'description', 'amount', 'date', 'repair_id', 'category_id'];
    public $timestamps = false;

    public function repair()
    {
        return $this->belongsTo('Ignite\Repair');
    }

    public function category(){
        return $this->belongsTo('Ignite\Category');
    }
}
