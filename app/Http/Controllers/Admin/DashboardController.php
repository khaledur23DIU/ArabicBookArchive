<?php

namespace App\Http\Controllers\Admin;

use App\BookBasicInfo;
use App\Http\Controllers\Controller;
use App\LibraryList;
use App\ManuscriptInfo;
use App\PersonList;
use App\PublishedInfo;
use App\PublisherList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	 
    }

    public function dashboard()
    {
    
        $libraryCount = count(LibraryList::all());
        $personCount = count(PersonList::all());
        $manuscriptCount = count(ManuscriptInfo::all());
        $bookBasicCount = count(BookBasicInfo::all());

        $publishers = PublisherList::orderBy('id','DESC')->limit(5)->get();
        $libraries = LibraryList::orderBy('id','DESC')->limit(5)->get();
        $publishedBooks = PublishedInfo::orderBy('id','DESC')->limit(5)->get();
        $bookBasicInfo = BookBasicInfo::orderBy('id','DESC')->limit(5)->get();
        $persons = PersonList::orderBy('id','DESC')->limit(5)->get();
        $manuscripts = ManuscriptInfo::orderBy('id','DESC')->limit(5)->get();

    	return view('dashboard',compact('libraryCount','personCount','manuscriptCount','bookBasicCount','publishers','libraries','publishedBooks','bookBasicInfo','persons','manuscripts'));
    }
}
