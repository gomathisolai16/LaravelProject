<?php

namespace App\Events;

use App\Models\News;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class ImageAttachedToNews
 * @package App\Events
 */
class ImageAttachedToNews
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var News $_news
     */
    protected $_news;

    /**
     * Create a new event instance.
     *
     * @param News $news
     * @return void
     */
    public function __construct(News $news)
    {
        $this->_news = $news;
    }

    /**
     * @return News
     */
    public function getNews()
    {
        return $this->_news;
    }

    /**
     * @param News $news
     */
    public function setNews($news)
    {
        $this->_news = $news;
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
