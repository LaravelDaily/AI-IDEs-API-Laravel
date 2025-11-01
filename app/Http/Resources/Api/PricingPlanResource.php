<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PricingPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'billing_period' => $this->billing_period,
            'price' => $this->price,
            'currency' => $this->currency,
            'features' => $this->features,
            'is_deprecated' => $this->is_deprecated,
            'last_updated_date' => $this->last_updated_date?->toDateString(),
        ];
    }
}
