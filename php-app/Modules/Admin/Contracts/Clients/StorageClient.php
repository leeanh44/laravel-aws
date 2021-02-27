<?php

namespace Modules\Admin\Contracts\Clients;

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

    /**
     * Upload file
     *
     * @param object $file
     * @param string $path
     * @param bool $isRename
     * @return array
     */
    public function uploadFile(object $file, string $path, bool $isRename = true): array;

    /**
     * Delete file
     *
     * @param string $name
     * @param string $path
     * @return bool
     */
    public function deleteFile(string $name, string $path): bool;
}
