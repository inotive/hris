<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        if ($this->image != null) {
            $data['image'] = Storage::url($this->image);
        }

        $data['department'] = $this->department;
        $data['position'] = $this->position;
        $data['level'] = $this->level;
        $data['shift'] = $this->shift;
        $data['company'] = new CompanyResource($this->company);
        $data['head'] = new HeadEmployeeResource($this->head_department);
        return $data;
    }
}
