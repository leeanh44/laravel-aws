<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Api\Database\factories\NotificationFactory;
use Modules\Api\Entities\Relationships\NotificationRelationship;

class Notification extends Model
{
    use HasFactory;
    use NotificationRelationship;

    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'media_id',
        'title',
        'description',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'media',
        'media_id',
        'delivery_at'
    ];

    protected static function newFactory(): NotificationFactory
    {
        return NotificationFactory::new();
    }
}
