<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Contracts\Repositories\CustomerSliceRepositoryInterface;
use App\Enums\ViewPaths\Admin\CustomerSlice;
use App\Enums\ViewPaths\Admin\SocialMedia;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\CustomerSliceRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerSlicesController extends BaseController
{

    public function __construct(
        private readonly CustomerSliceRepositoryInterface $customerSliceRepo,
    )
    {
    }

    /**
     * @param Request|null $request
     * @param string|null $type
     * @return View Index function is the starting point of a controller
     * Index function is the starting point of a controller
     */
    public function index(Request|null $request, string $type = null): View
    {
        return $this->getView();
    }

    public function getView(): View
    {
        return view(CustomerSlice::VIEW[VIEW]);
    }

    public function getList(Request $request): JsonResponse
    {
        $data = $this->customerSliceRepo->getListWhere(orderBy: ['id' => 'desc'], dataLimit: 'all');
        $data->map(function ($customerSlice) {
            $customerSlice['name'] = translate($customerSlice['name']);
            $customerSlice['active_status'] = $customerSlice['status'];
        });
        return response()->json($data);
    }

    public function add(CustomerSliceRequest $request): JsonResponse
    {
        $this->customerSliceRepo->add(data: ['name' => $request['name']]);
        return response()->json(['status' => 'success']);
    }

    public function getUpdate(Request $request): JsonResponse
    {
        $data = $this->customerSliceRepo->getFirstWhere(params: ['id' => $request['id']]);
        return response()->json($data);
    }

    public function update(CustomerSliceRequest $request): JsonResponse
    {
        $this->customerSliceRepo->update(id: $request['id'], data: ['name' => $request['name']]);
        return response()->json(['status' => 'update']);
    }

    public function delete(Request $request): JsonResponse
    {
        $this->customerSliceRepo->delete(params: ['id' => $request['id']]);
        return response()->json();
    }

    public function updateStatus(Request $request): JsonResponse|RedirectResponse
    {
        $this->customerSliceRepo->update(id: $request['id'], data: ['status' => $request['status']]);
        Toastr::success(translate('status_updated_successfully'));
        return $request->ajax() ? response()->json(['success' => 1], 200) : back();
    }

}
