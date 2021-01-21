<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class LanguageList extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $fillable = [
        'language','language_iso_code_2','language_iso_code_3',
    ];

    public function book_basic_info()
    {
        return $this->hasOne('App\BookBasicInfo','id');
    }
}
