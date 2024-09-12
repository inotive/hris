<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use CrudTrait;

    public $model = Company::class;
    public $route = 'companies';
    public $page_title = 'Companies';
}
