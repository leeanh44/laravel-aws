<?php

namespace Modules\Shop\Clients;

use Carbon\Carbon;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Storage;
use Modules\Shop\Contracts\Clients\StorageClient;

class StorageClientImpl implements StorageClient
{
    private $storageClient;

    public function __construct()
    {
        $this->setStorageClient(config('filesystems.default'));
    }

    private function setStorageClient(string $disk): void
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
        return $this->storageClient->temporaryUrl(
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

    /**
     * Upload file
     *
     * @param string $path
     * @param string $path
     * @return array
     */
    public function uploadFile(object $file, string $path, bool $isRename = true): array
    {
        try {
            $dataInfo = $this->getFileInfo($file);
            $dataInfo['path'] = $path;
            $dataInfo['name'] = $this->getFileName($file, $isRename);
            $key = $this->generateFileName($path, $dataInfo['name']);
            $this->storageClient->put($key, file_get_contents($file), 'public');

            return $dataInfo;
        } catch (\Exception $e) {
            \Log::error('[ERROR_UPLOAD_FILE] =>' . $e->getMessage());

            return [];
        }//end try
    }

    /**
     * Get file name.
     *
     * @param object $file
     * @param boolean $isRename
     *
     * @return string
     */
    private function getFileName(object $file, bool $isRename = true): string
    {
        $fileName = $file->getClientOriginalName();
        if ($isRename) {
            $fileName = encryptFileName(randomString(), $file->getClientOriginalExtension());
        }
        
        return $fileName;
    }

    /**
     * Get file info.
     *
     * @param object $file
     *
     * @return array
     */
    private function getFileInfo(object $file): array
    {
        $imageSize = getimagesize($file);
        $size = null;
        if ($imageSize) {
            $size = $imageSize[0] . 'x' . $imageSize[1];
        }
        
        return [
                'type' => $file->getClientOriginalExtension(),
                'size' => $size
            ];
    }

    /**
     * Delete file.
     *
     * @param string $name
     * @param string $path
     * @return bool
     */
    public function deleteFile(string $name, string $path): bool
    {
        try {
            $key = $this->generateFileName($path, $name);

            return $this->storageClient->delete($key);
        } catch (\Exception $e) {
            \Log::error('[ERROR_DELETE_FILE] =>' . $e->getMessage());

            return false;
        }
    }
}
