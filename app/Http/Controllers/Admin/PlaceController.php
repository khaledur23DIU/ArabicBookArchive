<?php

namespace App\Http\Controllers\Admin;

use App\CountryList;
use App\Http\Controllers\Controller;
use App\PlaceList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	 $this->middleware('permission:place-list-list|place-list-create|place-list-edit|place-list-delete', ['only' => ['index','store']]);
	     $this->middleware('permission:place-list-create', ['only' => ['create','store']]);
	     $this->middleware('permission:place-list-edit', ['only' => ['edit','update']]);
	     $this->middleware('permission:place-list-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
    	$countryLists = CountryList::orderBy('id','ASC')->cursor();
    	$placeLists = PlaceList::orderBy('id','ASC')->cursor();
    	return view('admin.place.index',compact('placeLists','countryLists'));
    }

    
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'country' => 'required',
    		'city' => 'required| string | max:50'
    	]);

    	$save = PlaceList::create([
    		'countryID' => $request['country'],
    		'city' => $request['city']
    	]);

    	if (!empty($save)) {
    		Toastr::success(__('Record Stored Successfully'));
    		return redirect(route('placeList.index'));
    	}
    	else{
    		Toastr::error(__('Record Stored failed'));
    		return redirect(route('placeList.index'));
    	}
    	
    }

    public function edit($id)
    {
    	$place = PlaceList::where('id',$id)->first();
    	if (!empty($place)) {
    		$placeLists = PlaceList::orderBy('id','ASC')->cursor();
    		$countryLists = CountryList::orderBy('id','ASC')->cursor();
    		return view('admin.place.edit',compact('placeLists','place','countryLists')); 
    	}
    	else{
    		Toastr::error(__('Record Updated Failed'));
    		return redirect(route('placeList.index'));
    	}
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request,[
    		'country' => 'required',
    		'city' => 'required| string | max:50'
    	]);

    	$place = PlaceList::where('id',$id)->first();
    	if (!empty($place)) {
    		
    		$updated = $place->update([
	    		'countryID' => $request['country'],
    			'city' => $request['city']
    		]);
    		
    		
    		if (!empty($updated)) {
    			Toastr::success(__('Record Updated Successfully'));
    			return redirect(route('placeList.index'));
    		}
    		else{
    			Toastr::error(__('Record Updated Failed'));
    			return redirect(route('placeList.index'));
    		}
    	}
    	else{
    		Toastr::error(__('Record Not Found'));
    		return redirect(route('placeList.index'));
    	}
    	
    }

    public function destroy($id)
    {
    	$place = PlaceList::where('id',$id)->first();
    	if (!empty($place)) {
    		$place->forceDelete();
    		Toastr::success(__('Record Deleted Successfully'));
    		return redirect(route('placeList.index'));
    	}
    	else{
    		Toastr::error(__('Record Not Found'));
    		return redirect(route('placeList.index'));
    	}
    }
}
