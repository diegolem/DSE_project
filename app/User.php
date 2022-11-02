<?php

namespace Ignite;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AutorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable implements
    AutorizableContract, CanResetPasswordContract
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'dui', 'name', 'lastname', 'email', 'birthdate', 'address', 'phone', 'user_type_id', 'age'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userType()
    {
        return $this->belongsTo('Ignite\UserType');
    }

    public function isAdmin()
    {
        return $this->userType->id == 'ADM';
    }

    public function isAssistant()
    {
        return $this->userType->id == 'ASI';
    }
    public function isMechanic()
    {
        return $this->userType->id == 'MCO';
    }

    public function isClient()
    {
        return $this->userType->id == 'CLE';
    }

    /*
     *  CLIENT relations
     * */
    public function cars()
    {
        return $this->isClient() ? $this->belongsToMany('Ignite\Car', 'detail_client_car')->withPivot('enabled') : null;
    }

    public function car(){
        return $this->hasMany('Ignite\Car');
    }

    /*
     *  MECHANIC relations
     * */
    public function specialties()
    {
        return $this->isMechanic() ? $this->belongsToMany('Ignite\Especialty', 'detail_mechanic_specialty','user_id','especialty_id') : null;
    }

    public function repairs()
    {
        return $this->isMechanic() ? $this->belongsToMany('Ignite\Repair', 'detail_mechanic_repair')->withTimestamps() : null;
    }

}
