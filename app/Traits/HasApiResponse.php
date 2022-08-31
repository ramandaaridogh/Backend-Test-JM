<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HasApiResponse
{
    /**
     * success response method.
     *
     * @param array|string $result
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendResponse($result, string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message ?? 'success',
            'data' => $result,
        ];
        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error, array $errorMessages = [], int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
            'data' => $errorMessages ?? [],
        ];

        return response()->json($response, $code);
    }
}
