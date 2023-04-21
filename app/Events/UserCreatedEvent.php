<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var User $_user
     */
    protected $_user;
    /**
     * @var array $_userData
     */
    protected $_userData;

    /**
     * UserCreatedEvent constructor.
     * @param User $user
     * @param array $data
     */
    public function __construct(User $user, $data = [])
    {
        $this->_user = $user;
        $this->_userData = $data;
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

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param string $key
     * @return array|null
     */
    public function getUserData($key = null)
    {
        if(null !== $key){
            return isset($this->_userData[$key]) ? $this->_userData[$key] : null;
        }
        return $this->_userData;
    }
}
