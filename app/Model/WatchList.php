<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model {

    
    protected $table = 'watch_lists';
    protected $fillable = ['user_id','video_id','status'];

    public function video() {
        // return $this->belongsTo('App\Model\Video', 'video_id', 'id');
        return $this->belongsTo('App\Model\Video','video_id')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('NA');
			}
		});
    }

    public function user() {
        // return $this->belongsTo('App\Model\UserMaster', 'user_id', 'id');
        return $this->belongsTo('App\Model\UserMaster','user_id')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('NA');
			}
		});
    }
    

}
