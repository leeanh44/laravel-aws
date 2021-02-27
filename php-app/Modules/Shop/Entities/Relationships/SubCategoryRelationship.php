<?php

namespace Modules\Shop\Entities\Relationships;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Shop\Entities\Media;

trait SubCategoryRelationship
{
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
