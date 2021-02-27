<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Database\factories\SubCategoryFactory;
use Modules\Api\Entities\Relationships\SubCategoryRelationship;

class SubCategory extends Model
{
    use SubCategoryRelationship;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
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

    protected static function newFactory(): SubCategoryFactory
    {
        return SubCategoryFactory::new();
    }
}
