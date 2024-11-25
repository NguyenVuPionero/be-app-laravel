<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('createResponse')) {
    /**
     * Create a standardized JSON response.
     *
     * @param string $status
     * @param string $message
     * @param array|null $data
     * @param int $code
     * @return JsonResponse
     */
    function createResponse(string $status, string $message, array $data = null, int $code = 200): JsonResponse
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }
}
