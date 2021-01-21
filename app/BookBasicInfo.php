<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class BookBasicInfo extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    protected $guarded = [];


    public function published_info()
    {
        return $this->hasOne('App\PublishedInfo','basic_book_id');
    }


    public function published_editions()
    {
        return $this->hasMany('App\PublishedInfoEdition','basic_book_id');
    }

    public function published_editors()
    {
        return $this->hasMany('App\PublishedInfoEditor','basic_book_id');
    }

    public function publisher()
    {
        return $this->belongsTo('App\PersonList','published_infos','basic_book_id','publisherID');
    }
    public function book_basic_quotation()
    {
    	return $this->morphOne('App\BookBasicInfoQuotation', 'info_quotationable');
    }

    public function book_basic_index()
    {
    	return $this->morphOne('App\BookBasicInfoIndex', 'info_indiceable');
    }

    public function book_basic_refs()
    {
    	return $this->morphMany('App\BookBasicInfoRef', 'refable');
    }

    public function book_basic_reviwes()
    {
    	return $this->morphMany('App\BookBasicInfoReview', 'reviewable');
    }

    public function book_basic_connected_books()
    {
    	return $this->morphMany('App\BasicBookInfoConnectedBook', 'connected_bookable');
    }

    public function book_basic_writing_places()
    {
    	return $this->morphMany('App\BookBasicInfoWritingPlace', 'writing_placeable');
    }

    public function book()
    {
    	return $this->belongsTo('App\BookList','bookID');
    }

    public function language()
    {
    	return $this->belongsTo('App\LanguageList','languageID');
    }
}
