<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'email'        => $this->email,
            'roles'        => $this->roles->pluck('name'),
            'permissions'  => $this->allPermissions(),
            'file_link'    => $this->file_link,
            'created_at'   => $this->created_at->diffForHumans(),
            'updated_at'   => $this->updated_at->diffForHumans(),
        ];
    }
}
