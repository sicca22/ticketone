<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class EventResources extends JsonResource {
    public function toArray($request) {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'date' => $this->date,
            'cover_url' => $this->cover_url,
            'price' => $this->price,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'views_count' => $this->views_count,
            'comments_count' => $this->comments_count,
            'likes_count' => $this->likes_count,
            
        ];
    }
    }
