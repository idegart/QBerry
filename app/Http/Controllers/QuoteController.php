<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quote\RandomRequest;
use App\Models\Quote;
use App\Repositories\QuoteRepository;
use Flugg\Responder\Http\Responses\ResponseBuilder;
use Flugg\Responder\Responder;

class QuoteController extends Controller
{
    private QuoteRepository $quoteRepository;

    public function __construct(QuoteRepository $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * Get list of quotes
     *
     * @param Responder $responder
     * @return ResponseBuilder
     */
    public function index(Responder $responder): ResponseBuilder
    {
        return $responder->success(Quote::query()->paginate());
    }

    /**
     * Get random quote
     *
     * @param RandomRequest $request
     * @param Responder $responder
     * @return ResponseBuilder
     */
    public function random(RandomRequest $request, Responder $responder): ResponseBuilder
    {
        return $responder->success(
            $this->quoteRepository->randomByAuthor($request->author())->first()
        );
    }
}
