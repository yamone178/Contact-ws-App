<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
          'fistName'=>  $this->firstName,
            'lastName'=>   $this-> lastName,
           'phone'=> $this->phone,
           'email'=> $this->email,
            'image'=> $this->image,
            'jobTitle'=> $this->jobTitle,
            'birthday'=> $this->birthday,
            'note' => $this->note,
            'owner'=>new UserResource(Auth::user())

        ];
    }
}
