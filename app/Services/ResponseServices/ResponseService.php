<?php

namespace App\Services\ResponseServices;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResponseService
{
    public static function successResponse($data, $message, $status = Response::HTTP_OK): JsonResponse
    {
        if ($data instanceof JsonResource && isset($data?->response()?->getData()->links))
        {
            $data = [
                'data' => $data,
                'links' => $data->response()->getData()->links,
                'meta' => $data->response()->getData()->meta,
            ];
        }

        $response = ['status' => $status, 'data' => $data, 'message' => $message];

        return response()->json($response, $status);
    }

    public static function errorResponse($message, $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $response = ['status' => $status, 'message' => $message];

        return response()->json($response, $status);
    }
}
