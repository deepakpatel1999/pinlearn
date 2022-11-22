<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this['name'],
            'email' => $this['email'],
            'password' => $this['password'],
            //'image' => $this['image'],
            'image' => asset('/images/' .$this->image),
            'Phone' => $this['Phone'],
            'address' => $this['address'],
            'status' => $this['status'],
            // 'created_at' => $this->created_at->format('m/d/Y'),
            // 'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
