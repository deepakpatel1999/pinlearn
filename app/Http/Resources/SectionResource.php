<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'tutor_name' => $this['tutor_name'],
            'price' => $this['price'],
            'age' => $this['age'],
            'introduction_video_link' => asset('/images/video' . $this['introduction_video_link']),
            'description' => $this['description'],
            'cource_title' => $this['cource_title'],
            'image' => asset('/images/' . $this['image']),
            'end_of_my_course' => $this['end_of_my_course'],
            'students_need' => $this['students_need'],
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
