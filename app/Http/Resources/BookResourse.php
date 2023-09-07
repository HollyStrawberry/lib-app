<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id' => $this->id,
          'title' => $this->title,
          'pub_type' => $this->pub_type,
          'user' => $this->user->name,
          'created_at' => $this->created_at,
          'updated_at' => $this->updated_at,
        ];
    }
}
