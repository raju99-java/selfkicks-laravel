<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Thankyou;
/* * ************Request***************** */
use App\Http\Requests\GetStartedRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\ContactUsRequest;

/* * ****************Model*********************** */
use URL;
use DB;
use Artisan;
use App\Model\UserMaster;
use App\Model\Settings;
use App\Model\Contactus;

class SiteController extends Controller {

    public function index() {

        $data = [];
        if(Auth()->guard('frontend')->guest()){
            return view('site.index', $data);
        }else{
            return redirect()->route('dashboard');
        }
        
    }

    public function post_started(GetStartedRequest $request) {

        if ($request->ajax()) {
            $data_msg = [];
            
            $expire = time() + 172800;
            setcookie('started_email', $request->input('email'), $expire, '/');

            $data_msg['url'] = Route('signup');

            return response()->json($data_msg);
        }
        
    }
    

    public function get_signup() {

        $data = [];
        return view('site.registration', $data);
    }

    public function post_signup(RegisterRequest $request) {

        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            
            $input['password'] = Hash::make($input['password']);
            $input['verification_otp'] = random_int(100000, 999999);
            //$model = UserMaster::create($input);

            Session::put('full_name', $input['full_name']);
            Session::put('email', $input['email']);
            Session::put('verification_otp', $input['verification_otp']);
            Session::put('phone', $input['phone']);
            Session::put('password', $input['password']);
            

            $email_setting = $this->get_email_data('user_registration', array('NAME' => $input['full_name'],'EMAIL' => $input['email'], 'OTP' => $input['verification_otp'] ));
        
            $email_data = [
                'to' => $input['email'],
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);

            $data_msg['msg'] = "OTP send Your Email to Verify.";

            return response()->json($data_msg);
        }
        
    }

    public function post_verify_otp(VerifyOtpRequest $request){

        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();

            $otp = Session::get('verification_otp');
            $input['type_id'] = '2';
            $input['full_name'] = Session::get('full_name');
            $input['email'] = Session::get('email');
            $input['phone'] = Session::get('phone');
            $input['password'] = Session::get('password');
            $input['status'] = '1';

            if ($otp == $input['verification_otp']){

                $user = UserMaster::create($input);

                Auth::guard('frontend')->login($user);

                Session::forget('verification_otp');
                Session::forget('full_name');
                Session::forget('email');
                Session::forget('phone');
                Session::forget('password');

                Session::forget('started_email');

                $data_msg['status'] = "1";
                $data_msg['msg'] = "You are successfully registered.";
                $data_msg['url'] = route('dashboard');

            }else {
                $data_msg['status'] = "0";
                $data_msg['msg'] = "Invalid OTP !";

            }

            return response()->json($data_msg);
        }
        
    }

    public function resend_otp(Request $request){
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            
            $input['verification_otp'] = random_int(100000, 999999);
            $input['email'] = Session::get('email');
            $input['full_name'] = Session::get('full_name');

            Session::put('verification_otp', $input['verification_otp']);
            

            $email_setting = $this->get_email_data('user_registration', array('NAME' => $input['full_name'],'EMAIL' => $input['email'], 'OTP' => $input['verification_otp'] ));
        
            $email_data = [
                'to' => $input['email'],
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);

            $data_msg['msg'] = "OTP send Your Email to Verify.";

            return response()->json($data_msg);
        }
    }

    public function get_login() {

        $data = [];
        return view('site.login', $data);
    }

    public function post_login(LoginRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $model = UserMaster::where('email', '=', $input['email'])->first();
            if (!empty($request->input('rememberMe'))) {
                $expire = time() + 172800;
                setcookie('email', $request->input('email'), $expire, '/');
                setcookie('password', $request->input('password'), $expire, '/');
            } else {
                $expire = time() - 172800;
                setcookie('email', '', $expire, '/');
                setcookie('password', '', $expire, '/');
            }
            Auth::guard('frontend')->login($model);
            $model->save();
            
            $data_msg['url'] = Route('dashboard');
            $data_msg['msg'] = "You are successfully logged in.";

            return response()->json($data_msg);
        }
    }

    public function get_forgot_password() {

        $data = [];
        return view('site.forgot-password', $data);
    }

    public function post_forgot_password(ForgotRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();

            $model = UserMaster::where('email', $input['email'])->first();

            $input['verification_otp'] = random_int(100000, 999999);

            Session::put('email', $model->email);
            Session::put('verification_otp', $input['verification_otp']);
           

            $email_setting = $this->get_email_data('forgot_password', array('NAME' => $model->full_name,'EMAIL' => $model->email, 'OTP' => $input['verification_otp'] ));
        
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);

            $data_msg['msg'] = "OTP send Your Email.";

            return response()->json($data_msg);
        }
    }

    

    public function forgot_resend_otp(Request $request){
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();

            $input['email'] = Session::get('email');
            
            $model = UserMaster::where('email', $input['email'])->first();

            $input['verification_otp'] = random_int(100000, 999999);

            Session::put('email', $model->email);
            Session::put('verification_otp', $input['verification_otp']);
           

            $email_setting = $this->get_email_data('forgot_password', array('NAME' => $model->full_name,'EMAIL' => $model->email, 'OTP' => $input['verification_otp'] ));
        
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);

            $data_msg['msg'] = "OTP send Your Email.";

            return response()->json($data_msg);
        }
    }

    public function post_forgot_verify_otp(VerifyOtpRequest $request){

        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();

            $otp = Session::get('verification_otp');
            $email = Session::get('email');

            if ($otp == $input['verification_otp']){

                $data_msg['status'] = "1";
                $data_msg['msg'] = "Reset Your Password.";
                $data_msg['url'] = Route('reset-password', ['email' => base64_encode($email), 'otp' => base64_encode($otp)]);

            }else {
                $data_msg['status'] = "0";
                $data_msg['msg'] = "Invalid OTP !";

            }

            return response()->json($data_msg);
        }
        
    }

    public function get_reset_password($email, $otp) {
        if ($email === "" && $otp === "") {
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        }
        $email = base64_decode($email);
        $otp = base64_decode($otp);

        $mail = Session::get('email');
        $token = Session::get('verification_otp');

        if ($email == $mail && $otp == $token){
            $data = [];
            return view('site.forgot-two', $data);
        }else {
            
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        }
    }


    public function post_reset_password(ResetRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();

            $input['password'] = Hash::make($input['password']);

            $email = Session::get('email');

            $model = UserMaster::where('email', '=', $email)->first();

            $model->update($input);

            Session::forget('email');
            Session::forget('verification_otp');

            $data_msg['msg'] = 'Your password changed successfully.';
            $data_msg['url'] = Route('login');

            
            return response()->json($data_msg);
        }
    }

    public function about_us(){
        $data = [];
        return view('site.about-us', $data);
    }

    public function contact_us(){
        $data = [];
        return view('site.contact-us', $data);
    }

    public function post_contact_us(ContactUsRequest $request){
        if ($request->ajax()) {
            $data_msg = [];
            
            $input = $request->all();
            $contact = Contactus::create($input);
			$admin_email = Settings::where('slug', 'admin_email')->first();
        
            
                
            if (!empty($admin_email)):
                $email_setting = $this->get_email_data('contact_us', array('ADMIN' => "Admin", 'NAME' => $contact->name, 'EMAIL' => $contact->email, 'SUBJECT' => $contact->subject, 'PHONE' => ($contact->phone != "") ? $contact->phone : 'Not Provided', 'MESSAGE' => $contact->message));
                $email_data = [
                    'to' => $admin_email->value,
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
            endif;

            $data_msg['msg'] = 'Thank you for contacting us. We will Contact you soon.';
            return response()->json($data_msg);
        }
        
    }

    public function thank_you(){
        $data = [];
        return view('site.thank_you', $data);
    }

    public function get_faq(){
        $data = [];
        return view('site.faq', $data);
    }

    public function get_investors(){
        $data = [];
        return view('site.investors', $data);
    }

    public function terms_conditions(){
        $data = [];
        return view('site.terms-conditions', $data);
    }

    public function privacy_policy(){
        $data = [];
        return view('site.privacy-policy', $data);
    }

    public function return_refund_policy(){
        $data = [];
        return view('site.return-refund-policy', $data);
    }
    
    


}
