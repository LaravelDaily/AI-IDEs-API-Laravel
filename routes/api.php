<?php

use App\Http\Controllers\Api\ToolController;
use App\Http\Controllers\Api\VersionController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,60')->group(function (): void {
    Route::get('/versions', [VersionController::class, 'index']);

    Route::get('/tools', [ToolController::class, 'index']);
    Route::get('/tools/{slug}', [ToolController::class, 'show']);
    Route::get('/tools/{slug}/versions', [VersionController::class, 'index']);
    Route::get('/tools/{slug}/versions/{version}', [VersionController::class, 'show']);
});
