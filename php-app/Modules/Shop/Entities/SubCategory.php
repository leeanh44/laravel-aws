<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Shop\Entities\Relationships\SubCategoryRelationship;

class SubCategory extends Model
{
    use SubCategoryRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'media_id',
        'name',
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
        'created_at',
        'updated_at'
    ];
}
