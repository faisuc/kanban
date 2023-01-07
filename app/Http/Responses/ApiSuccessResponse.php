<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class ApiSuccessResponse implements Responsable
{
    /**
     * @param mixed $data
     * @param array $metadata
     * @param int $code
     * @param array $headers
     */
    public function __construct(
        private mixed $data,
        private array $metadata = [],
        private int $code = Response::HTTP_OK,
        private array $headers = []
    ) {}
    
    /**
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request)
    {
        return response()->json(
            [
                'data' => $this->data,
                'meta_data' => $this->metadata,
            ],
            $this->code,
            $this->headers,
        );
    }
}
