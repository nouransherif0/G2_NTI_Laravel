<?php

namespace App\Http\Controllers\Api\V1\DeliveryZones;

use App\Http\Controllers\Controller;
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
}