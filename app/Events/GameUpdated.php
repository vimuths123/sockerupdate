<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\Game;

class GameUpdated implements ShouldBroadcast
{
    use SerializesModels;

    public $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function broadcastOn()
    {
        return new Channel('games');
    }

    public function broadcastWith()
    {
        return [
            'game' => $this->game->load(['teamA', 'teamB'])
        ];
    }
}
