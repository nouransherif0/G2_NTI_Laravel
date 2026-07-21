<?php

namespace App\Http\Controllers\Api\V1\AddOns;

use App\Http\Controllers\Controller;
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
}