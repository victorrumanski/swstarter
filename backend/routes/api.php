<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetricController;
use App\Http\Controllers\StatsController;

Route::post('/metrics', [MetricController::class, 'saveMetric']);
Route::get('/topqueries', [StatsController::class, 'topQueries']);
Route::get('/runtopqueries', [StatsController::class, 'runTopQueriesJob']);