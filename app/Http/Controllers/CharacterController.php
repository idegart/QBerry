<?php

namespace App\Http\Controllers;

use App\Http\Requests\Character\IndexRequest;
use App\Repositories\CharacterRepository;
use Flugg\Responder\Http\Responses\ResponseBuilder;
use Flugg\Responder\Responder;

class CharacterController extends Controller
{
    private CharacterRepository $characterRepository;

    public function __construct(CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    /**
     * Get list of characters
     *
     * @param IndexRequest $request
     * @param Responder $responder
     * @return ResponseBuilder
     */
    public function index(IndexRequest $request, Responder $responder): ResponseBuilder
    {
        return $responder->success(
            $this->characterRepository->index($request)->paginate()
        );
    }

    /**
     * Get random character
     *
     * @param Responder $responder
     * @return ResponseBuilder
     */
    public function random(Responder $responder): ResponseBuilder
    {
        return $responder->success(
            $this->characterRepository->random()->first()
        );
    }
}
