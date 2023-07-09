<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    protected $table = 'notifications';
    protected $fillable = [
        'logo','name','description','status'
    ];
    
    
}
