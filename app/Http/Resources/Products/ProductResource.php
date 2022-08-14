<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Image\ImageResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'Summary' => $this->Summary,
            'sku' => $this->sku,
            'price' => $this->price,
            'discount' => $this->discount,
            'quantity' => $this->quantity,
            'shop' => $this->shop,
            'content' => $this->content,
            'publishedAt' => $this->created_at->diffForHumans(),
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'image' => ImageResource::collection($this->image)
        ];
    }
}
