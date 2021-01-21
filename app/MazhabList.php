<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class MazhabList extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $fillable = [
        'mazhabName','mazhabType',
    ];


    public function mazhabTyp()
    {
        return $this->belongsTo('App\MazhabTypeList','mazhabType');
    } 

    public function person_mazhab_fikihs()
    {
        return $this->hasMany('App\PersonList','mazhabFikih');
    }

    public function person_mazhab_akidahs()
    {
        return $this->hasMany('App\PersonList','mazhabAkidah');
    }
}
