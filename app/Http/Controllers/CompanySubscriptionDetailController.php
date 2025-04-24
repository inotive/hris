<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\CompanySubscriptionPerCompany;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Http\Request;

class CompanySubscriptionDetailController extends Controller
{
    public function index(Company $company, Request $request)
    {
        $list = CompanySubscription::search($request->search)->where('company_id', $company->id)
            ->paginate();

        return view('company_subscription_detail.index',[
            'list'  => $list,
            'company'  => $company,
            'page_title'=>'Subscription',
        ]);
    }


    public function create(Company $company, Request $request)
    {
        $form = new CompanySubscription([
            'company_id'    => $company->id,
        ]);
        return view('company_subscription_detail.create',[
            'company'  => $company,
            'form'  => $form,
        ]);
    }

    public function edit(Company $company, $id, Request $request)
    {
        return view('company_subscription_detail.edit',[
            'company'  => $company,
            'form'  => CompanySubscription::find($id),
        ]);
    }


    public function store(Company $company, Request $request)
    {
        $request->validate((new CompanySubscription())->rules);

        $form = new CompanySubscription();
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('company-subscriptions-detail.index', $company),
        ];
    }


    public function update(Company $company, $id, Request $request)
    {

        $request->validate((new CompanySubscription())->rules);

        $form = CompanySubscription::find($id);
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('company-subscriptions-detail.index', $company),
        ];
    }


    public function destroy(Company $company, $id, Request $request)
    {
        try{

            CompanySubscription::where('id', $id)->delete();
        
            return [
                'success'   => true,
                'meessage'  => 'Deleted',
            ];
        }catch(Exception $e) {

            return [
                'success'   => false,
                'meessage'  => 'Error',
            ];
        }
    }
}
