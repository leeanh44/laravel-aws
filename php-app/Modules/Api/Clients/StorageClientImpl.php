<?php

namespace Modules\Api\Clients;

use App\Exceptions\ApiException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Modules\Api\Contracts\Clients\StorageClient;

class StorageClientImpl implements StorageClient
{
    private $storageClient;

    public function __construct()
    {
        $this->setStorageClient(config('filesystems.default'));
    }

    public function setStorageClient(string $disk): void
    {
        $disks = config('filesystems.disks');
        if (empty($disks[$disk])) {
            throw ApiException::serviceUnavailable();
        }

        $this->storageClient = Storage::disk($disk);
    }

    /**
     * Get image url.
     *
     * @param string $path
     * @param string $name
     * @return string
     */
    public function getImageUrl(string $path, string $name): string
    {
        $key = $this->generateFileName($path, $name);

        return $this->storageClient->url($key);
    }

    /**
     * Get temporary url of image on AWS S3
     *
     * @param string $path
     * @param string $name
     * @return string
     */
    public function getS3TemporaryUrl(string $path, string $name): string
    {
        return Storage::disk('s3')
            ->temporaryUrl(
                $this->generateFileName($path, $name),
                Carbon::now()->addMinutes(30)
            );
    }

    /**
     * Generate file name from path and end name
     *
     * @param string $path
     * @param string $name
     * @return string
     */
    private function generateFileName(string $path, string $name): string
    {
        return sprintf('%s/%s', $path, $name);
    }
}
