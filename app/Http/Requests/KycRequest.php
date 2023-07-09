<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Model\UserMaster;

class KycRequest extends FormRequest {

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
            'address' => 'required',
            'id_proof' => 'required|mimes:jpeg,jpg,png,pdf|max:10000',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            

            $user = UserMaster::findOrFail(Auth::guard('frontend')->user()->id);
            if ($user->email !== $this->email) {
                $checkUser = UserMaster::where('email', $this->email)->first();
                if (!empty($checkUser)) {
                    $validator->errors()->add('email', 'This email address already taken.');
                }
            }

            if ($user->phone !== $this->phone) {
                $checkUser = UserMaster::where('phone', $this->phone)->first();
                if (!empty($checkUser)) {
                    $validator->errors()->add('phone', 'This phone number already taken.');
                }
            }
            
        });
    }

}
