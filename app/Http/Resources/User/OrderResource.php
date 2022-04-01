<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Admin\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'paid' => $this->paid,
            'product' => ProductResource::make($this->product),
        ];
    }
}
