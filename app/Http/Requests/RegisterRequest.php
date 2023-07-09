<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\UserMaster;

class RegisterRequest extends FormRequest {

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
            'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|digits:10',
            'password' => 'required|min:6',
            'referral_code' => 'required|min:12|max:12',
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

            if(isset($this->phone)){
                $checkUserPhone = UserMaster::where('phone', $this->phone)->where('status', '<>', '3')->count();
                if ($checkUserPhone > 0)
                    $validator->errors()->add('phone', 'Phone Number already in use.');
            }

            if(isset($this->referral_code)){
                $checkCode = UserMaster::where('referral_code', $this->referral_code)->where('status','<>','3')->count();
                if (empty($checkCode)){
                    $validator->errors()->add('referral_code', 'Invalid Referral Code!');
            }
        }
            
        });
    }

}
