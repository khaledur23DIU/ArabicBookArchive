<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class PublishedInfo extends Model
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    
    protected $guarded = [];
    protected $table = 'published_infos';

    public function book_basic_infos()
    {
        return $this->hasMany('App\BookBasicInfo','id');
    }

    public function book_publisher()
    {
        return $this->belongsTo('App\PersonList','publisherID');
    }


    public function book_basic_info()
    {
        return $this->belongsTo('App\BookBasicInfo','basic_book_id');
    }

    
}
