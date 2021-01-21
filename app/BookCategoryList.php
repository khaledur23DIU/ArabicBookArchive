<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class BookCategoryList extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    protected $guarded = [];

    public function book_lists()
    {
        return $this->belongsToMany('App\BookList','book_list_category','category_id','book_id')->withTimestamps();
    }
}
