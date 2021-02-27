<?php

namespace Modules\Shop\Http\Controllers;

use DB;
use Log;
use Exception;
use Illuminate\Routing\Controller;
use Modules\Shop\Constants\SubCategoryMedia;
use Modules\Shop\Contracts\Services\MediaService;
use Modules\Shop\Contracts\Clients\StorageClient;
use Modules\Shop\Http\Requests\StoreSubCategoryRequest;
use Modules\Shop\Http\Requests\UpdateSubCategoryRequest;
use Modules\Shop\Contracts\Services\CategoryService;
use Modules\Shop\Contracts\Services\SubCategoryService;

class SubCategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var SubCategoryService
     */
    private $subCategoryService;

    /**
     * @var MediaService
     */
    private $mediaService;

    /**
     * @var StorageClient
     */
    private $storageClient;

    public function __construct(
        CategoryService $categoryService,
        SubCategoryService $subCategoryService,
        MediaService $mediaService,
        StorageClient $storageClient
    ) {
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
        $this->mediaService = $mediaService;
        $this->storageClient = $storageClient;
    }

    /**
     * Create resource
     *
     * @return \Illuminate\View\View
     */
    public function create(int $categoryId)
    {
        $category = $this->categoryService->findById($categoryId);
        $maxOrder = $this->subCategoryService->findMaxOrder($categoryId);

        return view('shop::categories.children.create', compact('category', 'maxOrder', 'categoryId'));
    }

    /**
     * Store resource
     *
     * @param integer $categoryId
     * @param StoreSubCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(int $categoryId, StoreSubCategoryRequest $request)
    {
        try {
            DB::begintransaction();
            // Upload and create media
            $file = $request->file('image');
            $path = SubCategoryMedia::STORAGE_PATH;
            $dataInfo = $this->storageClient->uploadFile($file, $path, true);
            $media = $this->mediaService->create($dataInfo);

            $dataInsert = $request->onlyFields();
            $dataInsert['media_id'] = $media->id;
            $dataInsert['category_id'] = $categoryId;
            // Update display order
            $this->subCategoryService->updateDisplayOrder($categoryId, $dataInsert['order']);
            // Save data
            $this->subCategoryService->create($dataInsert);
            DB::commit();

            return redirect()->route('shop.categories.detail', $categoryId)
                ->withFlashSuccess(__('shop::messages.success.create'));
        } catch (Exception $e) {
            Log::error('[ERROR_STORE_SUB_CATEGORY]: '. $e->getMessage());
            DB::rollback();

            return redirect()->route('shop.categories.detail', $categoryId)
                ->withErrors(__('shop::messages.fail.create'));
        }//end try
    }

    /**
     * Edit resource
     *
     * @param integer $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(int $id)
    {
        try {
            $subCategory = $this->subCategoryService->findById($id);
            $category = $this->categoryService->findById($subCategory->category_id);
            if (!$category) {
                return redirect()->route('shop.categories.index');
            }
            $maxOrder = $this->subCategoryService->findMaxOrder($subCategory->category_id);
            if ($subCategory->media) {
                $subCategory->img_url = $this->storageClient
                    ->getImageUrl($subCategory->media->path, $subCategory->media->name);
            }
    
            return view('shop::categories.children.edit', compact('category', 'subCategory', 'maxOrder'));
        } catch (Exception $e) {
            Log::error('[ERROR_GET_EDIT_SUB_CATEGORY]: '. $e->getMessage());

            return redirect()->route('shop.categories.index');
        }//end try
    }

    /**
     * Update resource
     *
     * @param UpdateSUBCategoryRequest $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSubCategoryRequest $request, int $id)
    {
        try {
            DB::begintransaction();
            $subCategory = $this->subCategoryService->findById($id);
            // Upload and create media
            $data = $request->onlyFields();
            $file = $request->file('image');
            if ($file) {
                $path = SubCategoryMedia::STORAGE_PATH;
                $dataInfo = $this->storageClient->uploadFile($file, $path, true);
                if ($subCategory->media) {
                    $media = $subCategory->media;
                    $this->storageClient->deleteFile($media->name, $media->path);
                    $media->update($dataInfo);
                } else {
                    $media = $this->mediaService->create($dataInfo);
                    $data['media_id'] = $media->id;
                }
            }

            // Update display order
            $this->subCategoryService->updateDisplayOrder(
                $subCategory->category_id,
                $data['order'],
                $subCategory->order
            );
            // Save data
            $this->subCategoryService->update($data, $id);
            DB::commit();

            return redirect()->route('shop.categories.detail', $subCategory->category_id)
                ->withFlashSuccess(__('shop::messages.success.update'));
        } catch (Exception $e) {
            Log::error('[ERROR_UPDATE_SUB_CATEGORY]: '. $e->getMessage());
            DB::rollback();

            return redirect()->route('shop.categories.index')
                ->withErrors(__('shop::messages.fail.update'));
        }//end try
    }
}
