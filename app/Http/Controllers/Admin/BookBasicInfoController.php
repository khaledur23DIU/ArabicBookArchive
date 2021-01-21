<?php

namespace App\Http\Controllers\Admin;


use App\BookBasicInfo;
use App\BookCategoryList;
use App\BookList;
use App\CountryList;
use App\Http\Controllers\Controller;
use App\KuniadList;
use App\LanguageList;
use App\MazhabList;
use App\PersonCategoryList;
use App\PersonList;
use App\PersonListBook;
use App\PlaceList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BookBasicInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
         $this->middleware('permission:BookBasicInfo-list|BookBasicInfo-create|BookBasicInfo-edit|BookBasicInfo-delete', ['only' => ['index','store']]);
         $this->middleware('permission:BookBasicInfo-create', ['only' => ['create','store']]);
         $this->middleware('permission:BookBasicInfo-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:BookBasicInfo-delete', ['only' => ['destroy']]);
    }
    

    public function index()
    {
        $bookBasicInfos = BookBasicInfo::orderBy('id','DESC')->get()->load(['book_basic_quotation','book_basic_index','book_basic_refs','book_basic_reviwes','book_basic_connected_books','book_basic_writing_places','book']);
        
        return view('admin.basicBook.index', compact('bookBasicInfos'));
    }


    public function create()
    {
        
        $authors = PersonCategoryList::where('person_category','author')->first()->load('persons');
        $basicBooks = BookList::orderBy('id','ASC')->get();
        $countries = CountryList::orderBy('country','ASC')->cursor();
        $placeLists = PlaceList::orderBy('city','ASC')->cursor();
        $bookCategories = BookCategoryList::orderBy('id','ASC')->cursor();
        $languages = LanguageList::orderBy('id','ASC')->cursor();
        $personCategories = PersonCategoryList::orderBy('person_category','ASC')->cursor();
    	return view('admin.basicBook.create', compact('countries','personCategories','placeLists','bookCategories','authors','languages','basicBooks'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'author' => 'required',
            'bookName' => 'required',
            'bookCategory' => 'required',
            'startYearHijri' => 'sometimes|nullable|integer',
            'endYearHijri' => 'sometimes|nullable|integer|gte:startYearHijri',
            'startYearIsae' => 'sometimes|nullable|integer',
            'endYearIsae' => 'sometimes|nullable|integer|gte:startYearIsae|integer',
            'writingStartYearHijri.*' => 'sometimes|nullable|integer',
            'writingEndYearHijri.*' => 'sometimes|nullable|integer|gte:writingStartYearHijri.*',
            'writingStartYearIsae.*' => 'sometimes|nullable|integer',
            'writingEndYearIsae.*' => 'sometimes|nullable|integer|gte:writingStartYearIsae.*',
            'writingCountry.*' => 'sometimes|nullable',
            'writingCity.*' => 'required_with:writingCountry.*|nullable',
            'language' => 'required',
            'reference.*' => 'sometimes|nullable|string',
            'reviewedBook.*' => 'required_with:review.*|nullable',
            'review.*' => 'required_with:reviewedBook.*|nullable|string',
            'bookCategoryRelID.*' => 'sometimes|nullable',
            'relatedBook.*' => 'required_with:bookCategoryRelID.*|nullable',
            'up.*' => 'required|nullable',
            'down.*' => 'required_with:up.*',
            'quotation' => 'sometimes|nullable|string',
            'serialNo' => 'required|nullable|numeric',
            'indexTitle' => 'required_with:serialNo|nullable|string'

        ]);

        
        $findPerson = PersonList::where('id',$request->author)->first();
        if (empty($findPerson)) {
            Toastr::error(__('Author Not Found'));
            return redirect(route('bookBasicInfo.index'));
        }
        else{

            $newBook = BookList::create([
                'bookName' => $request->bookName
            ]);


        $newBook->book_categories()->attach($request->bookCategory);

        $basicBook = BookBasicInfo::create([
            'bookID' => $newBook->id,
            'startYearHijri' => $request->startYearHijri,
            'endYearHijri' => $request->endYearHijri,
            'startYearIsae' => $request->startYearIsae,
            'endYearIsae' => $request->endYearIsae,
            'languageID' => $request->language
        ]);

            if (!empty($basicBook)) {

                $findPerson->person_list_books()->create([
                    'book_list_id' => $newBook->id
                ]);

                if (!empty($request->writingCity) && count($request->writingCity) > 0 && $request->has('writingCity')) {
                    for ($i=0; $i < count($request->writingCity) ; $i++) { 
                        $basicBook->book_basic_writing_places()->create([
                            'writingPlaceID' => $request->writingCity[$i],
                            'writingStartYearHijri' => $request->writingStartYearHijri[$i],
                            'writingEndYearHijri' => $request->writingEndYearHijri[$i],
                            'writingStartYearIsae' => $request->writingStartYearIsae[$i],
                            'writingEndYearIsae' => $request->writingEndYearIsae[$i]
                        ]);
                    }
                }

                if ($request->reference[0] != NULL && count($request->reference) > 0 && $request->has('reference')) {
                    for ($i=0; $i < count($request->reference) ; $i++) { 
                        $basicBook->book_basic_refs()->create([
                            'ref' => $request->reference[$i],
                        ]);
                    }
                }
                    
                       
                        if (!empty($request->quotation)) {
                         $basicBook->book_basic_quotation()->create([
                            'SLNo' => $request->serialNo,
                            'quotation' => $request->quotation
                        ]);
                     }

                        if (!empty($request->indexTitle)) {
                         $basicBook->book_basic_index()->create([
                            'SLNo' => $request->serialNo,
                            'indexText' => $request->indexTitle
                        ]);
                     }

                if ( ($request->reviewedBook[0]) != NULL && $request->has('reviewedBook')) {
                    for ($i=0; $i < count($request->reviewedBook) ; $i++) { 
                        $basicBook->book_basic_reviwes()->create([
                            'reviewBookID' => $request->reviewedBook[$i],
                            'review' => $request->review[$i]
                        ]);
                    }
                }


                if ( ($request->relatedBook[0]) != NULL && $request->has('relatedBook')) {
                    
                    for ($i=0; $i < count($request->relatedBook) ; $i++) { 
                        if ($request->has('up')) {
                            if ($request->up[$i] == 'yes') {
                                $positionUp = true;
                            }
                            elseif ($request->up[$i] == 'no') {
                                $positionUp = false;
                            }
                            else{
                                $positionUp = false;
                            }
                        }

                        $basicBook->book_basic_connected_books()->create([
                            'connectedBookID' => (int)$request->relatedBook[$i],
                            'connectedBookCategoryID' => $request->bookCategoryRelID[$i],
                            'positionUp' => $positionUp
                        ]);
                    }
                }

            
                Toastr::success(__('Record Stored Successfully'));
                return redirect(route('bookBasicInfo.index'));

            }
            else{
                Toastr::error(__('Record Stored Failed'));
                return redirect(route('bookBasicInfo.index'));
            }
        
        }

    }

    public function edit($id)
    {
        $findBookBasicInfo = BookBasicInfo::where('id',$id)->first();

        if (!empty($findBookBasicInfo)) {
            $bookBasicInfo = $findBookBasicInfo->load(['book_basic_quotation','book_basic_index','book_basic_refs','book_basic_reviwes','book_basic_connected_books','book_basic_writing_places','book']);

            $authors = PersonCategoryList::where('person_category','author')->first()->load('persons');
            $basicBooks = BookList::orderBy('id','ASC')->get();
            $countries = CountryList::orderBy('country','ASC')->cursor();
            $placeLists = PlaceList::orderBy('city','ASC')->cursor();
            $bookCategories = BookCategoryList::orderBy('id','ASC')->cursor();
            $languages = LanguageList::orderBy('id','ASC')->cursor();
            $personCategories = PersonCategoryList::orderBy('person_category','ASC')->cursor();

            return view('admin.basicBook.edit', compact('countries','personCategories','placeLists','bookCategories','authors','languages','basicBooks','bookBasicInfo'));
        }

        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('bookBasicInfo.index'));
        }

    }

        public function update(Request $request, $id)
        {
            $this->validate($request,[
            'author' => 'required',
            'bookName' => 'required',
            'bookCategory' => 'required',
            'startYearHijri' => 'sometimes|nullable|integer',
            'endYearHijri' => 'sometimes|nullable|integer|gte:startYearHijri',
            'startYearIsae' => 'sometimes|nullable|integer',
            'endYearIsae' => 'sometimes|nullable|integer|gte:startYearIsae|integer',
            'writingStartYearHijri.*' => 'sometimes|nullable|integer',
            'writingEndYearHijri.*' => 'sometimes|nullable|integer|gte:writingStartYearHijri.*',
            'writingStartYearIsae.*' => 'sometimes|nullable|integer',
            'writingEndYearIsae.*' => 'sometimes|nullable|integer|gte:writingStartYearIsae.*',
            'writingCountry.*' => 'sometimes|nullable',
            'writingCity.*' => 'required_with:writingCountry.*|nullable',
            'language' => 'required',
            'reference.*' => 'sometimes|nullable|string',
            'reviewedBook.*' => 'required_with:review.*|nullable',
            'review.*' => 'required_with:reviewedBook.*|nullable|string',
            'bookCategoryRelID.*' => 'sometimes|nullable',
            'relatedBook.*' => 'required_with:bookCategoryRelID.*|nullable',
            'up.*' => 'required|nullable',
            'down.*' => 'required_with:up.*',
            'quotation' => 'sometimes|nullable|string',
            'serialNo' => 'required|nullable|numeric',
            'indexTitle' => 'required_with:serialNo|nullable|string'

        ]);
            $findBookBasicInfo = BookBasicInfo::where('id',$id)->first();
        if (!empty($findBookBasicInfo)) {
            
        
        $findPerson = PersonList::where('id',$request->author)->first();
        if (empty($findPerson)) {
            Toastr::error(__('Author Not Found'));
            return redirect()->back();
        }
        else{
            $findBook = BookList::where('id',$findBookBasicInfo->bookID)->first();
               $findModel = PersonListBook::where('book_list_id',$findBookBasicInfo->bookID)->first(); 
               
                $updatedBook = $findBook->update([
                'bookName' => $request->bookName
                ]);

                $findBook->person_book()->update([
                    'book_list_id' => $findBook->id,
                    'person_list_bookable_id' => $request->author
                ]);
            

            


         $findBook->book_categories()->sync($request->bookCategory);

        $basicBook = $findBookBasicInfo->update([
            'bookID' => $findBook->id,
            'startYearHijri' => $request->startYearHijri,
            'endYearHijri' => $request->endYearHijri,
            'startYearIsae' => $request->startYearIsae,
            'endYearIsae' => $request->endYearIsae,
            'languageID' => $request->language
        ]);

            if ($basicBook == true ) {


                if (!empty($request->writingCity) && count($request->writingCity) > 0 && $request->has('writingCity')) {

                    if (count($findBookBasicInfo->book_basic_writing_places) !=0) {
                        $findBookBasicInfo->book_basic_writing_places()->forceDelete();
                    }

                    for ($i=0; $i < count($request->writingCity) ; $i++) { 
                        $findBookBasicInfo->book_basic_writing_places()->create([
                            'writingPlaceID' => $request->writingCity[$i],
                            'writingStartYearHijri' => $request->writingStartYearHijri[$i],
                            'writingEndYearHijri' => $request->writingEndYearHijri[$i],
                            'writingStartYearIsae' => $request->writingStartYearIsae[$i],
                            'writingEndYearIsae' => $request->writingEndYearIsae[$i]
                        ]);
                    }
                }
                else{
                    if (count($findBookBasicInfo->book_basic_writing_places) !=0) {
                        $findBookBasicInfo->book_basic_writing_places()->forceDelete();
                    }
                }

                if ($request->reference[0] != Null && count($request->reference) != 0 && $request->has('reference')) {
                    
                    if (count($findBookBasicInfo->book_basic_refs) !=0) {
                        $findBookBasicInfo->book_basic_refs()->forceDelete();
                    }

                    for ($i=0; $i < count($request->reference) ; $i++) { 
                        $findBookBasicInfo->book_basic_refs()->create([
                            'ref' => $request->reference[$i],
                        ]);
                    }
                }
                else{
                    if (count($findBookBasicInfo->book_basic_refs) !=0) {
                        $findBookBasicInfo->book_basic_refs()->forceDelete();
                    }
                }

                if ($request->has('serialNo') && $request->has('indexTitle') && $request->has('quotation')) {
                    
                        
                        if (!empty($request->quotation)) {
                            if (!empty($findBookBasicInfo->book_basic_quotation)) {

                                $findBookBasicInfo->book_basic_quotation()->update([
                                    'SLNo' => $request->serialNo,
                                    'quotation' => $request->quotation
                                    ]);
                            }
                            else{
                                $findBookBasicInfo->book_basic_quotation()->create([
                                    'SLNo' => $request->serialNo,
                                    'quotation' => $request->quotation
                                    ]);
                            }
                         
                     }
                     else{
                        $findBookBasicInfo->book_basic_quotation()->forceDelete();
                     }

                        if (!empty($request->indexTitle)) {
                            if (!empty($findBookBasicInfo->book_basic_quotation)){
                                $findBookBasicInfo->book_basic_index()->update([
                                     'SLNo' => $request->serialNo,
                                    'indexText' => $request->indexTitle
                                     ]);
                            }
                            else{
                                $findBookBasicInfo->book_basic_index()->create([
                                    'SLNo' => $request->serialNo,
                                    'indexText' => $request->indexTitle
                                ]);
                            }
                         
                     }
                     else{
                        $findBookBasicInfo->book_basic_index()->forceDelete();
                     }
                    
                }

                if ( ($request->reviewedBook[0]) != Null && $request->has('reviewedBook')) {

                    if (count($findBookBasicInfo->book_basic_reviwes) !=0) {
                        $findBookBasicInfo->book_basic_reviwes()->forceDelete();
                    }

                    for ($i=0; $i < count($request->reviewedBook) ; $i++) { 
                        $findBookBasicInfo->book_basic_reviwes()->create([
                            'reviewBookID' => $request->reviewedBook[$i],
                            'review' => $request->review[$i]
                        ]);
                    }
                }
                else{
                   if (count($findBookBasicInfo->book_basic_reviwes) !=0) {
                        $findBookBasicInfo->book_basic_reviwes()->forceDelete();
                    } 
                }


                if ( ($request->relatedBook[0]) != NULL && $request->has('relatedBook')) {

                    if (count($findBookBasicInfo->book_basic_connected_books) !=0) {
                        $findBookBasicInfo->book_basic_connected_books()->forceDelete();
                    }

                    for ($i=0; $i < count($request->relatedBook) ; $i++) { 
                        if ($request->has('up')) {
                            if ($request->up[$i] == 'yes') {
                                $positionUp = true;
                            }
                            elseif ($request->up[$i] == 'no') {
                                $positionUp = false;
                            }
                            else{
                                $positionUp = false;
                            }
                        }

                        $findBookBasicInfo->book_basic_connected_books()->create([
                            'connectedBookID' => $request->relatedBook[$i],
                            'connectedBookCategoryID' => $request->bookCategoryRelID[$i],
                            'positionUp' => $positionUp
                        ]);
                    }
                }
                else{
                    if (count($findBookBasicInfo->book_basic_connected_books) !=0) {
                        $findBookBasicInfo->book_basic_connected_books()->forceDelete();
                    }
                }

            
                Toastr::success(__('Record Updated Successfully'));
                return redirect(route('bookBasicInfo.index'));

            }
            else{
                
                Toastr::error(__('Record Updated Failed'));
                return redirect(route('bookBasicInfo.index'));
            }

        
        
        }
        }
        else{
            
            Toastr::error(__('Record Not Found'));
            return redirect(route('bookBasicInfo.index'));
        }
    }

    public function show($id)
    {
        $findRecord = BookBasicInfo::where('id',$id)->first();
        
        if (!empty($findRecord)) {
            $bookBasicInfo = BookBasicInfo::where('id',$id)->first()->load(['published_info','published_editions','published_editors','publisher','book_basic_quotation','book_basic_index','book_basic_refs','book_basic_reviwes','book_basic_connected_books','book_basic_writing_places','book','language']);
            return view('admin.basicBook.show',compact('bookBasicInfo'));
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('bookBasicInfo.index'));
        }
    }


    public function destroy($id)
    {
        $bookBasicInfo = BookBasicInfo::where('id',$id)->first();
        if (!empty($bookBasicInfo)) {
            $bookBasicInfo->book_basic_quotation()->forceDelete();
            $bookBasicInfo->book_basic_index()->forceDelete();
            $bookBasicInfo->book_basic_refs()->forceDelete();
            $bookBasicInfo->book_basic_reviwes()->forceDelete();
            $bookBasicInfo->book_basic_connected_books()->forceDelete();
            $bookBasicInfo->book_basic_writing_places()->forceDelete();
            $bookBasicInfo->book()->forceDelete();
            $done = $bookBasicInfo->forceDelete();
            if ($done == true) {
                
                Toastr::success(__('Record Deleted Successfully'));
                return redirect(route('bookBasicInfo.index'));
            }
            else{
                Toastr::success(__('Record Deleted Failed'));
                return redirect(route('bookBasicInfo.index'));
            }
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('bookBasicInfo.index'));
        }

    }
    

    public function getwritingCityDynamic()
    {
    	if (isset($_GET['writingCountryDynamic'])){
            $writingCountryDynamic = $_GET['writingCountryDynamic'];
            $country = CountryList::where('id',$writingCountryDynamic)->first();
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

    public function getRelatedBook()
    {
        if (isset($_GET['relatedBookDynamic'])){
            $id = $_GET['relatedBookDynamic'];
            $bookCategory = BookCategoryList::where('id',$id)->first();
            if(!empty($bookCategory->book_lists)){
                
            echo json_encode($bookCategory->book_lists->all());
            }

            else{
                return response()->json(['error'=>"Records Not Found"]);
                
            }
        }
        else{
            return response()->json(['error'=>"Worng Reuquest."]);
        }
    }

    public function getRelatedBookDynamic()
    {
        if (isset($_GET['relatedBookDynamic']) && isset($_GET['book'])){
            $id = $_GET['relatedBookDynamic'];
            $book = $_GET['book'];
            $bookCategory = BookCategoryList::where('id',$id)->first();
            if(!empty($bookCategory->book_lists)){
                $books = array();
                foreach ($bookCategory->book_lists as $key => $list) {
                    if ($list->id != $book) {
                        $books[] = $list;
                    }
                }
                
            echo json_encode($books);
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
