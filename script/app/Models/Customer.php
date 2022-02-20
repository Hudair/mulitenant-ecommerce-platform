<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     public function user_domain()
    {
        return $this->belongsTo('App\Domain','domain_id','id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order','customer_id','id');
    }
    public function orders_complete()
    {
        return $this->hasMany('App\Order','customer_id','id')->where('status','completed');
    }

    public function orders_processing()
    {
        return $this->hasMany('App\Order','customer_id','id')->where('status','!=','completed')->where('status','!=','canceled');
    }


}
