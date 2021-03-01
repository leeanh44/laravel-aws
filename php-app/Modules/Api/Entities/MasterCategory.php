<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Database\factories\MasterCategoryFactory;
use Modules\Api\Entities\Relationships\MasterCategoryRelationship;

class MasterCategory extends Model
{
    use MasterCategoryRelationship;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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

    /**
     * @return MasterCategoryFactory
     */
    protected static function newFactory(): MasterCategoryFactory
    {
        return MasterCategoryFactory::new();
    }
}
