<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model {

    protected $table = 'subscriptions';
    protected $fillable = [
        'name','price','details','validity','earning_point','referral_status','premium_plan','status'
    ];
    
    
}
