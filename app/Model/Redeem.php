<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model {

    
    protected $table = 'redeems';
    protected $fillable = [
        'user_id','status'
    ];

    public function user() {
        // return $this->belongsTo('App\Model\UserMaster', 'user_id', 'id');
        return $this->belongsTo('App\Model\UserMaster','user_id')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('NA');
			}
		});
    }
    

}
