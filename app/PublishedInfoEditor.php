<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class PublishedInfoEditor extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $guarded = [];
    protected $table = 'published_info_editors';

    public function editor_basic_book()
    {
    	return $this->belongsTo('App\BookBasicInfo','basic_book_id');
    }

    public function editor()
    {
    	return $this->belongsTo('App\PersonList','editorID');
    }


}
