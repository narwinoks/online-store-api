<?php

namespace App\Http\Resources\Variants;

use App\Http\Resources\Color\ColorResource;
use App\Http\Resources\Products\Item\SizeResource as ItemSizeResource;
use App\Http\Resources\Size\SizeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
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
            'color' => new ColorResource($this->color),
            'size' => ItemSizeResource::collection($this->item)
        ];
    }
}
