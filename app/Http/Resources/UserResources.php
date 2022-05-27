<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class UserResources extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'mail' => $this->mail,
            'password' => $this->password,
            'authToken' => $this->authToken,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'birthDate' => $this->birthDate,
            'city' => $this->city,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    }
