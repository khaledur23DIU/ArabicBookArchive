<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class BookBasicInfoWritingPlace extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    protected $guarded = [];

    public function writing_placeable()
    {
    	return $this->morphTo();
    }

    public function writing_place()
    {
        return $this->belongsTo('App\PlaceList','writingPlaceID');
    }
}
