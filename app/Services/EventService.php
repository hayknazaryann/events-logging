<?php

namespace App\Services;

use App\Jobs\ProcessEventJob;
use App\Models\Event;
use App\Models\User;
use App\Traits\ApiControllerTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class EventService
{
    use ApiControllerTrait;

    /**
     * @param User $user
     * @param array $data
     * @return JsonResponse
     */
    public function create(User $user, array $data): JsonResponse
    {
        dispatch(new ProcessEventJob($user, $data));
        return $this->successResponse(
            message: __('Event processed successfully.')
        );
    }

    /**
     * @param array $params
     * @return JsonResponse
     */
    public function countByType(array $params): JsonResponse
    {
        $eventsCount = Event::query()->whereBetween('timestamp', [$params['start_date'], $params['end_date']])
            ->groupBy('event_type')
            ->selectRaw('event_type, count(*) as count')
            ->count();

        return $this->successResponse(
            data: [
                'count' => $eventsCount
            ],
            message: __('Event count by interval and event type.')
        );
    }
}
