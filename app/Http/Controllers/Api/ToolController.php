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
        $query = Tool::query()->with('vendor', 'pricingPlans');

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

            case 'cheapest_plan':
                $query->leftJoin('pricing_plans', 'tools.id', '=', 'pricing_plans.tool_id')
                    ->where(function ($q) {
                        $q->where('pricing_plans.price', '>', 0)
                            ->orWhereNull('pricing_plans.price');
                    })
                    ->where('pricing_plans.billing_period', 'monthly')
                    ->groupBy('tools.id')
                    ->orderByRaw('MIN(pricing_plans.price) ASC')
                    ->select('tools.*');
                break;

            case 'most_expensive_plan':
                $query->leftJoin('pricing_plans', 'tools.id', '=', 'pricing_plans.tool_id')
                    ->where('pricing_plans.price', '>', 0)
                    ->where('pricing_plans.billing_period', 'monthly')
                    ->groupBy('tools.id')
                    ->orderByRaw('MAX(pricing_plans.price) DESC')
                    ->select('tools.*');
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
            } elseif ($relation === 'pricing') {
                $query->with('pricingPlans');
            }
        }

        $tool = $query->firstOrFail();

        return new ToolResource($tool);
    }
}
