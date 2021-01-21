<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class PersonList extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $guarded = [];

    public function manuscripts()
    {
        return $this->belongsToMany('App\ManuscriptInfo','manuscript_writers','writer_id','manuscript_id')->withTimestamps();
    }

    public function editors()
    {
        return $this->hasMany('App\PublishedInfoEditor','id');
    }

    public function published_book_infos()
    {
        return $this->hasMany('App\PublishedInfo','id');
    }


    public function person_categories()
    {
    	return $this->belongsToMany('App\PersonCategoryList','person_categorizables','person_id', 'person_category_id');
    }


    public function person_followers()
    {
        return $this->belongsToMany('App\PersonList','person_list_followers','follower_id','person_id')->withTimestamps();
    }

    public function follower_persons()
    {
        return $this->belongsToMany('App\PersonList','person_list_followers','follower_id','person_id')->withTimestamps();
    }

    public function person_mentors()
    {
        return $this->belongsToMany('App\PersonList','person_list_mentors','mentor_id','person_id')->withTimestamps();
    }

    public function mentor_persons()
    {
        return $this->belongsToMany('App\PersonList','person_list_mentors','mentor_id','person_id')->withTimestamps();
    }

    public function person_students()
    {
        return $this->belongsToMany('App\PersonList','person_list_students','student_id','person_id')->withTimestamps();
    }

    public function student_persons()
    {
        return $this->belongsToMany('App\PersonList','person_list_students','student_id','person_id')->withTimestamps();
    }

    public function person_teachers()
    {
        return $this->belongsToMany('App\PersonList','person_list_teachers','teacher_id','person_id')->withTimestamps();
    }

    public function teacher_persons()
    {
        return $this->belongsToMany('App\PersonList','person_list_teachers','teacher_id','person_id')->withTimestamps();
    }


    public function person_book_basic_infos()
    {
        return $this->belongsToMany('App\BookBasicInfo','person_list_book_basic_info','book_basic_info_id','person_id')->withTimestamps();
    }

    
    public function person_written_books()
    {
        return $this->morphMany('App\PersonListWrittenBook', 'written_bookable');
    }

    public function person_list_books()
    {
        return $this->morphMany('App\PersonListBook', 'person_list_bookable');
    }

    
    public function person_quotations()
    {
    	return $this->morphMany('App\PersonListQuotation', 'quotationable');
    }

    public function person_residences()
    {
    	return $this->morphMany('App\PersonListResidence', 'residenceable');
    }


    public function birthPlace()
    {
        return $this->belongsTo('App\PlaceList','birthPlaceID');
    }

    public function deathPlace()
    {
        return $this->belongsTo('App\PlaceList','deathPlaceID');
    }

    public function mazhab_fikih()
    {
        return $this->belongsTo('App\MazhabList','mazhabFikih');
    }

    public function mazhab_akidah()
    {
        return $this->belongsTo('App\MazhabList','mazhabAkidah');
    }

    public function publishers()
    {
        return $this->hasMany('App\PublisherList','id');
    }
}
