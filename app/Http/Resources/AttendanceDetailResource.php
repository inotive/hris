<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AttendanceDetailResource extends JsonResource
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

        if ($this->clockin_image != null) {
            $data['clockin_image'] = Storage::url($this->clockin_image);
        }

        if ($this->clockout_image != null) {
            $data['clockout_image'] = Storage::url($this->clockout_image);
        }

        $data['employee_shift'] = $this->employee_shift ?? null;

        return $data;
    }
}
