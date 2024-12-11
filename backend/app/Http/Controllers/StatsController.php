<?php

namespace App\Http\Controllers;

use App\Services\TopQueryService;
use App\Jobs\TopQueriesJob;

class StatsController extends Controller
{
  protected $topQueryService;

  public function __construct(TopQueryService $topQueryService)
  {
    $this->topQueryService = $topQueryService;
  }

  function topQueries()
  {
    $data = $this->topQueryService->all();
    // I need a way to sanitize this json output against XSS
    return response()->json($data, 200);
  }

  function runTopQueriesJob()
  {
    dispatch(new TopQueriesJob());
    return response()->json([
      "job" => "ok"
    ], 201);
  }
}