<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

    
    protected $table = 'videos';
    protected $fillable = [
        'video_name','image','hosted_url','video_image','embeded_video','features','actors','directors','description','latest','trending','popular','prime','status'
    ];
    

}
