<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MazhabList;
use App\MazhabTypeList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MazhabController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	$this->middleware('permission:mazhab-list|mazhab-create|mazhab-edit|mazhab-delete', ['only' => ['index','store']]);
	    $this->middleware('permission:mazhab-create', ['only' => ['create','store']]);
	    $this->middleware('permission:mazhab-edit', ['only' => ['edit','update']]);
	    $this->middleware('permission:mazhab-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
    	$mazhabList = MazhabList::orderBy('id','ASC')->cursor();
        $mazhabTypes = MazhabTypeList::orderBy('id','ASC')->cursor();
    	return view('admin.mazhab.index',compact('mazhabList','mazhabTypes'));
    }

    public function deleteMultiple(Request $request)
    {
        $requested_ids = $request->ids;
        $ids = array();
        $ids = explode(",",$request->ids);
        if (!empty($ids)) {
            $found_ids = MazhabList::whereIn('id',$ids)->get();
            if (count($ids) == count($found_ids)) {

                $deleted = MazhabList::whereIn('id',$ids)->forceDelete();
                if (!empty($deleted)) {
                    return response()->json(['success'=>"Records Deleted successfully."]);   
                }
                else{
                    return response()->json(['error'=>"Records Deleted failed!"]); 
                }
            }
            else{
                return response()->json(['error'=>"Inappropriate Request, Please try with correct request!"]);
            }
        }

        else{
            return response()->json(['error'=>"Empty Data set, Please try with correct request!"]);
        }
        
    }

    
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'mazhabType' => 'required',
            'mazhab' => 'required| string|max:100'
    	]);

        if (!empty($mazhabType = MazhabTypeList::find($request['mazhabType']))) {
            
    	   $saved = MazhabList::create(['mazhabType' => $mazhabType->id,
                                        'mazhabName' => trim($request['mazhab'])
                                        ]);
        	if (!empty($saved)) {
        		Toastr::success(__('Record Stored Successfully'));
        		return redirect(route('mazhabList.index'));
        	}
        	else{
        		Toastr::error(__('Record Stored Failed'));
        		return redirect(route('mazhabList.index'));
        	}
        }
        else{
            Toastr::error(__('Mazhab Type Not found'));
            return redirect(route('mazhabList.index'));
        }
    	
    }

    public function edit($id)
    {
    	$mazhab = MazhabList::where('id',$id)->first();
    	if (!empty($mazhab)) {
    		$mazhabList = MazhabList::orderBy('id','ASC')->cursor();
            $mazhabTypes = MazhabTypeList::orderBy('id','ASC')->cursor();
    		return view('admin.mazhab.edit',compact('mazhabTypes','mazhabList','mazhab')); 
    	}
    	else{
            Toastr::error(__('Record Not Found'));
    		return redirect(route('mazhab.index'));
    	}
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request,[
    		'mazhabType' => 'required',
            'mazhab' => 'required| string|max:100'
    	]);

    	if (!empty($mazhabType = MazhabTypeList::find($request['mazhabType']))) {
            if (!empty($mazhab = MazhabList::where('id',$id)->first())) {
                
           $updated = $mazhab->update(['mazhabType' => $mazhabType->id,
                                        'mazhabName' => trim($request['mazhab'])
                                        ]);
                if (!empty($updated)) {
                    Toastr::success(__('Record Updated Successfully'));
                    return redirect(route('mazhabList.index'));
                }
                else{
                    Toastr::error(__('Record Updated Failed'));
                    return redirect(route('mazhabList.index'));
                }
            }
            else{
                Toastr::error(__('Mazhab not Found'));
                return redirect(route('mazhabList.index'));
            }
            
        }
        else{
            Toastr::error(__('Mazhab Type Not found'));
            return redirect(route('mazhabList.index'));
        }
    	
    }

    public function destroy($id)
    {
    	$mazhab = MazhabList::where('id',$id)->first();
    	if (!empty($mazhab)) {
    		$mazhab->forceDelete();
            Toastr::success(__('Record Deleted Successfully'));
    		return redirect(route('mazhabList.index'));
    	}
    	else{
            Toastr::success(__('Record not Found'));
    		return redirect(route('mazhabList.index'));
    	}
    }
}
