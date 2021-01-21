<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class PersonListBook extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $guarded = [];
    protected $table = 'person_list_books';

    public function person_list_bookable()
    {
    	return $this->morphTo();
    }

    public function book()
    {
        return $this->belongsTo('App\BookList','id');
    }
}
