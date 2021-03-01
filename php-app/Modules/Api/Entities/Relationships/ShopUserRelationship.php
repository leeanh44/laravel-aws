<?php

namespace Modules\Api\Entities\Relationships;

use Modules\Api\Entities\Shop;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait ShopUserRelationship
{
    public function shopProfile(): HasOne
    {
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }
}
