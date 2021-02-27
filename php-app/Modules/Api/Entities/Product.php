<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Api\Database\factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Api\Entities\Relationships\ProductRelationship;

class Product extends Model
{
    use ProductRelationship;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sub_category_id',
        'name',
        'description',
        'price',
        'rating',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'thumbnail',
        'created_at',
        'updated_at'
    ];

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
