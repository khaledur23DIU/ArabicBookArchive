<?php

namespace App\Http\Controllers\Admin;

use App\CountryList;
use App\Http\Controllers\Controller;
use App\MazhabList;
use App\PersonCategoryList;
use App\PersonList;
use App\PersonListResidence;
use App\PlaceList;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
        $this->middleware('permission:person-list-list|person-list-create|person-list-edit|person-list-delete', ['only' => ['index','store']]);
         $this->middleware('permission:person-list-create', ['only' => ['create','store']]);
         $this->middleware('permission:person-list-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:person-list-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $persons = PersonList::where('draft',0)->get();
        $personLists = $persons->load(['person_categories','person_written_books','person_followers','person_mentors','person_quotations','person_residences','person_students','person_teachers','birthPlace','deathPlace','mazhab_fikih','mazhab_akidah']);

    	return view('admin.person.index', compact('personLists'));
    }

    public function create()
    {
        
        $students = PersonCategoryList::where('person_category','student')->first()->load('persons');
        $teachers = PersonCategoryList::where('person_category','teacher')->first()->load('persons');
        $countries = CountryList::orderBy('country','ASC')->cursor();
        $placeLists = PlaceList::orderBy('city','ASC')->cursor();
        $mazhabFikih = MazhabList::where('mazhabType',1)->cursor();
        $mazhabAkidah = MazhabList::where('mazhabType',2)->cursor();
        $personCategories = PersonCategoryList::orderBy('person_category','ASC')->cursor();
        
    	return view('admin.person.create', compact('countries','personCategories','placeLists','mazhabFikih','mazhabAkidah','students','teachers'));
    }

    public function store(Request $request)
    {
         
    	$this->validate($request,[
            'personName' => 'required|string|max:100',
            'fathersName' => 'sometimes|nullable|string|max:100',
            'surName' => 'sometimes|nullable|string|max:100',
            'birthYearHijri' => 'sometimes|nullable|integer|min:1',
            'birthYearIsae' => 'sometimes|nullable|integer',
            'birthCountry' => 'sometimes|nullable',
            'birthCity' => 'required_with:birthCountry|nullable',
            'deathYearHijri' => 'sometimes|nullable|integer|min:1|gte:birthYearHijri',
            'deathYearIsae' => 'sometimes|nullable|integer|gte:birthYearIsae',
            'deathCountry' => 'sometimes|nullable',
            'deathCity' => 'required_with:deathCountry|nullable',
            'reCountry.*' => 'sometimes|nullable',
            'reCity.*' => 'required_with:reCountry.*|nullable',
            'reStartYearHijri.*' => 'sometimes|nullable|integer|min:1',
            'reEndYearHijri.*' => 'sometimes|nullable|integer|min:1|gte:reStartYearHijri.*',
            'reStartYearIsae.*' => 'sometimes|nullable|integer',
            'reEndYearIsae.*' => 'sometimes|nullable|integer|gte:reStartYearIsae.*',
            'writtenBook.*' => 'sometimes|nullable|string|max:225',
            'teacher' => 'sometimes|nullable',
            'student' => 'sometimes|nullable',
            'inspiredBy' => 'sometimes|nullable',
            'quotation.*' => 'sometimes|nullable|string',
            'inspiredWhom' => 'sometimes|nullable',
            'kuniad' => 'sometimes|nullable|string|max:100',
            'popularity' => 'sometimes|nullable|string',
            'mazhabFikih' => 'sometimes|nullable',
            'mazhabAkidah' => 'sometimes|nullable',
            'personCategory' => 'required',
            'description' => 'sometimes|nullable|string'

        ]);


        $person = PersonList::create([
            'personName' => $request->personName,
            'fathersName' => $request->fathersName,
            'surName' => $request->surName,
            'birthYearHijri' => $request->birthYearHijri,
            'birthYearIsae' => $request->birthYearIsae,
            'birthPlaceID' => $request->birthCity,
            'deathYearHijri' => $request->deathYearHijri,
            'deathYearIsae' => $request->deathYearIsae,
            'deathPlaceID' => $request->deathCity,
            'kuniad' => $request->kuniad,
            'popularity' => $request->popularity,
            'mazhabFikih' => $request->mazhabFikih,
            'mazhabAkidah' => $request->mazhabAkidah,
            'description' => $request->description,
            'draft' => false
        ]);

        if (!empty($person)) {
            if (!empty($request->reCity) && count($request->reCity) > 0 && $request->has('reCity')) {
                for ($i=0; $i < count($request->reCity) ; $i++) { 
                    $person->person_residences()->create([
                        'residencePlaceID' => $request->reCity[$i],
                        'reStartYearHijri' => $request->reStartYearHijri[$i],
                        'reEndYearHijri' => $request->reEndYearHijri[$i],
                        'reStartYearIsae' => $request->reStartYearIsae[$i],
                        'reEndYearIsae' => $request->reEndYearIsae[$i]
                    ]);
                }
            }
            if ($request->writtenBook[0] != NULL && count($request->writtenBook) > 0 && $request->has('writtenBook')) {
                for ($i=0; $i < count($request->writtenBook) ; $i++) { 
                    $person->person_written_books()->create([
                        'writtenBook' => $request->writtenBook[$i],
                    ]);
                }
            }

            if ( ($request->quotation[0]) != NULL && count($request->writtenBook) > 0 && $request->has('quotation')) {
                for ($i=0; $i < count($request->quotation) ; $i++) { 
                    $person->person_quotations()->create([
                        'quotation' => $request->quotation[$i]
                    ]);
                }
            }

            if (!empty($request->student) && $request->has('student')) {
                $person->person_students()->attach($request->student);
            }

            if (!empty($request->teacher) && $request->has('teacher')) {
                $person->person_teachers()->attach($request->teacher);
            }

            if (!empty($request->inspiredBy) && $request->has('inspiredBy')) {
                $person->person_mentors()->attach($request->inspiredBy);
            }

            if (!empty($request->inspiredWhom) && $request->has('inspiredWhom')) {
                $person->person_followers()->attach($request->inspiredWhom);
            }


            if (!empty($request->personCategory) && $request->has('personCategory')) {
                $person->person_categories()->attach($request->personCategory);
            }
        
            Toastr::success(__('Record Stored Successfully'));
            return redirect(route('person-info.index'));

        }
        else{
            Toastr::error(__('Record Stored Failed'));
            return redirect(route('person-info.index'));
        }
    }

    public function show($id)
    {
        $findPerson = PersonList::find($id);

        if (!empty($findPerson)) {
            $person = PersonList::where('id',$id)->first()->load(['person_categories','person_written_books','person_followers','person_mentors','person_quotations','person_residences','person_students','person_teachers','birthPlace','deathPlace','mazhab_fikih','mazhab_akidah']);
        

        return view('admin.person.show', compact('person'));
        }

        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('person-info.index'));
        }
        
    }

    public function edit($id)
    {
        $findPerson = PersonList::where('id',$id)->first();
        if (!empty($findPerson)) {
          
            $students = PersonCategoryList::where('person_category','student')->first()->load('persons');
            $teachers = PersonCategoryList::where('person_category','teacher')->first()->load('persons');
            $countries = CountryList::orderBy('country','ASC')->cursor();
            $placeLists = PlaceList::orderBy('city','ASC')->cursor();
            $mazhabFikih = MazhabList::where('mazhabType',1)->cursor();
            $mazhabAkidah = MazhabList::where('mazhabType',2)->cursor();
            $personCategories = PersonCategoryList::orderBy('person_category','ASC')->cursor();
            $person = $findPerson->load(['person_categories','person_students','person_teachers','person_followers','person_mentors','person_written_books','person_quotations','person_residences','birthPlace','deathPlace','mazhab_fikih','mazhab_akidah','person_list_books','published_book_infos']);
            return view('admin.person.edit', compact('countries','personCategories','placeLists','mazhabFikih','mazhabAkidah','students','teachers','person'));
        }

        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('person-info.index'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'personName' => 'required|string|max:100',
            'fathersName' => 'sometimes|nullable|string|max:100',
            'surName' => 'sometimes|nullable|string|max:100',
            'birthYearHijri' => 'sometimes|nullable|integer|min:1',
            'birthYearIsae' => 'sometimes|nullable|integer',
            'birthCountry' => 'sometimes|nullable',
            'birthCity' => 'required_with:birthCountry|nullable',
            'deathYearHijri' => 'sometimes|nullable|integer|min:1|gte:birthYearHijri',
            'deathYearIsae' => 'sometimes|nullable|integer|gte:birthYearIsae',
            'deathCountry' => 'sometimes|nullable',
            'deathCity' => 'required_with:deathCountry|nullable',
            'reCountry.*' => 'sometimes|nullable',
            'reCity.*' => 'required_with:reCountry.*|nullable',
            'reStartYearHijri.*' => 'sometimes|nullable|integer|min:1',
            'reEndYearHijri.*' => 'sometimes|nullable|integer|min:1|gte:reStartYearHijri.*',
            'reStartYearIsae.*' => 'sometimes|nullable|integer',
            'reEndYearIsae.*' => 'sometimes|nullable|integer|gte:reStartYearIsae.*',
            'writtenBook.*' => 'sometimes|nullable|string|max:225',
            'teacher' => 'sometimes|nullable',
            'student' => 'sometimes|nullable',
            'inspiredBy' => 'sometimes|nullable',
            'quotation.*' => 'sometimes|nullable|string',
            'inspiredWhom' => 'sometimes|nullable',
            'kuniad' => 'sometimes|nullable|string|max:100',
            'popularity' => 'sometimes|nullable|string',
            'mazhabFikih' => 'sometimes|nullable',
            'mazhabAkidah' => 'sometimes|nullable',
            'personCategory' => 'required',
            'description' => 'sometimes|nullable|string'

        ]);

        $person = PersonList::where('id',$id)->first();

        if (!empty($person)) {

            $person->update([
            'personName' => $request->personName,
            'fathersName' => $request->fathersName,
            'surName' => $request->surName,
            'birthYearHijri' => $request->birthYearHijri,
            'birthYearIsae' => $request->birthYearIsae,
            'birthPlaceID' => $request->birthCity,
            'deathYearHijri' => $request->deathYearHijri,
            'deathYearIsae' => $request->deathYearIsae,
            'deathPlaceID' => $request->deathCity,
            'kuniad' => $request->kuniad,
            'popularity' => $request->popularity,
            'mazhabFikih' => $request->mazhabFikih,
            'mazhabAkidah' => $request->mazhabAkidah,
            'description' => $request->description,
            'draft' => false
        ]);

            if (!empty($person)) {
            if (!empty($request->reCity) && count($request->reCity) > 0 && $request->has('reCity')) {

                if (count($person->person_residences) !=0) {
                    $person->person_residences()->forceDelete();
                }
                
                for ($i=0; $i < count($request->reCity) ; $i++) { 
                    $person->person_residences()->create([
                        'residencePlaceID' => $request->reCity[$i],
                        'reStartYearHijri' => $request->reStartYearHijri[$i],
                        'reEndYearHijri' => $request->reEndYearHijri[$i],
                        'reStartYearIsae' => $request->reStartYearIsae[$i],
                        'reEndYearIsae' => $request->reEndYearIsae[$i]
                    ]);

                }
            }
            else{
                if (count($person->person_residences) !=0) {
                    $person->person_residences()->forceDelete();
                }
            }


            if ( $request->writtenBook[0] != Null && count($request->writtenBook) > 0 && $request->has('writtenBook')) {
                
                if (count($person->person_written_books) !=0) {
                    $person->person_written_books()->forceDelete();
                }

                for ($i=0; $i < count($request->writtenBook) ; $i++) { 
                    $person->person_written_books()->create([
                        'writtenBook' => $request->writtenBook[$i],
                    ]);
                }
            }
            else{
                if (count($person->person_written_books) !=0) {
                    $person->person_written_books()->forceDelete();
                }
            }

            if ( $request->has('quotation')) {
                if ($request->quotation[0] != Null) {
                    if (count($person->person_quotations) !=0 ) {
                        $person->person_quotations()->forceDelete();
                    }

                    for ($i=0; $i < count($request->quotation) ; $i++) { 
                        $person->person_quotations()->create([
                            'quotation' => $request->quotation[$i]
                        ]);
                    }
                }

                if ($request->quotation[0] == Null) {
                    if (count($person->person_quotations) !=0 ) {
                        $person->person_quotations()->forceDelete();
                    }
                }


            }

            if (!empty($request->student) && $request->has('student')) {
                if (count($person->person_students) !=0 ) {
                    $person->person_students()->sync($request->student);
                }
                else{
                    $person->person_students()->attach($request->student);
                }
            }
            else{
                if (count($person->person_students) !=0 ) {
                    $person->person_students()->detach();
                }
            }

            if (!empty($request->teacher) && $request->has('teacher')) {
                if (count($person->person_teachers) !=0 ) {
                    $person->person_teachers()->sync($request->teacher);
                }
                else{
                    $person->person_teachers()->attach($request->teacher);
                }
            }
            else{
                if (count($person->person_teachers) !=0 ) {
                    $person->person_teachers()->detach();
                }
            }

            if (!empty($request->inspiredBy) && $request->has('inspiredBy')) {
                if (count($person->person_mentors) !=0) {
                    $person->person_mentors()->sync($request->inspiredBy);
                }
                else{
                    $person->person_mentors()->attach($request->inspiredBy);
                }
            }
            else{
                if (count($person->person_mentors) !=0) {
                    $person->person_mentors()->detach();
                }
            }

            if (!empty($request->inspiredWhom) && $request->has('inspiredWhom')) {
                if (count($person->person_followers) !=0) {
                    $person->person_followers()->sync($request->inspiredWhom);
                }
                else{
                    $person->person_followers()->attach($request->inspiredWhom);
                }
            }
            else{
                if (count($person->person_followers) !=0) {
                    $person->person_followers()->detach();
                }
            }


            if (!empty($request->personCategory) && $request->has('personCategory')) {
                if (count($person->person_categories) !=0) {
                    $person->person_categories()->sync($request->personCategory);
                }
                else{
                    $person->person_categories()->attach($request->personCategory);
                }
            }
            else{
                if (count($person->person_categories) !=0) {
                    $person->person_categories()->detach();
                }
            }
        
            Toastr::success(__('Record Updated Successfully'));
            return redirect(route('person-info.index'));

        }
        else{
            Toastr::error(__('Record Stored Failed'));
            return redirect(route('person-info.index'));
        }
        }

        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('person-info.index'));
        }



    }

    public function destroy($id)
    {
        $person = PersonList::where('id',$id)->first();
        if (!empty($person)) {
            if (!empty($person->person_residences)) {
                $person->person_residences()->forceDelete();
            }

            if (!empty($person->person_written_books)) {
                $person->person_written_books()->forceDelete();
            }

            if (!empty($person->person_quotations)) {
                $person->person_quotations()->forceDelete();
            }

            if (!empty($person->person_categories)) {
                $person->person_categories()->detach();
            }
            $person->person_students()->detach();
            $person->person_teachers()->detach();
            $person->person_mentors()->detach();
            $person->person_followers()->detach();
            $person->forceDelete();

            Toastr::success(__('Record Deleted Successfully'));
            return redirect(route('person-info.index'));
        }
        
        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('person-info.index'));
        }
    }



    public function getBirthCity()
    {
        if (isset($_GET['birthCountry'])){
            $birthCountry = $_GET['birthCountry'];
            $country = CountryList::where('id',$birthCountry)->first();
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

    public function getDeathCity()
    {
        if (isset($_GET['deathCountry'])){
            $deathCountry = $_GET['deathCountry'];
            $country = CountryList::where('id',$deathCountry)->first();
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

    public function getResidenceCity()
    {
        if (isset($_GET['reCountry'])){
            $residenceCountry = $_GET['reCountry'];
            $country = CountryList::where('id',$residenceCountry)->first();
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


    public function getResidenceCityDynamic()
    {
        if (isset($_GET['reCountryDynamic'])){
            $residenceCountryDynamic = $_GET['reCountryDynamic'];
            $country = CountryList::where('id',$residenceCountryDynamic)->first();
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
