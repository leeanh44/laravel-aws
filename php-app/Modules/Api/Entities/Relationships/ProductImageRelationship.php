<?php

namespace Modules\Api\Entities\Relationships;

use Modules\Api\Entities\Media;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ProductImageRelationship
{
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
