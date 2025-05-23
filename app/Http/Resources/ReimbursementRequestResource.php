<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReimbursementRequestResource extends JsonResource
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
            'reimbursement_type'    => [
                'id'    => $this->reimbursement_type->id,
                'name'  => $this->reimbursement_type->name,
            ],
            'date'  => $this->date,
            'total'  => $this->total,
            'status'    => $this->status,
            'manager'   => $this->manager != null ? [
                'id'    => $this->manager->id
            ] : null,
            'expenses'  => $this->expenses->map(function($row){
                return [
                    'expenses_id'    => $row->reimbursement_expense_id,

                    'name'  => $row->name,
                    'value' => $row->value,
                ];
            }),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'approvers'   => $this->request?->approvers != null ? RequestApproverResource::collection($this->request->approvers) : null,
        ];
    }
}
