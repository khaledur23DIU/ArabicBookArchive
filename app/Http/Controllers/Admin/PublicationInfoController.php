<?php

namespace App\Http\Controllers\Admin;

use App\CountryList;
use App\Http\Controllers\Controller;
use App\PersonCategoryList;
use App\PlaceList;
use App\PublisherList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PublicationInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
         $this->middleware('permission:publication-info-list|publication-info-create|publication-info-edit|publication-info-delete', ['only' => ['index','store']]);
         $this->middleware('permission:publication-info-create', ['only' => ['create','store']]);
         $this->middleware('permission:publication-info-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:publication-info-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $pubLists = PublisherList::orderBy('id','ASC')->cursor();
        return view('admin.publisher.index',compact('pubLists'));
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $publishers = PersonCategoryList::where('person_category','owner')->first()->load('persons');
        $countries = CountryList::orderBy('country','ASC')->cursor();
        return view('admin.publisher.create', compact('countries','publishers'));  
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
            'ownerID' => 'required',
            'publicationName' => 'required|string|max:100',
            'country' => 'sometimes|nullable',
            'city' => 'required_with:country',
            'stablishedYearHijri' => 'sometimes|nullable|integer|min:1',
            'stablishedYearIsae' => 'sometimes|nullable|integer',
            'website' => 'sometimes|nullable|url',
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable|string|max:15',
            'mobile' => 'sometimes|nullable|string|max:15',
            'facebook' => 'sometimes|nullable|url',
            'instagram' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'linkedIn' => 'sometimes|nullable|url',
            'youtube' => 'sometimes|nullable|url',
            'gMap' => 'sometimes|nullable|url'

        ]);
        $publication = PublisherList::create([
            'ownerID' => $request['ownerID'],
            'publicationName' => $request['publicationName'],
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
        
        if (!empty($publication)) {
            Toastr::success(__('Record Stored Successfully'));
        return redirect()->route('publicationInfo.index');
        }
        else{
            Toastr::error(__('Record Stored Failed'));
            return redirect()->route('publicationInfo.index');
        }
        
    }

    public function show($id)
    {
        $findPublisher  = PublisherList::find($id);
        if (!empty($findPublisher)) {
            $publisher = $findPublisher->load(['person','place']);
            return view('admin.publisher.show',compact('publisher'));
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect()->route('publicationInfo.index');
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
        $publisher = PublisherList::where('id',$id)->first();

        if (!empty($publisher)) {
            
            $countries = CountryList::orderBy('country','ASC')->cursor();
            $publishers = PersonCategoryList::where('person_category','owner')->first()->load('persons');
            return view('admin.publisher.edit',compact('countries','publisher','publishers'));
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect()->route('publicationInfo.index');
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
            'ownerID' => 'required',
            'publicationName' => 'required|string|max:100',
            'country' => 'sometimes|nullable',
            'city' => 'required_with:country',
            'stablishedYearHijri' => 'sometimes|nullable|integer|min:1',
            'stablishedYearIsae' => 'sometimes|nullable|integer',
            'website' => 'sometimes|nullable|url',
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable|string|max:15',
            'mobile' => 'sometimes|nullable|string|max:15',
            'facebook' => 'sometimes|nullable|url',
            'instagram' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'linkedIn' => 'sometimes|nullable|url',
            'youtube' => 'sometimes|nullable|url',
            'gMap' => 'sometimes|nullable|url'

        ]);
        $publisher = PublisherList::where('id',$id)->first();
        if(!empty($publisher))
        {
           $updated = $publisher->update([
            'ownerID' => $request['ownerID'],
            'publicationName' => $request['publicationName'],
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
        return redirect()->route('publicationInfo.index');
            }
        else{
            Toastr::error(__('Record Updated Failed'));
            return redirect()->route('publicationInfo.index');
            }
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect()->route('publicationInfo.index');
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
        $publisher = PublisherList::where('id',$id)->first();
        if (!empty($publisher)) {
            $publisher->forceDelete();
            Toastr::success(__('Record Deleted Successfully'));
            return redirect()->route('publicationInfo.index');
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect()->route('publicationInfo.index');
        }
        
    }

    public function getPublicationCity()
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

    public function getPublicationcityUpdate()
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
}
