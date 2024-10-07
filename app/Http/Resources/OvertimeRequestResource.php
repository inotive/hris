<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OvertimeRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'    => $this->id,
            'overtime_shift_request'    => [
                'id'    => $this->overtime_shift_request->id,
                'name'  => $this->overtime_shift_request->name,
            ],
            'start_shift_time'  => $this->start_shift_date_time,
            'end_shift_time'  => $this->end_shift_date_time,
            'compensation'  => $this->compensation,
            'work_note'  => $this->work_note,
            'manager'   => $this->manager != null ? [
                'id'    => $this->manager->id
            ] : null,
            'files' => FilesResource::collection($this->files),
            'status'    => $this->status,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
