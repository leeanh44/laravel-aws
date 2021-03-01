<?php

namespace Modules\Admin\Http\Controllers;

use DB;
use Log;
use Exception;
use Illuminate\Routing\Controller;
use Modules\Admin\Constants\MasterCategoryMedia;
use Modules\Admin\Contracts\Services\MediaService;
use Modules\Admin\Contracts\Clients\StorageClient;
use Modules\Admin\Http\Requests\StoreCategoryRequest;
use Modules\Admin\Http\Requests\UpdateCategoryRequest;
use Modules\Admin\Contracts\Services\MasterCategoryService;

class MasterCategoryController extends Controller
{
    /**
     * @var MasterCategoryService
     */
    private $masterCategoryService;

    /**
     * @var MediaService
     */
    private $mediaService;

    /**
     * @var StorageClient
     */
    private $storageClient;

    public function __construct(
        MasterCategoryService $masterCategoryService,
        MediaService $mediaService,
        StorageClient $storageClient
    ) {
        $this->masterCategoryService = $masterCategoryService;
        $this->mediaService = $mediaService;
        $this->storageClient = $storageClient;
    }

    /**
     * List resource
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->masterCategoryService->list();

        return view('admin::categories.index', compact('categories'));
    }

    /**
     * Create resource
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $maxOrder = $this->masterCategoryService->findMaxOrder();

        return view('admin::categories.create', compact('maxOrder'));
    }

    /**
     * Store resource
     *
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::begintransaction();
            // Upload and create media
            $file = $request->file('image');
            $path = MasterCategoryMedia::STORAGE_PATH;
            $dataInfo = $this->storageClient->uploadFile($file, $path, true);
            $media = $this->mediaService->create($dataInfo);

            $dataInsert = $request->onlyFields();
            $dataInsert['media_id'] = $media->id;
            // Update display order
            $this->masterCategoryService->updateDisplayOrder($dataInsert['order']);
            // Save data
            $this->masterCategoryService->create($dataInsert);
            DB::commit();

            return redirect()->route('admin.categories.index')->withFlashSuccess(__('admin::messages.success.create'));
        } catch (Exception $e) {
            Log::error('[ERROR_STORE_CATEGORY]: '. $e->getMessage());
            DB::rollback();

            return redirect()->route('admin.categories.index')->withErrors(__('admin::messages.fail.create'));
        }//end try
    }

    /**
     * Edit resource
     *
     * @param integer $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $maxOrder = $this->masterCategoryService->findMaxOrder();
        $category = $this->masterCategoryService->findById($id);
        if ($category->media) {
            $category->img_url = $this->storageClient
                ->getImageUrl($category->media->path, $category->media->name);
        }

        return view('admin::categories.edit', compact('category', 'maxOrder'));
    }

    /**
     * Update resource
     *
     * @param UpdateCategoryRequest $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, int $id)
    {
        try {
            DB::begintransaction();
            $category = $this->masterCategoryService->findById($id);
            // Upload and create media
            $data = $request->onlyFields();
            $file = $request->file('image');
            if ($file) {
                $path = MasterCategoryMedia::STORAGE_PATH;
                $dataInfo = $this->storageClient->uploadFile($file, $path, true);
                if ($category->media) {
                    $media = $category->media;
                    $this->storageClient->deleteFile($media->name, $media->path);
                    $media->update($dataInfo);
                } else {
                    $media = $this->mediaService->create($dataInfo);
                    $data['media_id'] = $media->id;
                }
            }

            // Update display order
            $this->masterCategoryService->updateDisplayOrder($data['order'], $category->order);
            // Save data
            $this->masterCategoryService->update($data, $id);
            DB::commit();

            return redirect()->route('admin.categories.index')->withFlashSuccess(__('admin::messages.success.update'));
        } catch (Exception $e) {
            Log::error('[ERROR_UPDATE_CATEGORY]: '. $e->getMessage());
            DB::rollback();

            return redirect()->route('admin.categories.index')->withErrors(__('admin::messages.fail.update'));
        }//end try
    }
}
