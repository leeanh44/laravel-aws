<?php

namespace Modules\Api\Entities\Relationships;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Api\Entities\Media;

trait SubCategoryRelationship
{
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
