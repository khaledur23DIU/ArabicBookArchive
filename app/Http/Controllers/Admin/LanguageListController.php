<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LanguageList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class LanguageListController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	 $this->middleware('permission:language-list-list|language-list-create|language-list-edit|language-list-delete', ['only' => ['index','store']]);
	     $this->middleware('permission:language-list-create', ['only' => ['create','store']]);
	     $this->middleware('permission:language-list-edit', ['only' => ['edit','update']]);
	     $this->middleware('permission:language-list-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
    	$languageLists = LanguageList::orderBy('id','ASC')->cursor();
    	return view('admin.languages.index',compact('languageLists'));
    }

    
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'language' => 'required| string| unique:language_lists,language',
    		'language_iso_code_2' => 'required| string|min:2|max:2| unique:language_lists,language_iso_code_2',
    		'language_iso_code_3' => 'required| string|min:3|max:3| unique:language_lists,language_iso_code_3'
    	]);

    	$save = LanguageList::create([
    		'language' => $request['language'],
    		'language_iso_code_2' => $request['language_iso_code_2'],
    		'language_iso_code_3' => $request['language_iso_code_3']
    	]);
    	if (!empty($save)) {
    		Toastr::success(__('Record Stored Successfully'));
    		return redirect(route('languageList.index'));
    	}
    	else{
    		Toastr::error(__('Record Stored failed'));
    		return redirect(route('languageList.index'));
    	}
    	
    }

    public function edit($id)
    {
    	$language = LanguageList::where('id',$id)->first();
    	if (!empty($language)) {
    		$languageLists = LanguageList::orderBy('id','ASC')->cursor();
    		return view('admin.languages.edit',compact('languageLists','language')); 
    	}
    	else{
    		Toastr::error(__('Record Updated Failed'));
    		return redirect(route('languageList.index'));
    	}
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request,[
    		'language' => 'required| string',
    		'language_iso_code_2' => 'required| string|min:2|max:2',
    		'language_iso_code_3' => 'required| string |min:3|max:3'
    	]);

    	$country = LanguageList::where('id',$id)->first();
    	if (!empty($country)) {
    		
    			$updated = $country->update([
	    		'language' => $request['language'],
	    		'language_iso_code_2' => $request['language_iso_code_2'],
	    		'language_iso_code_3' => $request['language_iso_code_3']
    		]);
    		
    		
    		if (!empty($updated)) {
    			Toastr::success(__('Record Updated Successfully'));
    			return redirect(route('languageList.index'));
    		}
    		else{
    			Toastr::error(__('Record Updated Failed'));
    			return redirect(route('languageList.index'));
    		}
    	}
    	else{
    		Toastr::error(__('Record Not Found'));
    		return redirect(route('languageList.index'));
    	}
    	
    }

    public function destroy($id)
    {
    	$language = LanguageList::where('id',$id)->first();
    	if (!empty($language)) {
    		$language->forceDelete();
    		Toastr::success(__('Record Deleted Successfully'));
    		return redirect(route('languageList.index'));
    	}
    	else{
    		Toastr::error(__('Record Not Found'));
    		return redirect(route('languageList.index'));
    	}
    }
}
