<?php

namespace Mabrouk\PermissionSimple\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->display_name,
            'selected' => $this->isSelected,
            // 'description' => $this->description,
            'sub_permissions' => SubPermissionResource::collection($this->subPermissions),
        ];
    }
}
