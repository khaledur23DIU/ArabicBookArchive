<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class MazhabTypeList extends Model
{
	use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $fillable = [
        'mazhabType',
    ];
    
    public function mazhabs()
    {
        return $this->hasMany('App\MazhabList','id');
    }
}
