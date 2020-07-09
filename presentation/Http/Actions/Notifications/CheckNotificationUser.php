<?php


namespace Presentation\Http\Actions\Notifications;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Enums\HttpCodes;

class CheckNotificationUser
{
    public function __construct()
    {

    }

    public function __invoke(Request $request)
    {
        return new JsonResponse([
            'data' => [
                'notifications' => array(),
            ],
        ], HttpCodes::OK);
    }
}
