<?php

namespace Modules\Admin\Repositories\Mysql;

use Modules\Admin\Entities\Media;
use Modules\Admin\Contracts\Repositories\Mysql\MediaRepository;

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
