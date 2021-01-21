<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class LibraryList extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $guarded = [];

    public function place()
    {
    	return $this->belongsTo('App\PlaceList','placeID');
    }

    public function manuscripts()
    {
    	return $this->hasMany('App\ManuscriptInfo','id');
    }
}
