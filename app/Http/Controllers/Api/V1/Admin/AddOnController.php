<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddOns\StoreAddOnRequest;
use App\Http\Requests\AddOns\UpdateAddOnRequest;
use App\Http\Resources\AddOns\AddOnResource;
use App\Services\AddOns\AddOnService;

class AddOnController extends Controller
{
    public function __construct(protected AddOnService $addOnService) {}

    public function index()
    {
        $addOns = $this->addOnService->getAllAddOns();
        return AddOnResource::collection($addOns);
    }

    public function store(StoreAddOnRequest $request)
    {
        $data = $request->validated();
        $addOn = $this->addOnService->createAddOn($data);
        return new AddOnResource($addOn);
    }

    public function update(UpdateAddOnRequest $request, $id)
    {
        $data = $request->validated();
        $addOn = $this->addOnService->updateAddOn($id, $data);
        return new AddOnResource($addOn);
    }

    public function destroy($id)
    {
        $this->addOnService->deleteAddOn($id);
        return response()->json(['message' => 'Add-on deleted successfully']);
    }
}