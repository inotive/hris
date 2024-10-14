<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReimbursementType;
use Illuminate\Http\Request;

class ReimbursementController extends Controller
{
    public function reimburesementType(Request $request)
    {
        $company_id = $request->company_id ?? auth()->user()->company_id;
        $list = ReimbursementType::where('company_id', $company_id)->orderBy('name')->pluck('name','id');

        $data = [];
        foreach ($list as $key => $value) {
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'status'    => 'success',
            'data'      => $data,
        ];
    }
}
