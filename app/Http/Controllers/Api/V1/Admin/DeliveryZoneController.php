<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryZones\StoreDeliveryZoneRequest;
use App\Http\Requests\DeliveryZones\UpdateDeliveryZoneRequest;
use App\Http\Resources\DeliveryZones\DeliveryZoneResource;
use App\Services\DeliveryZones\DeliveryZoneService;

class DeliveryZoneController extends Controller
{
    public function __construct(protected DeliveryZoneService $deliveryZoneService) {}

    public function index()
    {
        $zones = $this->deliveryZoneService->getAllZones();
        return DeliveryZoneResource::collection($zones);
    }

    public function store(StoreDeliveryZoneRequest $request)
    {
        $data = $request->validated();
        $zone = $this->deliveryZoneService->createZone($data);
        return new DeliveryZoneResource($zone);
    }

    public function update(UpdateDeliveryZoneRequest $request, $id)
    {
        $data = $request->validated();
        $zone = $this->deliveryZoneService->updateZone($id, $data);
        return new DeliveryZoneResource($zone);
    }

    public function destroy($id)
    {
        $this->deliveryZoneService->deleteZone($id);
        return response()->json(['message' => 'Delivery zone deleted successfully']);
    }
}