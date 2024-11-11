<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayslipDetailResource extends JsonResource
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
            'total_earning' => $this->total_payslip_earning,
            'total_deduction' => $this->total_payslip_deduction,
            'take_home_pay' => $this->take_home_pay,
            'pay_date'  => $this->pay_date,
            'earnings'  => PayslipDetailEarningDeductionResource::collection($this->earning_details),
            'deductions'  => PayslipDetailEarningDeductionResource::collection($this->deduction_details),
            'methode'   => $this->metode,
            'account_name'  => $this->account_name,
            'account_number' => $this->account_number,
            'file'  => $this->file,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
