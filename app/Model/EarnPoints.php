<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EarnPoints extends Model {

    
    protected $table = 'earn_points';
    protected $fillable = [
        'plan_id','user_id','video_id','points','date','status'
    ];

    public function subscription() {
        // return $this->belongsTo('App\Model\Subscriptions', 'plan_id', 'id');
        return $this->belongsTo('App\Model\Subscriptions','plan_id')->withDefault(function ($data) {
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

    public function video() {
        // return $this->belongsTo('App\Model\Video', 'video_id', 'id');
        return $this->belongsTo('App\Model\Video','video_id')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('NA');
			}
		});
    }
    

}
