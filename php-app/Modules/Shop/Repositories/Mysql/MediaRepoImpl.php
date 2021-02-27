<?php

namespace Modules\Shop\Repositories\Mysql;

use Modules\Shop\Entities\Media;
use Modules\Shop\Contracts\Repositories\Mysql\MediaRepository;

class MediaRepoImpl implements MediaRepository
{
    /**
     * Save
     *
     * @return Media|null
     */
    public function create(array $data) : ?Media
    {
        return Media::create($data);
    }
}
