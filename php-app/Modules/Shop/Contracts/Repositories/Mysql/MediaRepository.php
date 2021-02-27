<?php

namespace Modules\Shop\Contracts\Repositories\Mysql;

use Modules\Shop\Entities\Media;

interface MediaRepository
{
    /**
     * Save
     *
     * @return Media|null
     */
    public function create(array $data) : ?Media;
}
