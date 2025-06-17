<?php

namespace App\Http\Controllers;

use App\Helpers\PayslipHelper;

class PayslipController extends Controller
{
    public function print($id)
    {
        return (new PayslipHelper())->print($id);
    }

    public function view($id)
    {
        return (new PayslipHelper())->view($id);
    }
}
