<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Shop\Entities\Relationships\ShopUserRelationship;

class ShopUser extends Model
{
    use ShopUserRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'user_id',
        'level',
        'point_total',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
