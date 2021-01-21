<?php

namespace App\Http\Controllers\Admin;

use App\CountryList;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	 $this->middleware('permission:country-list-list|country-list-create|country-list-edit|country-list-delete', ['only' => ['index','store']]);
	     $this->middleware('permission:country-list-create', ['only' => ['create','store']]);
	     $this->middleware('permission:country-list-edit', ['only' => ['edit','update']]);
	     $this->middleware('permission:country-list-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
    	$countryLists = CountryList::orderBy('id','ASC')->cursor();
    	return view('admin.country.index',compact('countryLists'));
    }

    
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'country' => 'required| string| max:25 | unique:country_lists,country',
    		'country_iso_code_2' => 'required| string |min:2|max:2| unique:country_lists,country_iso_code_2',
    		'country_iso_code_3' => 'required| string |min:3|max:3| unique:country_lists,country_iso_code_3',
    		'country_un_code' => 'required| numeric| unique:country_lists,country_un_code'
    	]);
    	
    	$save = CountryList::create([
    		'country' => $request['country'],
    		'country_iso_code_2' => $request['country_iso_code_2'],
    		'country_iso_code_3' => $request['country_iso_code_3'],
    		'country_un_code' => $request['country_un_code']
    	]);
    	if (!empty($save)) {
    		Toastr::success(__('Record Stored Successfully'));
    		return redirect(route('countryList.index'));
    	}
    	else{
    		Toastr::error(__('Record Stored failed'));
    		return redirect(route('countryList.index'));
    	}
    	
    }

    public function edit($id)
    {
    	$country = CountryList::where('id',$id)->first();
    	if (!empty($country)) {
    		$countryLists = CountryList::orderBy('id','ASC')->cursor();
    		return view('admin.country.edit',compact('countryLists','country')); 
    	}
    	else{
    		Toastr::error(__('Record Updated Failed'));
    		return redirect(route('countryList.index'));
    	}
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request,[
    		'country' => 'required| string|max:25',
    		'country_iso_code_2' => 'required| string|min:2|max:2',
    		'country_iso_code_3' => 'required| string|min:3|max:3',
    		'country_un_code' => 'required| numeric'
    	]);

    	$country = CountryList::where('id',$id)->first();
    	if (!empty($country)) {
    		
    			$updated = $country->update([
	    		'country' => $request['country'],
	    		'country_iso_code_2' => $request['country_iso_code_2'],
	    		'country_iso_code_3' => $request['country_iso_code_3'],
	    		'country_un_code' => $request['country_un_code']
    		]);
    		
    		
    		if (!empty($updated)) {
    			Toastr::success(__('Record Updated Successfully'));
    			return redirect(route('countryList.index'));
    		}
    		else{
    			Toastr::error(__('Record Updated Failed'));
    			return redirect(route('countryList.index'));
    		}
    	}
    	else{
    		Toastr::error(__('Record Not Found'));
    		return redirect(route('countryList.index'));
    	}
    	
    }

    public function destroy($id)
    {
    	$country = CountryList::where('id',$id)->first();
    	if (!empty($country)) {
    		$country->forceDelete();
    		Toastr::success(__('Record Deleted Successfully'));
    		return redirect(route('countryList.index'));
    	}
    	else{
    		Toastr::error(__('Record Not Found'));
    		return redirect(route('countryList.index'));
    	}
    }
}
