<?php

use Illuminate\Support\Facades\Route;
use Kurnosovmak\Parts\Parts\Infra\Controllers\Api\Parts\PartController;


Route::get('part/get/id{part_id}', [PartController::class, 'getPartById']);
Route::get('part/get/slug_{part_slug}', [PartController::class, 'getPartBySlug']);
Route::get('part/', [PartController::class, 'get']);
Route::get('part/search', [PartController::class, 'search']);