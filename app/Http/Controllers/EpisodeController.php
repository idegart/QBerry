<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Flugg\Responder\Http\Responses\ResponseBuilder;
use Flugg\Responder\Responder;

class EpisodeController extends Controller
{
    /**
     * Get list of episodes
     *
     * @param Responder $responder
     * @return ResponseBuilder
     */
    public function index(Responder $responder): ResponseBuilder
    {
        return $responder->success(Episode::query()->paginate());
    }

    /**
     * Get one episode
     *
     * @param Episode $episode
     * @param Responder $responder
     * @return ResponseBuilder
     */
    public function show(Episode $episode, Responder $responder): ResponseBuilder
    {
        return $responder->success($episode->load('characters', 'quotes'));
    }
}
