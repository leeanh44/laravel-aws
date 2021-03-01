<?php

namespace Modules\Api\Contracts\Clients;

interface StorageClient
{
    /**
     * @param string $path
     * @param string $name
     * @return string|null
     */
    public function getImageUrl(string $path, string $name): ?string;

    /**
     * Get temporary url of image on AWS S3
     *
     * @param string $path
     * @param string $name
     * @return string
     */
    public function getS3TemporaryUrl(string $path, string $name): string;
}
