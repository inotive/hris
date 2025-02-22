<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestApproverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'id'   => $this->approver_employee_id,
            'name'  => $this->employee->full_name,
            'approver_status'   => $this->approver_status,
            'approver_level'    => $this->approver_level,
            'approved_at'    => $this->approved_at,
            'active'    => $this->active,
            'reason'    => $this->reason,
        ];
    }
}
