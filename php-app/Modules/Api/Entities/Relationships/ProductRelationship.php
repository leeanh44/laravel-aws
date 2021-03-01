<?php

namespace Modules\Api\Entities\Relationships;

use Modules\Api\Entities\ProductImage;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ProductRelationship
{
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function thumbnail(): HasOne
    {
        return $this->hasOne(ProductImage::class)->latest();
    }
}
