<?php

namespace Ignite;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon as Carbon;

class Repair extends Model
{
    protected $table = 'repairs';
    protected $fillable = ['code', 'admissionDate', 'departureDate', 'amount', 'status', 'car_id'];
    public $timestamps = false;

    public static function genCode()
    {
        $f = true;
        $code = "";
        do{
            $numbers = explode('|', '0|1|2|3|4|5|6|7|8|9');
            $code = "R" . Carbon::now()->format('Y') . "-";
            for ($i = 1; $i <= 6; $i++){
                $code .= $numbers[rand(0, 9)];
            }

            $f = Repair::where('code', '=', $code)->count() > 0;
        }while($f);

        return $code;
    }

    public function car()
    {
        return $this->belongsTo('Ignite\Car');
    }

    public function mechanics()
    {
        return $this->belongsToMany('Ignite\User', 'detail_mechanic_repair');
    }

    public function categories()
    {
        return $this->belongsToMany('Ignite\Category');
    }

    public function details()
    {
        return $this->hasMany('Ignite\Detail');
    }
}
