<?php

namespace Modules\Admin\Services;

use Modules\Admin\Entities\Media;
use Modules\Admin\Contracts\Services\MediaService;
use Modules\Admin\Contracts\Repositories\Mysql\MediaRepository;

class MediaServiceImpl implements MediaService
{
    /** @var MediaRepository */
    private $mediaRepository;

    public function __construct(
        MediaRepository $mediaRepository
    ) {
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * Create data
     *
     * @param array $data
     *
     * @return Media
     */
    public function create(array $data): Media
    {
        return $this->mediaRepository->create($data);
    }
}
