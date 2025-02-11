<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class System extends JsonResource
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
            'id'      => $this->id,
            'room_id' => $this->room_id,
            'name'    => $this->name,
            'state'   => $this->state,
        ];
    }
}
