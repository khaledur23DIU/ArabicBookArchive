<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class BookBasicInfoRef extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    protected $guarded = [];

    public function refable()
    {
    	return $this->morphTo();
    }
}
