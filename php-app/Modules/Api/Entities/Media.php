<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Database\factories\MediaFactory;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'path',
        'size',
        'thumbnail_name',
        'thumbnail_size',
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

    protected static function newFactory(): MediaFactory
    {
        return MediaFactory::new();
    }
}
