<?php

namespace App\Http\Controllers\Admin;

use App\CountryList;
use App\Http\Controllers\Controller;
use App\KuniadList;
use App\LibraryList;
use App\MazhabList;
use App\PersonCategoryList;
use App\PlaceList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class LibraryListController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
         $this->middleware('permission:library-list-list|library-list-create|library-list-edit|library-list-delete', ['only' => ['index','store']]);
         $this->middleware('permission:library-list-create', ['only' => ['create','store']]);
         $this->middleware('permission:library-list-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:library-list-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $libraryLists = LibraryList::orderBy('id','ASC')->get();
        return view('admin.library.index',compact('libraryLists'));
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $countries = CountryList::orderBy('country','ASC')->cursor();
        return view('admin.library.create', compact('countries'));  
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'libraryName' => 'required|string|max:100',
            'country' => 'sometimes|nullable',
            'city' => 'required_with:country',
            'stablishedYearHijri' => 'sometimes|integer|min:1|nullable',
            'stablishedYearIsae' => 'sometimes|integer|nullable',
            'website' => 'sometimes|nullable|url',
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable|string|max:15',
            'mobile' => 'sometimes|nullable|string|max:15',
            'facebook' => 'sometimes|nullable|url',
            'instagram' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'linkedIn' => 'sometimes|nullable|url',
            'youtube' => 'sometimes|nullable|url',
            'gMap' => 'sometimes|nullable|string'

        ]);
        $library = LibraryList::create([
            'libraryName' => $request['libraryName'],
            'placeID' => $request['city'],
            'stablishedYearHijri' => $request['stablishedYearHijri'],
            'stablishedYearIsae' => $request['stablishedYearIsae'],
            'web' => $request['website'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'mobile' => $request['mobile'],
            'facebook' => $request['facebook'],
            'twitter' => $request['twitter'],
            'instagram' => $request['instagram'],
            'linkedIn' => $request['linkedIn'],
            'youtube' => $request['youtube'],
            'locationMapLink' => $request['gMap'],

        ]);
        
        if (!empty($library)) {
            Toastr::success(__('Record Stored Successfully'));
        return redirect()->route('libraryList.index')
                        ->with('Record Stored Successfully');
        }
        else{
            Toastr::error(__('Record Stored Failed'));
            return redirect()->route('libraryList.index');
        }
        
    }

    public function show($id)
    {
        $findLibrary = LibraryList::find($id);
        if (!empty($findLibrary)) {
            $library = $findLibrary->load(['manuscripts','place']);
            return view('admin.library.show',compact('library'));
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect()->route('libraryList.index');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $library = LibraryList::find($id);

        if (!empty($library)) {
            
            $countries = CountryList::orderBy('country','ASC')->cursor();
            return view('admin.library.edit',compact('countries','library'));
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect()->route('libraryList.index');
        }
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'libraryName' => 'required|string|max:100',
            'country' => 'sometimes|nullable',
            'city' => 'required_with:country',
            'stablishedYearHijri' => 'sometimes|integer|min:1|nullable',
            'stablishedYearIsae' => 'sometimes|integer|nullable',
            'website' => 'sometimes|nullable|url',
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable|string|max:15',
            'mobile' => 'sometimes|nullable|string|max:15',
            'facebook' => 'sometimes|nullable|url',
            'instagram' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'linkedIn' => 'sometimes|nullable|url',
            'youtube' => 'sometimes|nullable|url',
            'gMap' => 'sometimes|nullable|string'

        ]);
        $library = LibraryList::find($id);
        if(!empty($library))
        {
           $updated = $library->update([
            'libraryName' => $request['libraryName'],
            'placeID' => $request['city'],
            'stablishedYearHijri' => $request['stablishedYearHijri'],
            'stablishedYearIsae' => $request['stablishedYearIsae'],
            'web' => $request['website'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'mobile' => $request['mobile'],
            'facebook' => $request['facebook'],
            'twitter' => $request['twitter'],
            'instagram' => $request['instagram'],
            'linkedIn' => $request['linkedIn'],
            'youtube' => $request['youtube'],
            'locationMapLink' => $request['gMap'],

            ]); 
           if (!empty($updated)) {
            Toastr::success(__('Record Updated Successfully'));
        return redirect()->route('libraryList.index')
                        ->with('Record Updated Successfully.');
            }
        else{
            Toastr::error(__('Record Updated Failed'));
            return redirect()->route('libraryList.index');
            }
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect()->route('libraryList.index');
        }
         
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $library = LibraryList::find($id);
        if (!empty($library)) {
            $library->forceDelete();
            Toastr::success(__('Record Deleted Successfully'));
            return redirect()->route('libraryList.index')
                        ->with('success','Records Deleted Successfully');
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect()->route('libraryList.index');
        }
        
    }

    public function getLibraryCity()
    {
        if (isset($_GET['country'])){
            $findCountry = $_GET['country'];
            $country = CountryList::where('id',$findCountry)->first();
            if(!empty($country)){
                $placeList = PlaceList::where('countryID',$country->id)->get();
            echo json_encode($placeList);
            }

            else{
                return response()->json(['error'=>"Records Not Found."]);
                
            }
        }
        else{
            return response()->json(['error'=>"Worng Reuquest."]);
        }
        
    }

    public function getLibrarycityUpdate()
    {
        if (isset($_GET['Country'])){
            $findCountry = $_GET['Country'];
            $country = CountryList::where('id',$findCountry)->first();
            if(!empty($country)){
                $placeList = PlaceList::where('countryID',$country->id)->get();
            echo json_encode($placeList);
            }

            else{
                return response()->json(['error'=>"Records Not Found."]);
                
            }
        }
        else{
            return response()->json(['error'=>"Worng Reuquest."]);
        }
        
    }
}
