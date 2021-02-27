<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Api\Database\factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Api\Entities\Relationships\ProductImageRelationship;

class ProductImage extends Model
{
    use ProductImageRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'media_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'media',
        'media_id',
        'product_id',
        'created_at',
        'updated_at'
    ];
}
