<?php

namespace Merlinpanda\Rbac\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Merlinpanda\Account\Models\User;
use Merlinpanda\Rbac\Models\App;

/**
 * 当给用户赋予某个角色之后
 */
class onAssignRolesForUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, App $app, string $login_method)
    {
        $this->user = $user;
        $this->app = $app;
        $this->login_method = $login_method;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
