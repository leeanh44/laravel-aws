<?php

namespace Modules\Admin\Contracts\Services;

use Modules\Admin\Entities\Media;

interface MediaService
{
    /**
     * Save
     *
     * @return Media|null
     */
    public function create(array $data) : ?Media;
}
