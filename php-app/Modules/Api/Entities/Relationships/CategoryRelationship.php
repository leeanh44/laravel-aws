<?php

namespace Modules\Api\Entities\Relationships;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Api\Constants\SubCategoryStatus;
use Modules\Api\Entities\SubCategory;

trait CategoryRelationship
{
    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id')
            ->where('status', SubCategoryStatus::ACTIVE)
            ->orderBy('order');
    }
}
