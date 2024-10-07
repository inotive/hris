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
            'date'  => Carbon::parse($this->date)->format('Y-m-d'),
            'leave_type'    => $this->leave_type,
            'reason'    => $this->reason,
            'files' => FilesResource::collection($this->files),
            'status'    => $this->status,
            'created_at'    => $this->created_at,
        ];
    }
}
