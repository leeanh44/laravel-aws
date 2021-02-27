<?php

namespace Modules\Shop\Entities\Relationships;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Shop\Entities\User;

trait ShopUserRelationship
{
    public function userProfile(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
