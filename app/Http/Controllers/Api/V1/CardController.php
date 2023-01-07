<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cards\CreateCardRequest;
use App\Http\Requests\Cards\UpdateCardRequest;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCardRequest $request)
    {
        try {
            return new ApiSuccessResponse(
                Card::create($request->validated() + ['owner_id' => $request->user()->id]),
                ['message' => 'Card was created successfully'],
                Response::HTTP_CREATED
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                $exception->getMessage(),
                $exception
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card $card
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardRequest $request, Card $card)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        try {
            return new ApiSuccessResponse(
                $card->delete(),
                ['message' => 'Card was deleted successfully'],
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
