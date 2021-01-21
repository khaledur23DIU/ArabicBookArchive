<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class ManuscriptInfo extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    protected $guarded = [];

    public function manuscript_writers()
    {
    	return $this->belongsToMany('App\PersonList','manuscript_writers', 'manuscript_id','writer_id')->withTimestamps();
    }

    public function library()
    {
    	return $this->belongsTo('App\LibraryList','libraryID');
    }

    public function book()
    {
    	return $this->belongsTo('App\BookList','bookID');
    }

}
