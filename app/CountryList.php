<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class CountryList extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $fillable = [
        'country','country_iso_code_2','country_iso_code_3','country_un_code',
    ];

    public function cities()
    {
        return $this->hasMany('App\PlaceList','countryID');
    }
}
