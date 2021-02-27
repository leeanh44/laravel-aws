<?php

namespace Modules\Api\Entities\Relationships;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Api\Entities\Media;
use Modules\Api\Entities\Shop;
use Modules\Api\Constants\ShopStatus;

trait MasterCategoryRelationship
{
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    public function shops(): BelongsToMany
    {
        return $this->belongsToMany(Shop::class, 'shop_master_categories', 'master_category_id', 'shop_id')
                    ->where('status', ShopStatus::ACTIVE);
    }
}
