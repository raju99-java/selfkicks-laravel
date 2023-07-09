<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model {

    
    protected $table = 'subscription_history';
    protected $fillable = [
        'plan_id','user_id','txnid','amount','payment_status'
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
    

}
