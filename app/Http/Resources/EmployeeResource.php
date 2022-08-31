<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return array(
            'id' => $this->id,
            'nik' => $this->nik,
            'name' => $this->name,
            'unit' => UnitResource::make($this->unit),
            'position_name' => $this->position_name,
            'date_of_birth' => $this->date_of_birth->format('m/d/Y'),
            'place_of_birth' => $this->place_of_birth,
            'updated_by' => $this->editor->name ?? null,
            'updated_at' => $this->updated_at->diffForHumans(),
        );
    }
}
