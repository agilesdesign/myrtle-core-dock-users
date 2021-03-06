<?php

namespace Myrtle\Core\Users\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Myrtle\Core\Users\Models\User;

class UserUpdating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

	/**
	 * Create a new event instance.
	 *
	 * @param User $user
	 */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
		return new PrivateChannel('users.' . $this->user->id);
    }
}
