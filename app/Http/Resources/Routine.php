<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Routine extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'trigger_at' => $this->trigger_at,
            'actions'    => $this->actions->map(fn($action) => [
                'id'      => $action->id,
                'room_id' => $action->room_id,
                'state'   => $action->state,
            ])
        ];
    }
}
