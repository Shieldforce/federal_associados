<?php

namespace App\Http\Resources;

use App\Models\Permission;
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
            'id'           => $this->id,
            'name'         => $this->name,
            'email'        => $this->email,
            'access_token' => $request->bearerToken(),
            'roles'        => array_unique($this->roles->pluck("name")->toArray()),
            'permissions'  => $this->allPermissions(),
            'file_link'    => $this->file_link,
            'created_at'   => $this->created_at->diffForHumans(),
            'updated_at'   => $this->updated_at->diffForHumans(),
        ];
    }
}
