<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class BookBasicInfoReview extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    protected $guarded = [];

    public function reviewable()
    {
    	return $this->morphTo();
    }

    public function reviwed_book()
    {
        return $this->belongsTo('App\BookList','reviewBookID');
    }
}
