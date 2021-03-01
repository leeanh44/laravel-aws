<?php

namespace Modules\Admin\Entities\Relationships;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Admin\Entities\Media;

trait MasterCategoryRelationship
{
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
