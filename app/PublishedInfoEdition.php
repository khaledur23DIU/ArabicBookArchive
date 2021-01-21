<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class PublishedInfoEdition extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $guarded = [];
    protected $table = 'published_info_editions';

    public function edition_basic_book()
    {
    	return $this->belongsTo('App\BookBasicInfo','basic_book_id');
    }
}
