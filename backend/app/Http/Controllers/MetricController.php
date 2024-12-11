<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveMetricRequest;
use App\Services\MetricService;

class MetricController extends Controller
{
  protected $service;

  public function __construct(MetricService $service)
  {
    $this->service = $service;
  }

  function saveMetric(SaveMetricRequest $request)
  {
    // Validate input 
    $validatedData = $request->validated();

    $this->service->save($validatedData);

    return response()->json([
      'message' => 'Metric registered successfully'
    ], 201);
  }
}
