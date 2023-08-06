<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KomikDetailResource extends JsonResource
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
            'name' => $this->name,
            'last_episode' => $this->last_episode,
            'id_genre' => $this->genre,
            'id_status' => $this->status, // mengambil semua data
            // 'id_status' => $this->whenLoaded('status'), // jadi jika disertakan dengan with sebelumnya kana terpanggil jika tidak maka tidak akan terpanggil
            'id_status_just_one' => $this->status->name, // hanya mengambil name saja
            'description' => $this->description,
        ];
    }
}
