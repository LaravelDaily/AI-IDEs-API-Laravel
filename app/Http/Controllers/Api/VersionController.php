<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\VersionResource;
use App\Models\Tool;
use App\Models\Version;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VersionController extends Controller
{
    /**
    * @urlParam slug string optional Slug of the tool. Example: cursor
    */
    public function index(?string $slug = null): AnonymousResourceCollection
    {
        $query = Version::query()
            ->with('tool')
            ->orderBy('release_date', 'desc');

        if ($slug === null) {
            // Return latest 10 versions across all tools
            $versions = $query->limit(10)->get();
        } else {
            // Return all versions for the specific tool
            $tool = Tool::query()->where('slug', $slug)->firstOrFail();
            $versions = $query->where('tool_id', $tool->id)->get();
        }

        return VersionResource::collection($versions);
    }

    /**
    * @urlParam slug string required Slug of the tool. Example: cursor
    * @urlParam version string required Version number. Example: 2.0
    */
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
