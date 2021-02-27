<?php

namespace Modules\Api\Entities\Relationships;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Api\Entities\Media;
use Modules\Api\Entities\ShopBanner;
use Modules\Api\Constants\ShopBannerStatus;

trait ShopRelationship
{
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    public function banners(): HasMany
    {
        return $this->hasMany(ShopBanner::class, 'shop_id')
            ->where('status', ShopBannerStatus::ACTIVE)
            ->orderBy('order');
    }
}
