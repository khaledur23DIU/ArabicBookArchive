<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class PersonCategoryList extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $guarded = [];

    public function persons()
    {
    	return $this->belongsToMany('App\PersonList','person_categorizables', 'person_category_id','person_id');
    }
}
