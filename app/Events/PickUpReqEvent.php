<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PickUpReqEvent extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($req, $inv_id, $is_eligible_for_sign_up_discount, $address)
    {
        //dd($req);
        $this->req = $req;
        $this->inv_id = $inv_id;
        $this->is_eligible_for_sign_up_discount = $is_eligible_for_sign_up_discount;
        $this->address = $address;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
