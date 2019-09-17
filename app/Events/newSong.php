<?php

namespace App\Events;

use App\SongWunsch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class newSong implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $song;

    /**
     *
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SongWunsch $song)
    {
        $this->song = $song;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('song-channel');
    }

    public function broadcastWith()
    {
        return [
            'titel' => $this->song->song_titel,
            'interpret' => $this->song->song_interpret,
            'event_id' => $this->song->event_id,
            'gespielt' => $this->song->gespielt,
            'ranking' => $this->song->ranking,
            //'uhrzeit' => $this->song->uhrzeit,
        ];
    }
}
