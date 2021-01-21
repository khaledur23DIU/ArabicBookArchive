<?php

namespace App\Http\Controllers\Admin;

use App\BookBasicInfo;
use App\CountryList;
use App\Http\Controllers\Controller;
use App\KuniadList;
use App\ManuscriptInfo;
use App\MazhabList;
use App\PersonCategoryList;
use App\PersonList;
use App\PlaceList;
use App\PublishedInfo;
use App\PublishedInfoEdition;
use App\PublishedInfoEditor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PublishedBookInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
         $this->middleware('permission:PublishedBook-list|PublishedBook-create|PublishedBook-edit|PublishedBook-delete', ['only' => ['index','store']]);
         $this->middleware('permission:PublishedBook-create', ['only' => ['create','store']]);
         $this->middleware('permission:PublishedBook-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:PublishedBook-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $publishedBooks = PublishedInfo::orderBy('id','DESC')->get()->load(['book_publisher','book_basic_info']);
        return view('admin.publishedBook.index', compact('publishedBooks'));
    }

    public function create()
    {
        $authors = PersonCategoryList::where('person_category','publisher')->first()->load('persons');
        $editors = PersonCategoryList::where('person_category','editor')->first()->load('persons');
        $notPublished = BookBasicInfo::orderBy('id','ASC')->get()->load(['book','published_info']);
        $bookBasicInfos = array();
        foreach ($notPublished as $key => $value) {
            if (empty($value->published_info)) {
               $bookBasicInfos[] = $value; 
            }
        }

    	return view('admin.publishedBook.create', compact('authors','editors','bookBasicInfos'));
    }
    

    public function store(Request $request)
    {
        $this->validate($request,[
            'author' => 'required',
            'bookBasicInfo' => 'required',
            'editionNo.*' => 'required|numeric|max:75',
            'editionYearHijri.*' => 'sometimes|nullable|integer|min:1',
            'editionYearIsae.*' => 'sometimes|nullable|integer',
            'partCount.*' => 'required|numeric',
            'pageCount.*' => 'required|numeric',
            'pageSize.*' => 'sometimes|nullable|numeric',
            'coverPhotoLink.*' => 'sometimes|nullable|url',
            'pdfLink.*' => 'sometimes|nullable|url',
            'errors.*' => 'sometimes|nullable|string',
            'description.*' => 'sometimes|nullable|string',
            'editor.*' => 'sometimes|nullable',
            'workCategory.*' => 'sometimes|nullable|string|max:100',
            'editorDescription.*' => 'sometimes|nullable|string'
        ]);

        $publishedBook = PublishedInfo::create([
            'basic_book_id' => $request->bookBasicInfo,
            'publisherID' => $request->author
        ]);

        if (!empty($publishedBook)) {

                if ($request->editionNo[0] != Null && count($request->editionNo) > 0 && $request->has('editionNo')) {
                    for ($i=0; $i < count($request->editionNo) ; $i++) { 
                        PublishedInfoEdition::create([
                            'basic_book_id' => $request->bookBasicInfo,
                            'editionNo' => $request->editionNo[$i],
                            'editionYearHijri' => $request->editionYearHijri[$i],
                            'editionYearIsae' => $request->editionYearIsae[$i],
                            'partCount' => $request->partCount[$i],
                            'pageCount' => $request->pageCount[$i],
                            'pageSize' => $request->pageSize[$i],
                            'errors' => $request->errors[$i],
                            'description' => $request->description[$i],
                            'coverPhotoLink' => $request->coverPhotoLink[$i],
                            'pdfLink' => $request->pdfLink[$i]
                        ]);
                    }
                }

                if (!empty($request->editor) && $request->editor[0] != Null && count($request->editor) > 0 && $request->has('editor')) {
                    for ($i=0; $i < count($request->editor) ; $i++) { 
                        PublishedInfoEditor::create([
                            'basic_book_id' => $request->bookBasicInfo,
                            'editorID' => $request->editor[$i],
                            'workCategory' => $request->workCategory[$i],
                            'description' => $request->editorDescription[$i],
                        ]);
                    }
                }

                Toastr::success(__('Record Stored Successfully'));
                return redirect(route('publishedBookInfo.index'));
            }

            else{
                Toastr::error(__('Record Stored Failed'));
                return redirect(route('publishedBookInfo.index'));
            }

    }

    public function show($id)
    {

        $findPublishedInfo = PublishedInfo::where('id',$id)->first();
        if (!empty($findPublishedInfo)) {
            $publishedInfo = $findPublishedInfo->load(['book_publisher','book_basic_info']);
            return view('admin.publishedBook.show',compact('publishedInfo'));
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('publishedBookInfo.index'));
        }
    }

    public function edit($id)
    {
        $findPublishedInfo = PublishedInfo::where('id',$id)->first()->load(['book_publisher','book_basic_info']);
        if (!empty($findPublishedInfo)) {

            $authors = PersonCategoryList::where('person_category','author')->first()->load('persons');
            $editors = PersonCategoryList::where('person_category','editor')->first()->load('persons');
            $bookBasicInfos = BookBasicInfo::orderBy('id','ASC')->get()->load('book');
            return view('admin.publishedBook.edit', compact('authors','editors','bookBasicInfos','findPublishedInfo'));
        }
        else{
            Toastr::error(__('Record Stored Failed'));
            return redirect(route('publishedBookInfo.index')); 
        }

    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'author' => 'required',
            'bookBasicInfo' => 'required',
            'editionNo.*' => 'required|numeric|max:75',
            'editionYearHijri.*' => 'sometimes|nullable|integer|min:1',
            'editionYearIsae.*' => 'sometimes|nullable|integer',
            'partCount.*' => 'required|numeric',
            'pageCount.*' => 'required|numeric',
            'pageSize.*' => 'sometimes|nullable|numeric',
            'coverPhotoLink.*' => 'sometimes|nullable|url',
            'pdfLink.*' => 'sometimes|nullable|url',
            'errors.*' => 'sometimes|nullable|string',
            'description.*' => 'sometimes|nullable|string',
            'editor.*' => 'sometimes|nullable',
            'workCategory.*' => 'sometimes|nullable|string|max:100',
            'editorDescription.*' => 'sometimes|nullable|string'
        ]);
        $publishedInfo = PublishedInfo::where('id',$id)->first()->load(['book_publisher','book_basic_info']);

        if (!empty($publishedInfo)) {
            


            $updated = $publishedInfo->update([
            'basic_book_id' => $request->bookBasicInfo,
            'publisherID' => $request->author
        ]);

        if ($updated ==true ) {

                if ($request->editionNo[0] != Null && count($request->editionNo) > 0 && $request->has('editionNo')) {
                    if (count($publishedInfo->book_basic_info->published_editions)!=0) {
                        $publishedInfo->book_basic_info->published_editions()->forceDelete();
                    }
                    for ($i=0; $i < count($request->editionNo) ; $i++) { 

                        PublishedInfoEdition::create([
                            'basic_book_id' => $request->bookBasicInfo,
                            'editionNo' => $request->editionNo[$i],
                            'editionYearHijri' => $request->editionYearHijri[$i],
                            'editionYearIsae' => $request->editionYearIsae[$i],
                            'partCount' => $request->partCount[$i],
                            'pageCount' => $request->pageCount[$i],
                            'pageSize' => $request->pageSize[$i],
                            'errors' => $request->errors[$i],
                            'description' => $request->description[$i],
                            'coverPhotoLink' => $request->coverPhotoLink[$i],
                            'pdfLink' => $request->pdfLink[$i]
                        ]);
                    }
                }

                if (!empty($request->editor) && $request->editor[0] != Null && count($request->editor) > 0 && $request->has('editor')) {
                    if (count($publishedInfo->book_basic_info->published_editors)!=0) {
                        $publishedInfo->book_basic_info->published_editors()->forceDelete();
                    }
                    
                    for ($i=0; $i < count($request->editor) ; $i++) { 
                        PublishedInfoEditor::create([
                            'basic_book_id' => $request->bookBasicInfo,
                            'editorID' => $request->editor[$i],
                            'workCategory' => $request->workCategory[$i],
                            'description' => $request->editorDescription[$i],
                        ]);
                    }
                }

                Toastr::success(__('Record Updated Successfully'));
                return redirect(route('publishedBookInfo.index'));
            }

            else{
                Toastr::error(__('Record Updated Failed'));
                return redirect(route('publishedBookInfo.index'));
            }
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('publishedBookInfo.index'));
        }
    }

    public function destroy($id)
    {
        $publishedInfo = PublishedInfo::where('id',$id)->first()->load(['book_publisher','book_basic_info']);

        if (!empty($publishedInfo)) {

            $publishedInfo->book_basic_info->published_editions()->forceDelete();
            $publishedInfo->book_basic_info->published_editors()->forceDelete();
            $publishedInfo->forceDelete();
            Toastr::success(__('Record Deleted Successfully'));
            return redirect(route('publishedBookInfo.index'));
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('publishedBookInfo.index'));
        }

    }


    public function getbookDynamic()
    {
        if (isset($_GET['bookDynamic'])){
            $id = $_GET['bookDynamic'];
            $book = PersonList::where('id',$id)->first()->load('person_list_books');
            if(!empty($book->person_list_books)){
                $books = array();
                foreach ($book->person_list_books as $key => $book_list) {
                    $books[] = $book_list->book;
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
