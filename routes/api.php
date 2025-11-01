<?php

use App\Http\Controllers\Api\ToolController;
use App\Http\Controllers\Api\VersionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/versions', [VersionController::class, 'latest']);

Route::get('/tools', [ToolController::class, 'index']);
Route::get('/tools/{slug}', [ToolController::class, 'show']);
Route::get('/tools/{slug}/versions', [VersionController::class, 'index']);
Route::get('/tools/{slug}/versions/{version}', [VersionController::class, 'show']);
