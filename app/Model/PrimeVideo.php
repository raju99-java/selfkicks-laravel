<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PrimeVideo extends Model {

    
    protected $table = 'prime_videos';
    protected $fillable = [
        'video_id','shows','start','expiry','status'
    ];
    
    public function video() {
        // return $this->belongsTo('App\Model\Video', 'video_id', 'id');
        return $this->belongsTo('App\Model\Video','video_id')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('NA');
			}
		});
    }

}
