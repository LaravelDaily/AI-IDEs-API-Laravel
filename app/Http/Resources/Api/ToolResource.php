<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ToolResource extends JsonResource
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
            'slug' => $this->slug,
            'category' => $this->category,
            'website_url' => $this->website_url,
            'short_description' => $this->short_description,
            'vendor' => [
                'name' => $this->vendor->name,
            ],
            'versions' => VersionResource::collection($this->whenLoaded('versions')),
        ];
    }
}
