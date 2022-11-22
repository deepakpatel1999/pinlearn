<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryUpdateResource extends JsonResource
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
            'id' => $request->id,
             'name' => $request->name,
            'alias' => $request->alias,
            'ordering' =>$request->ordering,
            'image' =>asset('/images' .$request->image),
            'status' => $request->status,
            // 'created_at' => $this->created_at->format('m/d/Y'),
            // 'updated_at' => $this->updated_at->format('m/d/Y'),
          ];
    }
}
