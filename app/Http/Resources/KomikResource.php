<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KomikResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request); // Return semua data yang didapat

        // hanya mengirimkan data yang ingin dikirim
        return [
            'id' => $this->id, //field id yang dikirim
            'name' => $this->name, //field name yang dikirim
            'slug' => $this->slug,
            'last_episode' => $this->last_episode,
            'picture' => $this->picture,
            'created_at' => date_format($this->created_at, 'd-M-Y'),
        ];
    }
}
