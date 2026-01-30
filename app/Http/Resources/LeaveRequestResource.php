<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveRequestResource extends JsonResource
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
            'employee_id'   => $this->employee_id,
            'employee_name' => $this->employee != null ? $this->employee->full_name : null,
            'date'  => Carbon::parse($this->date)->format('Y-m-d'),
            'start_date'  => Carbon::parse($this->start_date)->format('Y-m-d'),
            'end_date'  => Carbon::parse($this->end_date)->format('Y-m-d'),
            'leave_type'    => $this->leave_type,
            'reason'    => $this->reason,
            'files' => FilesResource::collection($this->files),
            'status'    => $this->status,
            'approvers'   => $this->request?->approvers != null ? RequestApproverResource::collection($this->request->approvers) : null,
            'created_at'    => $this->created_at,
        ];
    }
}
