<?php


namespace Application\Queries\Results\Notifications;


use Infrastructure\QueryBus\Result\ResultInterface;

class NotificationsListResult implements ResultInterface
{
    private $notifications;

    public function __construct($notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * @return mixed
     */
    public function getNotifications()
    {
        return $this->notifications;
    }
}
