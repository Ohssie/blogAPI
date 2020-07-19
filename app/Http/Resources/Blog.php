<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Blog extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      // return parent::toArray($request);
      return [
        'id' => $this->id,
        'featured_image' => $this->featured_image,
        'title' => $this->title,
        'body' => $this->body,
        'slug' => $this->slug,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
      ];
    }
}
