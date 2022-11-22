<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TutorResource extends JsonResource
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
            'user_name' => $this['user_name'],
            'timezone' => $this['timezone'],
            'email' => $this['email'],
            'password' => $this['password'],
            'image' => $this['image'],

            'Phone' => $this['Phone'],
            'country' => $this['country'],
            'city' => $this['city'],
            'address' => $this['address'],
            'Zipcode' => $this['Zipcode'],
            'language' => $this['language'],
            'video_id' => $this['video_id'],
            'commition_rate' => $this['commition_rate'],
            'biography' => $this['biography'],
            'status' => $this['status'],
            'phone_verified_at' => $this['phone_verified_at'],
            'in_hone_page' => $this['in_hone_page'],
            'featured' => $this['featured'],


            // 'created_at' => $this->created_at->format('m/d/Y'),
            // 'updated_at' => $this->updated_at->format('m/d/Y'),
          ];
    }
}
