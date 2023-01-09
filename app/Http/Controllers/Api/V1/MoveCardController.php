<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cards\MoveCardRequest;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class MoveCardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card $card
     * @return \Illuminate\Http\Response
     */
    public function __invoke(MoveCardRequest $request, Card $card)
    {
        try {
            return new ApiSuccessResponse(
                tap($card)->update($request->validated()),
                ['message' => 'Card was updated successfully'],
                Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                $exception->getMessage(),
                $exception
            );
        }
    }
}
