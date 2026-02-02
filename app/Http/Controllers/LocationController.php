<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Get all countries.
     */
    public function getCountries()
    {
        // Fetch from Master Table
        $countries = \App\Models\Country::orderBy('name')->get(['name']);
        
        // Merge with any distinct values from company table (legacy support)
        // $dbValues = \App\Models\Company::select('country')->distinct()->pluck('country')->toArray();
        // $merged = $countries->pluck('name')->merge($dbValues)->unique()->filter()->values();
        
        // Just return master data mixed with 'Indonesia' check? 
        // User asked to use the tables as container.
        
        return response()->json($countries); 
    }

    /**
     * Get provinces by country name.
     */
    public function getProvinces(Request $request)
    {
        $countryName = $request->input('country_id'); // Frontend sends NAME
        
        $country = \App\Models\Country::where('name', $countryName)->first();
        
        if (!$country) return response()->json([]);

        $provinces = $country->provinces()->orderBy('name')->get(['name']);
        return response()->json($provinces);
    }

    /**
     * Get cities by province name.
     */
    public function getCities(Request $request)
    {
        $provinceName = $request->input('province_id'); // Frontend sends NAME
        
        $province = \App\Models\Province::where('name', $provinceName)->first();

        if (!$province) return response()->json([]);

        $cities = $province->cities()->orderBy('name')->get(['name']);
        return response()->json($cities);
    }
    
    public function getDistricts(Request $request)
    {
        $city = $request->input('city_id');
        $dbValues = \App\Models\Company::where('city', $city)->select('district')->distinct()->pluck('district')->toArray();
         $data = [];
        foreach($dbValues as $v) {
             if(!empty($v)) $data[] = ['name' => $v];
        }
        return response()->json($data);
    }

    public function getSubDistricts(Request $request)
    {
        $district = $request->input('district_id');
        $dbValues = \App\Models\Company::where('district', $district)->select('sub_district')->distinct()->pluck('sub_district')->toArray();
         $data = [];
        foreach($dbValues as $v) {
             if(!empty($v)) $data[] = ['name' => $v];
        }
        return response()->json($data);
    }
}
