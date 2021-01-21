<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class PersonListResidence extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $guarded = [];

    public function residenceable()
    {
    	return $this->morphTo();
    }

    public function residence_place()
    {
        return $this->belongsTo('App\PlaceList','residencePlaceID');
    }
}
