<?php

namespace Application\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Domain\ValueObjects\Email;

class SendEmailWithData
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Email $data;

    public function __construct(Email $email)
    {
        $this->data = $email;
    }



    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
