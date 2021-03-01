<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Entities\Relationships\ShopBannerRelationship;

class ShopBanner extends Model
{
    use ShopBannerRelationship;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'media_id',
        'order',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'media',
        'media_id',
        'created_at',
        'updated_at'
    ];
}
