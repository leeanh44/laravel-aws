<?php

namespace Modules\Shop\Services;

use Modules\Shop\Entities\Media;
use Modules\Shop\Contracts\Services\MediaService;
use Modules\Shop\Contracts\Repositories\Mysql\MediaRepository;

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
