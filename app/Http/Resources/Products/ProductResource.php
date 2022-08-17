<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Reviews\ReviewResource;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Variants\VariantResource;
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
            'content' => $this->content,
            'variant' => VariantResource::collection($this->variant),
            'publishedAt' => $this->created_at->diffForHumans(),
            'shop' => $this->shop,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'image' => ImageResource::collection($this->image),
            'tag' => TagResource::collection($this->tag)
        ];
    }
}
