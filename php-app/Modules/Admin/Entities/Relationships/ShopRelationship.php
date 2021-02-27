<?php

namespace Modules\Admin\Entities\Relationships;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Admin\Entities\Media;
use Modules\Admin\Entities\MasterCategory;

trait ShopRelationship
{
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    public function masterCategories(): BelongsToMany
    {
        return $this->belongsToMany(MasterCategory::class, 'shop_master_categories', 'shop_id', 'master_category_id');
    }
}
