<?php

namespace App\Http\Controllers\Admin;

use App\BookCategoryList;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	 $this->middleware('permission:bookCategory-list|bookCategory-create|bookCategory-edit|bookCategory-delete', ['only' => ['index','store']]);
	     $this->middleware('permission:bookCategory-create', ['only' => ['create','store']]);
	     $this->middleware('permission:bookCategory-edit', ['only' => ['edit','update']]);
	     $this->middleware('permission:bookCategory-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
    	$bookCategories = BookCategoryList::orderBy('id','ASC')->cursor();
    	return view('admin.bookCategory.index',compact('bookCategories'));
    }

    
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'bookCategory' => 'required| string |max:255 | unique:book_category_lists,bookCategory'
    	]);

    	$save = BookCategoryList::create(['bookCategory' => $request['bookCategory']]);
    	if (!empty($save)) {
    		Toastr::success(__('Record Stored Successfully.'));
    		return redirect(route('bookCategory.index'));
    	}
    	else{
    		Toastr::error(__('Record Stored failed!'));
    		return redirect(route('bookCategory.index'));
    	}
    	
    }

    public function edit($id)
    {
    	$bookCategory = BookCategoryList::where('id',$id)->first();
    	if (!empty($bookCategory)) {
    		$bookCategories = BookCategoryList::orderBy('id','ASC')->cursor();
    		return view('admin.bookCategory.edit',compact('bookCategories','bookCategory')); 
    	}
    	else{
    		Toastr::error(__('Record Updated Failed!'));
    		return redirect(route('bookCategory.index'));
    	}
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request,[
    		'bookCategory' => 'required|string|max:255|unique:book_category_lists,bookCategory'
    	]);

    	$bookCategory = BookCategoryList::find($id);
    	if (!empty($bookCategory)) {
    		$updated = $bookCategory->update(['bookCategory' => $request->bookCategory]);
    		if (!empty($updated)) {
    			Toastr::success(__('Record Updated Successfully.'));
    			return redirect(route('bookCategory.index'));
    		}
    		else{
    			Toastr::error(__('Record Updated Failed!'));
    			return redirect(route('bookCategory.index'));
    		}
    	}
    	else{
    		Toastr::error(__('Record Not Found!'));
    		return redirect(route('bookCategory.index'));
    	}
    	
    }

    public function destroy($id)
    {
    	$bookCategory = BookCategoryList::where('id',$id)->first();
    	if (!empty($bookCategory)) {
    		$bookCategory->forceDelete();
            Toastr::success(__('Record Deleted Successfully.'));
    		return redirect(route('bookCategory.index'));
    	}
    	else{
            Toastr::error(__('Record Not Found!'));
    		return redirect(route('bookCategory.index'));
    	}
    }
}
