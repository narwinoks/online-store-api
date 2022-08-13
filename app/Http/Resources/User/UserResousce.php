<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResousce extends JsonResource
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
            'username' => $this->username,
            'firstName' => $this->firstName,
            'firstName' => $this->firstName,
            'lastNane' => $this->lastName,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'joinAt' => $this->created_at->diffForHumans()
        ];
    }
}
