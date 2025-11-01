<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ToolResource;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ToolController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Tool::query()->with('vendor');

        // Load versions if requested (default true)
        if ($request->boolean('include_versions', true)) {
            $query->with(['versions' => function ($query) {
                $query->orderBy('release_date', 'desc')->limit(5);
            }]);
        }

        $orderBy = $request->input('order_by', 'name');
        $orderDirection = $request->input('order_direction', 'asc');

        switch ($orderBy) {
            case 'name':
                $query->orderBy('name', $orderDirection);
                break;

            case 'latest_version':
                $query->leftJoin('versions', 'tools.id', '=', 'versions.tool_id')
                    ->groupBy('tools.id')
                    ->orderByRaw('MAX(versions.release_date) DESC')
                    ->select('tools.*');
                break;
        }

        $tools = $query->get();

        return ToolResource::collection($tools);
    }

    /**
     * @urlParam slug string required Slug of the tool. Example: cursor
     */
    public function show(Request $request, string $slug): ToolResource
    {
        $query = Tool::query()->where('slug', $slug)->with('vendor');

        // Parse include parameter to load requested relationships
        $include = $request->input('include', '');
        $includes = array_filter(array_map('trim', explode(',', $include)));

        foreach ($includes as $relation) {
            if ($relation === 'versions') {
                $query->with(['versions' => function ($query) {
                    $query->orderBy('release_date', 'desc');
                }]);
            }
        }

        $tool = $query->firstOrFail();

        return new ToolResource($tool);
    }
}
