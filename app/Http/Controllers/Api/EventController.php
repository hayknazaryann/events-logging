<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\FilterRequest;
use App\Http\Requests\Event\StoreRequest;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EventController extends Controller
{

    public function __construct(
        protected EventService $eventService
    )
    {}

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function create(StoreRequest $request): JsonResponse
    {
        return $this->eventService->create($request->user(), $request->validated());
    }

    /**
     * @param FilterRequest $request
     * @return JsonResponse
     */
    public function countByType(FilterRequest $request): JsonResponse
    {
        return $this->eventService->countByType($request->validated());
    }
}
