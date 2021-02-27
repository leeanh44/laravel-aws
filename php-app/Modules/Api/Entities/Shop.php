<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Api\Database\factories\ShopFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Api\Entities\Relationships\ShopRelationship;

class Shop extends Model
{
    use ShopRelationship;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'media_id',
        'name',
        'address',
        'working_time',
        'description',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
        'media_id',
        'media',
        'created_at',
        'updated_at'
    ];

    protected static function newFactory(): ShopFactory
    {
        return ShopFactory::new();
    }
}
