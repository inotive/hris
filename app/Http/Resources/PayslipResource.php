<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PayslipResource extends JsonResource
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
            'month' => Carbon::parse($this->year . '-' . $this->month .'-01')->format('F'),
            'month_period_start'    => $this->month_period_start,
            'month_period_end'  => $this->month_period_end,
            'sallary'   => $this->take_home_pay,
        ];
    }
}
