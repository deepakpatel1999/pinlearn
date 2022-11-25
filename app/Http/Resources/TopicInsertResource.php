<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicInsertResource extends JsonResource
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
            'name' => $this['name'],
            'alias' => $this['alias'],
            'ordering' => $this['ordering'],
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),

        ];
    }
}