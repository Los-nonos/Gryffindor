<?php


namespace Presentation\Http\Actions\Notifications;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\QueryBus\QueryBusInterface;
use Presentation\Http\Adapters\Notifications\CheckNotificationUserAdapter;
use Presentation\Http\Enums\HttpCodes;
use Presentation\Http\Presenters\Notifications\NotificationsUserPresenter;

class CheckNotificationUserAction
{
    private CheckNotificationUserAdapter $adapter;

    private QueryBusInterface $queryBus;

    private NotificationsUserPresenter $presenter;

    public function __construct(
        CheckNotificationUserAdapter $adapter,
        QueryBusInterface $queryBus,
        NotificationsUserPresenter $presenter
    )
    {
        $this->adapter = $adapter;
        $this->queryBus = $queryBus;
        $this->presenter = $presenter;
    }

    public function __invoke(Request $request)
    {
        $query = $this->adapter->from($request);

        $result = $this->queryBus->handle($query);

        return new JsonResponse([
            'data' => [
                'notifications' => $this->presenter->fromResult($result)->getData(),
            ],
        ], HttpCodes::OK);
    }
}
