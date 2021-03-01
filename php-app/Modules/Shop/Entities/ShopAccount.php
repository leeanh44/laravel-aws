<?php

namespace Modules\Shop\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ShopAccount extends Authenticatable
{
    protected $table = 'shop_accounts';
    protected $guard = 'shop';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'role',
        'account',
        'name',
        'email',
        'password',
        'last_login_at',
        'last_login_ip',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
