<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $images = $this->images;
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'image' => $images[0] ?? null,
        ];
    }
}
