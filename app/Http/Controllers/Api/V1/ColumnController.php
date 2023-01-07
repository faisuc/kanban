<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Columns\CreateColumnRequest;
use App\Http\Requests\Columns\UpdateColumnRequest;
use App\Http\Resources\ColumnResource;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Board;
use App\Models\Column;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class ColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Board $board)
    {
        return new ApiSuccessResponse(
            new ColumnResource($board->columns),
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Column $column
     * @return \Illuminate\Http\Response
     */
    public function store(CreateColumnRequest $request)
    {
        try {
            return new ApiSuccessResponse(
                Column::create($request->validated() + ['owner_id' => $request->user()->id]),
                ['message' => 'Column was created successfully'],
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
    public function show(Board $board, Column $column)
    {
        return new ApiSuccessResponse(
            new ColumnResource($column),
            [],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Column $column
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateColumnRequest $request, Column $column)
    {
        try {
            return new ApiSuccessResponse(
                tap($column)->update($request->validated()),
                ['message' => 'Column was updated successfully'],
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
     * @param  \App\Models\Column $column
     * @return \Illuminate\Http\Response
     */
    public function destroy(Column $column)
    {
        try {
            return new ApiSuccessResponse(
                $column->delete(),
                ['message' => 'Column was deleted successfully'],
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
