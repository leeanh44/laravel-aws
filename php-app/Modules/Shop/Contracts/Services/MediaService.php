<?php

namespace Modules\Shop\Contracts\Services;

use Modules\Shop\Entities\Media;

interface MediaService
{
    /**
     * Save
     *
     * @return Media|null
     */
    public function create(array $data) : ?Media;
}
