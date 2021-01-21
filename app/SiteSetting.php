<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class SiteSetting extends Model
{
    use Notifiable;
    use HasRoles;
    
    protected $guarded = [];
}