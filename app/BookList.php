<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class BookList extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    protected $guarded = [];

   
    public function book_categories()
    {
        return $this->belongsToMany('App\BookCategoryList','book_list_category','book_id','category_id')->withTimestamps();
    }

    public function book_basic_info()
    {
        return $this->hasOne('App\BookBasicInfo','bookID');
    }

    public function book_reviwes()
    {
        return $this->hasMany('App\BookBasicInfoReview','reviewBookID');
    }

    public function person_book()
    {
        return $this->hasOne('App\PersonListBook','book_list_id');
    }

    /*public function book()
    {
        return $this->belongsTo('App\BookList','bookID');
    }*/

    public function manuscripts()
    {
        return $this->hasMany('App\ManuscriptInfo','id');
    }
}
