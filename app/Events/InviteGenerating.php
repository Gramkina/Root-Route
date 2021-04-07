<?php

namespace App\Events;

use App\Models\Invites;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class InviteGenerating{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $invite;

    public function __construct(Invites $invite){
        $this->invite = $invite;
        $this->invite->code = Str::uuid();
    }

    public function broadcastOn(){
        return new PrivateChannel('channel-name');
    }
}
