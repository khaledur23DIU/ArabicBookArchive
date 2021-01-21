<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PersonCategoryList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PersonCategoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	 $this->middleware('permission:personCategory-list-list|personCategory-list-create|personCategory-list-edit|personCategory-list-delete', ['only' => ['index','store']]);
	     $this->middleware('permission:personCategory-list-create', ['only' => ['create','store']]);
	     $this->middleware('permission:personCategory-list-edit', ['only' => ['edit','update']]);
	     $this->middleware('permission:personCategory-list-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
    	$personCategories = PersonCategoryList::orderBy('id','ASC')->cursor();
    	return view('admin.personCategory.index',compact('personCategories'));
    }

    
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'person_category' => 'required| string| max:100| unique:person_category_lists,person_category'
    	]);

    	$save = PersonCategoryList::create(['person_category' => $request['person_category']]);
    	if (!empty($save)) {
    		Toastr::success(__('Record Stored Successfully.'));
    		return redirect(route('personCategoryList.index'));
    	}
    	else{
    		Toastr::error(__('Record Stored failed'));
    		return redirect(route('personCategoryList.index'));
    	}
    	
    }

    public function edit($id)
    {
        if ($id == 1 || $id == 2 || $id == 3 || $id == 4 || $id != 5 || $id == 6 || $id == 7) {
            Toastr::warning('No Permission to Edit');
            return redirect(route('personCategoryList.index'));
        }
    	$personCategory = PersonCategoryList::where('id',$id)->first();
    	if (!empty($personCategory)) {
    		$personCategories = PersonCategoryList::orderBy('id','ASC')->cursor();
    		return view('admin.personCategory.edit',compact('personCategories','personCategory')); 
    	}
    	else{
    		Toastr::error(__('Record Updated Failed'));
    		return redirect(route('personCategoryList.index'));
    	}
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request,[
    		'person_category' => 'required| string| max:100| unique:person_category_lists,person_category'
    	]);
        if ($id == 1 || $id == 2 || $id == 3 || $id == 4 || $id != 5 || $id == 6 || $id == 7) {
            Toastr::warning(__('No Permission to Update'));
            return redirect(route('personCategoryList.index'));
        }

    	$personCategory = PersonCategoryList::where('id',$id)->first();
    	if (!empty($personCategory)) {
    		$updated = $personCategory->update(['person_category' => $request['person_category']]);
    		if (!empty($updated)) {
    			Toastr::success(__('Record Updated Successfully'));
    			return redirect(route('personCategoryList.index'));
    		}
    		else{
    			Toastr::error(__('Record Updated Failed'));
    			return redirect(route('personCategoryList.index'));
    		}
    	}
    	else{
    		Toastr::error(__('Record Not Found'));
    		return redirect(route('personCategoryList.index'));
    	}
    	
    }

    public function destroy($id)
    {
        if ($id == 1 || $id == 2 || $id == 3 || $id == 4 || $id != 5 || $id == 6 || $id == 7) {
            Toastr::warning(__('No Permission to Delete'));
            return redirect(route('personCategoryList.index'));
        }
    	$personCategory = PersonCategoryList::where('id',$id)->first();
    	if (!empty($personCategory)) {
    		$personCategory->forceDelete();
            Toastr::success(__('Record Deleted Successfully'));
    		return redirect(route('personCategoryList.index'));
    	}
    	else{
            Toastr::error(__('Record Not Found'));
    		return redirect(route('personCategoryList.index'));
    	}
    }
}
