<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Flugg\Responder\Http\Responses\ResponseBuilder;
use Flugg\Responder\Responder;

class EpisodeController extends Controller
{
    public function index(Responder $responder): ResponseBuilder
    {
        return $responder->success(Episode::query()->paginate());
    }

    public function show(Episode $episode, Responder $responder): ResponseBuilder
    {
        return $responder->success($episode->load('characters', 'quotes'));
    }
}
