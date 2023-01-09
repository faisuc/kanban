<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class CardFilterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            return new ApiSuccessResponse(
                Card::query()
                    ->when($request->filled('date'), function ($query) use ($request) {
                        $query->where('created_at', $request->date);
                    })
                    ->when($request->filled('status') && $request->status == 0, function ($query) use ($request) {
                        $query->onlyTrashed();
                    })
                    ->when(! $request->filled('status'), function ($query) {
                        $query->withTrashed();
                    })
                    ->get(),
                [],
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
