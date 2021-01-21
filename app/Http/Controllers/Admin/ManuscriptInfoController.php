<?php

namespace App\Http\Controllers\Admin;

use App\CountryList;
use App\Http\Controllers\Controller;
use App\KuniadList;
use App\LibraryList;
use App\ManuscriptInfo;
use App\MazhabList;
use App\PersonCategoryList;
use App\PersonList;
use App\PlaceList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ManuscriptInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
         $this->middleware('permission:Manuscript-list|Manuscript-create|Manuscript-edit|Manuscript-delete', ['only' => ['index','store']]);
         $this->middleware('permission:Manuscript-create', ['only' => ['create','store']]);
         $this->middleware('permission:Manuscript-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:Manuscript-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $manuscripts = ManuscriptInfo::orderBy('id','ASC')->cursor();
        return view('admin.manuscript.index', compact('manuscripts'));
    }

    public function create()
    {
        $authors = PersonCategoryList::where('person_category','author')->first()->load('persons');
        $writers = PersonCategoryList::where('person_category','writer')->first()->load('persons');
        $libraryList = LibraryList::orderBy('libraryName','ASC')->cursor();
        $autorsBooks = $authors->persons->load('person_list_books');
    	return view('admin.manuscript.create', compact('authors','writers','libraryList','autorsBooks'));
    }

    public function show($id)
    {
        $findManu = ManuscriptInfo::find($id);
        if (!empty($findManu)) {
                $manuscript = ManuscriptInfo::where('id',$id)->first()->load(['manuscript_writers','library','book']);
                return view('admin.manuscript.show',compact('manuscript'));
            }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('manuscriptInfo.index'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'author' => 'required',
            'book' => 'required',
             'library' => 'required',
            'indexInLibrary' => 'sometimes|nullable|string|max:255',
            'writer' => 'required',
            'writtenYearHijri' => 'sometimes|nullable|integer|min:1',
            'writtenYearIsae' => 'sometimes|nullable|integer',
            'pageCount' => 'sometimes|nullable|integer',
            'pageSize' => 'sometimes|nullable|integer',
            'lineCountPerPage' => 'sometimes|nullable|integer',
            'startingLine' => 'sometimes|nullable|string',
            'endingLine' => 'sometimes|nullable|string',
            'errors' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string',
            'pdfLink' => 'sometimes|nullable|url',
            
        ]);

        $manuscript = ManuscriptInfo::create([
            'bookID'=> $request->book,
            'libraryID'=> $request->library,
            'indexInLibrary'=> $request->indexInLibrary,
            'writtenYearHijri'=> $request->writtenYearHijri,
            'writtenYearIsae'=> $request->writtenYearIsae,
            'pageCount'=> $request->pageCount,
            'pageSize'=> $request->pageSize,
            'lineCountPerPage'=> $request->lineCountPerPage,
            'someStratingLine'=> $request->startingLine,
            'someEndingLine'=> $request->endingLine,
            'errors'=> $request->errors,
            'description'=> $request->description,
            'pdfLink'=> $request->pdfLink,

        ]);

        if (!empty($manuscript)) {
            $manuscript->manuscript_writers()->attach($request->writer);

            Toastr::success(__('Record Stored Successfully'));
            return redirect(route('manuscriptInfo.index'));
        }
        else{
            Toastr::error(__('Record Stored Failed'));
            return redirect(route('manuscriptInfo.index'));
        }
    	
    }

    public function edit($id)
    {
        $manuscript = ManuscriptInfo::where('id',$id)->first();
        if (!empty($manuscript)) {

        $authors = PersonCategoryList::where('person_category','author')->first()->load('persons');
        $writers = PersonCategoryList::where('person_category','writer')->first()->load('persons');
        $libraryList = LibraryList::orderBy('libraryName','ASC')->cursor();
        $autorsBooks = $authors->persons->load('person_list_books');
        return view('admin.manuscript.edit', compact('authors','writers','libraryList','autorsBooks','manuscript'));

        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('manuscriptInfo.index'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'author' => 'required',
            'book' => 'required',
             'library' => 'required',
            'indexInLibrary' => 'sometimes|nullable|string|max:255',
            'writer' => 'required',
            'writtenYearHijri' => 'sometimes|nullable|integer|min:1',
            'writtenYearIsae' => 'sometimes|nullable|integer',
            'pageCount' => 'sometimes|nullable|integer',
            'pageSize' => 'sometimes|nullable|integer',
            'lineCountPerPage' => 'sometimes|nullable|integer',
            'startingLine' => 'sometimes|nullable|string',
            'endingLine' => 'sometimes|nullable|string',
            'errors' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string',
            'pdfLink' => 'sometimes|nullable|url',
            
        ]);
        $findManu = ManuscriptInfo::where('id',$id)->first();
        if (!empty($findManu)) {
            
        
        $manuscript = $findManu->update([
            'bookID'=> $request->book,
            'libraryID'=> $request->library,
            'indexInLibrary'=> $request->indexInLibrary,
            'writtenYearHijri'=> $request->writtenYearHijri,
            'writtenYearIsae'=> $request->writtenYearIsae,
            'pageCount'=> $request->pageCount,
            'pageSize'=> $request->pageSize,
            'lineCountPerPage'=> $request->lineCountPerPage,
            'someStratingLine'=> $request->startingLine,
            'someEndingLine'=> $request->endingLine,
            'errors'=> $request->errors,
            'description'=> $request->description,
            'pdfLink'=> $request->pdfLink,

        ]);

        if ( $manuscript == true) {
            $findManu->manuscript_writers()->sync($request->writer);

            Toastr::success(__('Record Updated Successfully'));
            return redirect(route('manuscriptInfo.index'));
        }
        else{
            Toastr::error(__('Record Updated Failed'));
            return redirect(route('manuscriptInfo.index'));
        }
        }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('manuscriptInfo.index'));
        }
    }

    public function destroy($id)
    {
        $findManu = ManuscriptInfo::where('id',$id)->first();
        if (!empty($findManu)) {
                $findManu->forceDelete();
                Toastr::success(__('Record Deleted Successfully'));
                return redirect(route('manuscriptInfo.index'));
            }
        else{
            Toastr::error(__('Record Not Found'));
            return redirect(route('manuscriptInfo.index'));
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
