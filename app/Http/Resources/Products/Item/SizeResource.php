<?php

namespace App\Http\Resources\Products\Item;

use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
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
            'size' => $this->size->name,
            'sku' => $this->sku,
            'price' => $this->price,
            'discount' => $this->discount,
            'quantity' => $this->quantity
        ];
    }
}
