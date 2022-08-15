<?php

namespace App\Http\Resources\Addrress;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type->name,
            'province' => $this->province,
            'city' => $this->city,
            'districts' => $this->districts,
            'postalCode' => $this->postalCode,
            'content' => $this->content
        ];
    }
}
