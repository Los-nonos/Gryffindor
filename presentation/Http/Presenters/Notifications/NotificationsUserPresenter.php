<?php


namespace Presentation\Http\Presenters\Notifications;


use Application\Queries\Results\Notifications\NotificationsListResult;

class NotificationsUserPresenter
{
    private NotificationsListResult $result;

    public function fromResult($result): NotificationsUserPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData() {

        $notifications = $this->result->getNotifications();
        $notificationsList = [];

        foreach ($notifications as $notification) {
            array_push($notificationsList, [
                'id' => $notification->getId(),
                'subject' => $notification->getSubject(),
                'message' => $notification->getMessage(),
                'read' => $notification->getRead(),
            ]);
        }

        return $notificationsList;
    }
}
