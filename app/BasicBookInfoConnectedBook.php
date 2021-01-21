<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class BasicBookInfoConnectedBook extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    protected $guarded = [];

    public function connected_bookable()
    {
    	return $this->morphTo();
    }

    public function connected_book()
    {
        return $this->belongsTo('App\BookList','connectedBookID');
    }

    public function connected_book_category()
    {
        return $this->belongsTo('App\BookCategoryList','connectedBookCategoryID');
    }
}
