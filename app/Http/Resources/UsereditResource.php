<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsereditResource extends JsonResource
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
            'id' => $this['id'],
            'role' => $this['roles'][0]['name'],
            'name' => $this['name'],
            'email' => $this['email'],
            'password' => $this['password'],
            'image' => asset('/images/' .$this['image']),
            'Phone' => $this['Phone'],
            'address' => $this['address'],
            'status' => $this['status'],
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
          ];
    }
}
