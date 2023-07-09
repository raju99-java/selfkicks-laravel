<?php

namespace App\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class UserMaster extends Model implements Authenticatable {

    use \Illuminate\Auth\Authenticatable;

    public $confirm_password;
    protected $table = 'user_master';
    protected $fillable = [
        'type_id','full_name', 'email', 'password', 'phone','address',  'image', 'id_proof','total_points', 'kyc_verified', 'verification_otp','referral_code','earning_status','days_left',  'status', 'reset_password_otp', 'premium_member','subcription_id','subcription_status',
    ];
    protected $hidden = [
        'password', 'hash_password'
    ];

    public function subscription() {
        // return $this->belongsTo('App\Model\Subscriptions', 'subcription_id', 'id');
        return $this->belongsTo('App\Model\Subscriptions','subcription_id')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('NA');
			}
		});
    }
    

}
