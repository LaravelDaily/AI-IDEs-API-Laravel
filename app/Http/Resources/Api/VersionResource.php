<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VersionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'version' => $this->version,
            'tool' => $this->tool?->name,
            'release_date' => $this->release_date?->toDateString(),
            'description' => $this->description,
            'changelog_url' => $this->changelog_url,
        ];
    }
}
