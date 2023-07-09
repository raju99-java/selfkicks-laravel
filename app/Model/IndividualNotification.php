<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IndividualNotification extends Model {

    protected $table = 'individual_notifications';
    protected $fillable = [
        'user_id','logo','name','description','status'
    ];
    
    
}
