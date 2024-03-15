<?php
/**
 * Created by black40x@yandex.ru
 * Date: 07.10.2018
 */

namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

trait ApiControllerTrait
{
    /**
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function successResponse(array $data = [], string $message = '', int $statusCode = 200): JsonResponse
    {
        return Response::json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function errorResponse(string $message = '', int $statusCode = 400): JsonResponse
    {
        return Response::json([
            'status' => 'error',
            'message' => $message,
        ], $statusCode);
    }


}
