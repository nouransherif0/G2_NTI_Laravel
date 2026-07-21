<?php

namespace App\Http\Resources\AddOns;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddOnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
   return [
  'id' => $this->id,
  'name' => $this->name,
 'price_adjustment' => number_format($this->price_adjustment, 2),
   ];
    }
}