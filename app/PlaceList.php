<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class PlaceList extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $fillable = [
        'countryID','city',
    ];

    public function country()
    {
        return $this->belongsTo('App\CountryList','countryID');
    }

    public function residences()
    {
        return $this->hasMany('App\PersonListResidence','residencePlaceID');
    }

    public function writing_places()
    {
        return $this->hasMany('App\PersonListResidence','writingPlaceID');
    }

    public function libraries()
    {
        return $this->hasMany('App\LibraryList','placeID');
    }

    public function publishers()
    {
        return $this->hasMany('App\PublisherList','placeID');
    }

    public function birth_in_persons()
    {
        return $this->hasMany('App\PersonList','birthPlaceID');
    }

    public function death_in_persons()
    {
        return $this->hasMany('App\PersonList','deathPlaceID');
    }


}
