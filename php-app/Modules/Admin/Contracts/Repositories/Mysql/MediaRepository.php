<?php

namespace Modules\Admin\Contracts\Repositories\Mysql;

use Modules\Admin\Entities\Media;

interface MediaRepository
{
    /**
     * Save
     *
     * @return Media|null
     */
    public function create(array $data) : ?Media;
}
