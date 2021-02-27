<?php

namespace Modules\Admin\Http\Controllers;

use DB;
use Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Constants\ShopMedia;
use Modules\Admin\Contracts\Services\MediaService;
use Modules\Admin\Contracts\Clients\StorageClient;
use Modules\Admin\Http\Requests\StoreShopRequest;
use Modules\Admin\Http\Requests\UpdateShopRequest;
use Modules\Admin\Http\Requests\FilterShopRequest;
use Modules\Admin\Contracts\Services\ShopService;
use Modules\Admin\Contracts\Services\MasterCategoryService;

class ShopController extends Controller
{
    /**
     * @var ShopService
     */
    private $shopService;

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
        ShopService $shopService,
        MasterCategoryService $masterCategoryService,
        MediaService $mediaService,
        StorageClient $storageClient
    ) {
        $this->shopService = $shopService;
        $this->masterCategoryService = $masterCategoryService;
        $this->mediaService = $mediaService;
        $this->storageClient = $storageClient;
    }

    /**
     * List resource
     *
     * @param FilterShopRequest $request
     * @return \Illuminate\View\View
     */
    public function index(FilterShopRequest $request)
    {
        $shops = $this->shopService->list($request->onlyFields());
        return view('admin::shops.index', compact('shops'));
    }

    /**
     * Create resource
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->masterCategoryService->all();

        return view('admin::shops.create', compact('categories'));
    }

    /**
     * Store resource
     *
     * @param StoreShopRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreShopRequest $request)
    {
        try {
            DB::begintransaction();
            // Upload and create media
            $file = $request->file('image');
            $path = ShopMedia::STORAGE_PATH;
            $dataInfo = $this->storageClient->uploadFile($file, $path, true);
            $media = $this->mediaService->create($dataInfo);

            $dataInsert = $request->onlyFields();
            $dataInsert['media_id'] = $media->id;
            // Save data
            $shop = $this->shopService->create($dataInsert);
            $shop->masterCategories()->sync($dataInsert['master_categories'] ?? []);
            DB::commit();

            return redirect()->route('admin.shops.index')->withFlashSuccess(__('admin::messages.success.create'));
        } catch (Exception $e) {
            Log::error('[ERROR_STORE_CATEGORY]: '. $e->getMessage());
            DB::rollback();

            return redirect()->route('admin.shops.index')->withErrors(__('admin::messages.fail.create'));
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
        $categories = $this->masterCategoryService->all();
        $shop = $this->shopService->findById($id);
        if ($shop->media) {
            $shop->img_url = $this->storageClient
                ->getImageUrl($shop->media->path, $shop->media->name);
        }
        $master_categories = $shop->masterCategories()->pluck('master_categories.id')->toArray();

        return view('admin::shops.edit', compact('shop', 'categories', 'master_categories'));
    }

    /**
     * Update resource
     *
     * @param UpdateShopRequest $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateShopRequest $request, int $id)
    {
        try {
            DB::begintransaction();
            $shop = $this->shopService->findById($id);
            // Upload and create media
            $data = $request->onlyFields();
            $file = $request->file('image');
            if ($file) {
                $path = ShopMedia::STORAGE_PATH;
                $dataInfo = $this->storageClient->uploadFile($file, $path, true);
                if ($shop->media) {
                    $media = $shop->media;
                    $this->storageClient->deleteFile($media->name, $media->path);
                    $media->update($dataInfo);
                } else {
                    $media = $this->mediaService->create($dataInfo);
                    $data['media_id'] = $media->id;
                }
            }

            // Save data
            $this->shopService->update($data, $id);
            $shop->masterCategories()->sync($data['master_categories'] ?? []);
            DB::commit();

            return redirect()->route('admin.shops.index')->withFlashSuccess(__('admin::messages.success.update'));
        } catch (Exception $e) {
            Log::error('[ERROR_UPDATE_CATEGORY]: '. $e->getMessage());
            DB::rollback();

            return redirect()->route('admin.shops.index')->withErrors(__('admin::messages.fail.update'));
        }//end try
    }
}
