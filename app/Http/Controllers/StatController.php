<?php

namespace App\Http\Controllers;

use App\Services\StatService;
use Flugg\Responder\Http\Responses\ResponseBuilder;
use Flugg\Responder\Responder;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function all(Responder $responder, StatService $statService): ResponseBuilder
    {
        return $responder->success([
            'total' => $statService->totalCount(),
        ]);
    }

    public function my(Request $request, Responder $responder, StatService $statService): ResponseBuilder
    {
        return $responder->success([
            'total' => $statService->userCount($request->user()),
        ]);
    }
}
