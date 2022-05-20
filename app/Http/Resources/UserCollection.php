<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection {
    public function toArray($request)
    {
        return [
            // Qui sto usando EventResource automaticamente
            // Sotto al cofano Lumen, utilizza JsonResource
            // per serializzare il singolo oggetto
            'data' => $this->collection,
            'error' => null,
        ];
    }
}
