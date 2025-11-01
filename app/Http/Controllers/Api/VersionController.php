<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\VersionResource;
use App\Models\Tool;
use App\Models\Version;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VersionController extends Controller
{
    public function latest(): AnonymousResourceCollection
    {
        // Get all tools with their latest version
        $tools = Tool::query()
            ->with(['versions' => function ($query) {
                $query->orderBy('release_date', 'desc')->limit(1);
            }])
            ->has('versions')
            ->get();

        // Extract the latest version from each tool
        $versions = $tools->map(function ($tool) {
            return $tool->versions->first();
        })->sortByDesc('release_date')->values();

        return VersionResource::collection($versions);
    }

    public function index(string $slug): AnonymousResourceCollection
    {
        $tool = Tool::query()->where('slug', $slug)->firstOrFail();

        $versions = Version::query()
            ->where('tool_id', $tool->id)
            ->orderBy('release_date', 'desc')
            ->get();

        return VersionResource::collection($versions);
    }

    public function show(string $slug, string $version): VersionResource
    {
        $tool = Tool::query()->where('slug', $slug)->firstOrFail();

        $versionModel = Version::query()
            ->where('tool_id', $tool->id)
            ->where('version', $version)
            ->firstOrFail();

        return new VersionResource($versionModel);
    }
}
