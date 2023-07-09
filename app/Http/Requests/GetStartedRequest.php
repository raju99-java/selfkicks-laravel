<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Model\UserMaster;

class GetStartedRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required|email|max:255',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            
            if(isset($this->email)){
                    $checkUser = UserMaster::where('email', $this->email)->where('status','<>','3')->count();
                    if ($checkUser > 0){
                        $validator->errors()->add('email', 'Email already in use.');
                }
            }
            
        });
    }

    

}
