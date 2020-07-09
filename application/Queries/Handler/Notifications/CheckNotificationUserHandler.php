<?php


namespace Application\Queries\Handler\Notifications;


use Application\Queries\Query\Notifications\CheckNotificationUserQuery;
use Application\Queries\Results\Notifications\NotificationsListResult;
use Application\Services\Users\UserServiceInterface;
use Domain\Enums\AdminRoles;
use Domain\Interfaces\Services\Notifications\NotificationServiceInterface;
use Infrastructure\QueryBus\Handler\HandlerInterface;
use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

class CheckNotificationUserHandler implements HandlerInterface
{
    private UserServiceInterface $userService;

    private NotificationServiceInterface $notificationService;

    public function __construct(
        UserServiceInterface $userService,
        NotificationServiceInterface $notificationService
    )
    {
        $this->userService = $userService;
        $this->notificationService = $notificationService;
    }

    /**
     * @param CheckNotificationUserQuery $query
     * @return ResultInterface
     */
    public function handle($query): ResultInterface
    {
        $user = $this->userService->findOneByIdOrFail($query->getId());

        $notifications = [];

        if($user->isCustomer()) {
            $this->notificationService->findByEmail($user->getEmail());

            return new NotificationsListResult($notifications);
        }

        if ($user->isEmployee()) {

            $roles = $user->getEmployee()->getRole();
            foreach ($roles as $role) {
                $notificationsList = $this->notificationService->findByRole($role);

                foreach ($notificationsList as $item) {
                    array_push($notifications, $item->getMessage());
                }
            }

            return new NotificationsListResult($notifications);
        }

        if($user->isAdmin()) {
            $role = AdminRoles::ADMIN;

            $notifications = $this->notificationService->findByRole($role);

            return new NotificationsListResult($notifications);
        }
    }
}
