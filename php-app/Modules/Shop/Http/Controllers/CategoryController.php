<?php

namespace Modules\Shop\Http\Controllers;

use DB;
use Log;
use Exception;
use Illuminate\Routing\Controller;
use Modules\Shop\Constants\CategoryMedia;
use Modules\Shop\Contracts\Services\MediaService;
use Modules\Shop\Contracts\Clients\StorageClient;
use Modules\Shop\Http\Requests\StoreCategoryRequest;
use Modules\Shop\Http\Requests\UpdateCategoryRequest;
use Modules\Shop\Contracts\Services\CategoryService;
use Modules\Shop\Contracts\Services\SubCategoryService;
use Modules\Api\Transformers\SuccessResource;
use Modules\Api\Transformers\ErrorResource;

class CategoryController extends Controller
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
     * List resource
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryService->list();
        $maxOrder = $this->categoryService->findMaxOrder();

        return view('shop::categories.index', compact('categories', 'maxOrder'));
    }

    /**
     * Create resource
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $maxOrder = $this->categoryService->findMaxOrder();

        return view('shop::categories.create', compact('maxOrder'));
    }

    /**
     * Store resource
     *
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::begintransaction();
            $dataInsert = $request->onlyFields();
            $dataInsert['shop_id'] = auth()->user()->shop_id;
            // Update display order
            $this->categoryService->updateDisplayOrder($dataInsert['order']);
            // Save data
            $this->categoryService->create($dataInsert);
            DB::commit();

            return (new SuccessResource(null, 200, __('shop::messages.success.create')))
                ->response()
                ->setStatusCode(200);
        } catch (Exception $e) {
            Log::error('[ERROR_STORE_CATEGORY]: '. $e->getMessage());
            DB::rollback();

            return (new ErrorResource(400, __('shop::messages.fail.create')))
                ->response()
                ->setStatusCode(400);
        }//end try
    }

    /**
     * Edit resource
     *
     * @param integer $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function detail(int $id)
    {
        try {
            $maxOrder = $this->categoryService->findMaxOrder();
            $category = $this->categoryService->findById($id);
            $subCategories = $this->subCategoryService->list($category->id);

            $subCategories->transform(function ($subCategory) {
                $subCategory->img_url = null;
                if ($subCategory->media) {
                    $subCategory->img_url = $this->storageClient
                        ->getImageUrl($subCategory->media->path, $subCategory->media->name);
                }

                return $subCategory;
            });

            return view('shop::categories.detail', compact('category', 'maxOrder', 'subCategories'));
        } catch (Exception $e) {
            Log::error('[ERROR_GET_DETAIL_CATEGORY]: '. $e->getMessage());

            return redirect()->route('shop.categories.index');
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
            $maxOrder = $this->categoryService->findMaxOrder();
            $category = $this->categoryService->findById($id);

            return view('shop::categories.edit', compact('category', 'maxOrder'));
        } catch (Exception $e) {
            Log::error('[ERROR_GET_EDIT_CATEGORY]: '. $e->getMessage());

            return redirect()->route('shop.categories.index');
        }//end try
    }

    /**
     * Update resource
     *
     * @param UpdateCategoryRequest $request
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryRequest $request, int $id)
    {
        try {
            DB::begintransaction();
            $category = $this->categoryService->findById($id);
            // Upload and create media
            $data = $request->onlyFields();

            // Update display order
            $this->categoryService->updateDisplayOrder($data['order'], $category->order);
            // Save data
            $this->categoryService->update($data, $id);
            DB::commit();

            return (new SuccessResource(null, 200, __('shop::messages.success.update')))
                ->response()
                ->setStatusCode(200);
        } catch (Exception $e) {
            Log::error('[ERROR_UPDATE_CATEGORY]: '. $e->getMessage());
            DB::rollback();

            return (new ErrorResource(400, __('shop::messages.fail.update')))
                ->response()
                ->setStatusCode(400);
        }//end try
    }
}
