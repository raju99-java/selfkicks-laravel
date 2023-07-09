<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Validator;
use Carbon\Carbon;
use App\Helpers\CalenderApi;
use Yajra\Datatables\Datatables;
/* * ************Request***************** */
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\KycRequest;
/* * ****************Model*********************** */
use URL;
use DB;
use Artisan;
use App\Model\UserMaster;
use App\Model\Slider;
use App\Model\Subscriptions;
use App\Model\Settings;
use App\Model\SubscriptionHistory;
use App\Model\EarnPoints;
use App\Model\Video;
use App\Model\PrimeVideo;
use App\Model\WatchList;
use App\Model\Redeem;


class UserController extends Controller {

    public function get_dashboard() {

        $data = [];
        $data['sliders'] = Slider::where('status','1')->get();
        $data['trending_videos'] = Video::where('prime','0')->where('trending','1')->where('status','1')->get();
        $data['popular_videos'] = Video::where('prime','0')->where('popular','1')->where('status','1')->get();
        $data['latest_videos'] = Video::where('prime','0')->where('latest','1')->where('status','1')->get();
        $date = date("d-m-Y");
        $data['prime_videos'] = PrimeVideo::where('start', 'like',  '%' . $date .'%')->where('status','1')->get();
        // echo "<pre>";print_r($data['prime_videos']);exit;
        return view('user.dashboard', $data);
    }

    public function get_video_details($id) {

        $data = [];
        $user_id = Auth::guard('frontend')->user()->id;
        $data['user'] = $user = UserMaster::where('id',$user_id)->first();
        $data['video_carousel'] = Video::where('prime','0')->where('status','1')->get();
        $data['video_ad'] = Settings::where('slug','=','video_ad')->first();

        if($user->subcription_id != '0'){

            $id = base64_decode($id);

            $data['unique_video'] = $unique_video = Video::findorFail($id);

            if($unique_video->prime == '1'){

                $date = date("d-m-Y");

                $data['prime_video'] = $prime_video = PrimeVideo::where('video_id',$id)->where('start', 'like',  '%' . $date .'%')->first();

                $startTime = date('H:i', strtotime($prime_video->start));
                $expiryTime = date('H:i', strtotime($prime_video->expiry));
                $time = date('H:i');

                // print_r($startTime);print_r($expiryTime);print_r($time);exit;

                if($time >= $startTime && $time <= $expiryTime){

                    return view('user.video-details', $data);

                }else if($time <= $startTime){
                    return redirect()->route('dashboard')->with('success', "This Prime Video Starts soon... ");

                }else if($time >= $expiryTime){
                    return redirect()->route('dashboard')->with('error', "This Prime Video time is Over. ");
                }

                

            }else{
                return view('user.video-details', $data);
            }

        }else{
            return redirect()->route('account')->with('error', "You don't have any Membership Plan. ");
        }
        
    }

    public function post_watch_video(Request $request) {

        if($request->ajax()){
            $data_msg = [];
            $input = [];
            $id = $request->input('video_id');
            $video_id = base64_decode($id);
            // print_r($video_id);exit;
            $video = Video::where('id',$video_id)->first();

            if(!$video){
                $data_msg['status'] = 'error';
                $data_msg['msg'] = "Something went wrong.";
            }else{

                // earning point logics started here
                    if($video->prime == '1'){
                        $user_id = Auth()->guard('frontend')->user()->id;
                        $user = UserMaster::findOrFail($user_id);
                        if($user->earning_status == '1'){
                            $date = date("d-m-Y");
                            $prime_video = PrimeVideo::where('video_id',$video->id)->where('start', 'like',  '%' . $date .'%')->first();

                            if($prime_video){
                                
                                $check = EarnPoints::where('user_id',$user_id)->where('video_id',$prime_video->video_id)->where('date', 'like',  '%' . $date .'%')->count();

                                // print_r($check);exit;

                                if($check <= 0){

                                    $date_time = date("d-m-Y H:i");

                                    $earn_point = Settings::where('slug','earning_point')->first();
                                    $model = new EarnPoints();

                                    $input['plan_id'] = $user->subcription_id;
                                    $input['user_id'] = $user->id;
                                    $input['video_id'] = $prime_video->video_id;
                                    $input['points'] = $earn_point->value;
                                    $input['date'] = $date_time;
                                    $input['status'] = '1';

                                    $model->fill($input)->save();

                                    $user->total_points = $user->total_points + $earn_point->value;
                                    $user->save();
                                }

                            }

                        }
                    }
                //end

                $data_msg['status'] = 'success';
                $data_msg['content'] = view('user.watch-video', compact('video'))->render();
            }

            return response()->json($data_msg);

        }
    }

    public function get_watch_list() {

        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $data['watch_lists'] = WatchList::where('user_id', $user_id)->where('status', '1')->get();
        return view('user.watch-list', $data);
    }

    public function post_add_watch_list(Request $request) {

        if ($request->ajax()) {
            $data = [];
            $input = [];
            $video_id = base64_decode($request->input('video_id')); // this id is refer to - video id
            $user_id = Auth()->guard('frontend')->user()->id;
            
            $check = WatchList::where('user_id', $user_id)->where('video_id', $video_id)->where('status', '1')->first();

            if (!empty($check)) {

                $data['status'] = 'error';
                $data['msg'] = "This Video already in your watch list.";

            } else {

                $input['user_id'] = $user_id;
                $input['video_id'] = $video_id;
                $input['status'] = '1';
                WatchList::create($input);
                
                $data['status'] = 'success';
                $data['msg'] = "Video successfully added to your watch list.";

            }

            return response()->json($data);
        }
        
    }

    public function post_remove_watch_list(Request $request) {

        if ($request->ajax()) {
            $data = [];
            $input = [];
            $watch_id = base64_decode($request->input('watch_id')); // this id is refer to - watch id
            
            $model = WatchList::findOrFail($watch_id);

            if (!empty($model)) {

                $model->delete();
                
                $data['status'] = 'success';
                $data['msg'] = "Video removed from your watch list.";                

            } else {

                $data['status'] = 'error';
                $data['msg'] = "Something went wrong !";

            }

            return response()->json($data);
        }
        
    }

    public function get_account() {

        $data = [];
        $user_id = Auth::guard('frontend')->user()->id;
        $data['user'] = $user = UserMaster::where('id',$user_id)->first();
        $data['plan_history'] = SubscriptionHistory::where('user_id',$user_id)->where('payment_status','1')->get();
        $data['redeem'] = Settings::where('slug','threshold_value')->first();
        return view('user.account', $data);
    }

    public function get_profile() {

        $data = [];
        $user_id = Auth::guard('frontend')->user()->id;
        $data['user'] = $user = UserMaster::where('id',$user_id)->first();
        if(!empty($user)){
            return view('user.profile', $data);
        }else{
            return redirect()->route('account')->with('error', 'Oops! Something went wrong in this url.');
        }
        
    }

    public function post_profile(ProfileUpdateRequest $request){
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();

            $id = $input['id'];
            $model = UserMaster::findorFail($id);
            
            
            if($model->password !== $input['password'] ){
                $input['password'] = Hash::make($input['password']);
            }

            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $input['image'] = $imagename;
            }

            

            $model->update($input);

            $data_msg['url'] = Route('account');
            $data_msg['msg'] = "Your Profile Updated Successfully.";

            return response()->json($data_msg);
        }
    }

    public function get_kyc_details(){

        $data = [];
        $user_id = Auth::guard('frontend')->user()->id;
        $data['user'] = $user = UserMaster::where('id',$user_id)->first();
        if($user->kyc_verified == '0'){
            return view('user.kyc-details', $data);
        }else if($user->kyc_verified == '1'){
            return redirect()->route('account')->with('success', 'Your KYC Verification is going on  Process.');
        }else{
            return redirect()->route('account')->with('success', 'Your Account will be KYC Verified.');
        }
    }

    public function post_kyc_details(KycRequest $request){
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();

            $id = $input['id'];
            $model = UserMaster::findorFail($id);
            

            if ($request->hasFile('id_proof')) {
                $sample_image = $request->file('id_proof');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/id_proof');
                $sample_image->move($destinationPath, $imagename);
                $input['id_proof'] = $imagename;
            }

            $input['kyc_verified'] = '1';

            $model->update($input);

            $data_msg['url'] = Route('account');
            $data_msg['msg'] = "Your KYC Verification is going on  Process.";

            return response()->json($data_msg);
        }
    }

    public function get_subscription_plan(){
        $data = [];
        $data['subscriptions'] = Subscriptions::where('status','1')->get();

        $user_id = Auth::guard('frontend')->user()->id;
        $data['user'] = $user = UserMaster::where('id',$user_id)->first();
        if($user->premium_member == '0'){
            return view('user.subscription-plan', $data);
        }else{
            return redirect()->route('account')->with('success', 'You are a Premium Member.');
        }
    }

    public function get_payment_method($id){
        $data = [];
        $planid = base64_decode($id);
        $data['plan'] = Subscriptions::where('id',$planid)->first();

        // $data['user_id'] = Auth::guard('frontend')->user()->id;

        $MERCHANT_KEY = Settings::where('slug', 'merchant_key')->first();
        $data['MERCHANT_KEY'] = $MERCHANT_KEY->value;
        $SALT = Settings::where('slug', 'salt')->first();
        $data['SALT'] = $SALT->value;
        $check_test_mode = Settings::where('slug', 'test_mode')->first();
        if ($check_test_mode->value == 1) {
            // $data['BASE_URL'] = 'https://sandboxsecure.payu.in'; //sandbox
            $data['BASE_URL'] = 'https://test.payu.in'; //sandbox
        } else {
            $data['BASE_URL'] = 'https://secure.payu.in'; //production
        }

        return view('user.payment-method', $data);
    }

    public function post_payment_method(Request $request){

        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();

            $plan = Subscriptions::findOrFail($input['plan_id']);

            $input['user_id'] = Auth::guard('frontend')->user()->id;
            $input['txnid'] = 'selfkicks_' . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
            $input['amount'] = $plan->price;

            $model = SubscriptionHistory::create($input);

            $slink = Route('success-subscription', ['id' => $model->id]);
            $flink = Route('cancel-subscription', ['id' => $model->id]);

            $key = Settings::where('slug', 'merchant_key')->first();
            $MERCHANT_KEY = $key->value;
            $salt = Settings::where('slug', 'salt')->first();
            $SALT = $salt->value;
            $amount = $plan->price;
            $txnid = $model->txnid;
            $posted = array();

            $posted = array(
                'key' => $MERCHANT_KEY,
                'txnid' => $txnid,
                'amount' => $amount,
                'firstname' => $model->user->full_name,
                'email' => $model->user->email,
                'productinfo' => 'Plan fee',
                'surl' => $slink,
                'furl' => $flink,
                'service_provider' => 'payu_paisa',
            );

            if (empty($posted['txnid'])) {
                $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            } else {
                $txnid = $posted['txnid'];
            }
            $hash = '';
            $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

            if (empty($posted['hash']) && sizeof($posted) > 0) {
                $hashVarsSeq = explode('|', $hashSequence);
                $hash_string = '';
                foreach ($hashVarsSeq as $hash_var) {
                    $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                    $hash_string .= '|';
                }
                $hash_string .= $SALT;
                $hash = strtolower(hash('sha512', $hash_string));
            } elseif (!empty($posted['hash'])) {
                $hash = $posted['hash'];
            }

            $data_msg['msg'] = "Go for payment.";
            $data_msg['surl'] = $slink;
            $data_msg['furl'] = $flink;
            $data_msg['txnid'] = $txnid;
            $data_msg['amount'] = $amount;
            $data_msg['hash'] = $hash;
            $data_msg['firstname'] = $model->user->full_name;
            $data_msg['email'] = $model->user->email;
            $data_msg['phone'] = $model->user->phone;
            
            return response()->json($data_msg);

        }

    }

    public function post_success_subscription(Request $request, $id){
        $data = [];

        $model = SubscriptionHistory::where('id', '=', $id)->first();
        $model->payment_status = '1';
        $model->save();

        $plan_id = $model->plan_id;
        $plan = Subscriptions::findOrFail($plan_id);
        
        $user_id = Auth::guard('frontend')->user()->id;
        $user = UserMaster::where('id',$user_id)->first();

        if($plan->referral_status != '0'){
            $user->referral_code = $this->rand_string(12);
            
        }else{
            $user->referral_code = NULL;
            
        }

        if($plan->premium_plan != '0'){
            $user->premium_member = '1';
        }else{
            $user->premium_member = '0';
        }

        if($plan->earning_point != '0'){
            $user->earning_status = '1';
        }else{
            $user->earning_status = '0';
        }

        $user->subcription_id = $plan->id;

        if($user->days_left != ''){
            $user->days_left = $user->days_left + $plan->validity;
        }else{
            $user->days_left = $plan->validity;
        }
        
        $user->subcription_status = '1';

        $user->save();

        $dateto = date('jS M Y', strtotime($model->created_at));
        $datefrom = $this->expiry_date($user->days_left);

        $email_setting = $this->get_email_data('purchase_plan', array('NAME' => $user->full_name,'PLAN' => $plan->name, 'PRICE' => $plan->price, 'DATE TO' => $dateto, 'EXP' =>  $datefrom));
        $email_data = [
            'to' => $user->email,
            'subject' => $email_setting['subject'],
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMail($email_data);

        return redirect()->route('account')->with('success', 'Your Subscription done successfully.');
        

    }

    public function cancel_subscription(Request $request, $id){
        return redirect()->route('account')->with('error', 'Payment Failed !');
    }

    

    public function get_point_history(){
        $data = [];
        $user_id = Auth::guard('frontend')->user()->id;
        $data['point_history'] = EarnPoints::where('user_id',$user_id)->where('status','1')->get();
        return view('user.point-history', $data);
    }

    public function post_redeem_request(Request $request){

        if ($request->ajax()) {
            $data = [];
            $input = [];
            $id = base64_decode($request->input('user_id')); // this id is refer to - watch id
            
            $user = UserMaster::findOrFail($id);

            if (!empty($user)) {

                $input['user_id'] = $user->id;

                $check = Redeem::where('user_id',$user->id)->where('status','<>','2')->count();

                if($check > 0){

                    $data['status'] = 'success';
                    $data['msg'] = "Your Redeem request is on process.";

                }else{

                    $redeem = Redeem::create($input);

                    $admin_email = Settings::where('slug', 'admin_email')->first();
                    
                    if (!empty($admin_email)):

                        $email_setting = $this->get_email_data('redeem', array('ADMIN' => "Admin", 'NAME' => $redeem->user->full_name, 'EMAIL' => $redeem->user->email, 'PHONE' => ($redeem->user->phone != "") ? $redeem->user->phone : 'Not Provided', 'POINTS' => $redeem->user->total_points));

                        $email_data = [
                            'to' => $admin_email->value,
                            'subject' => $email_setting['subject'],
                            'template' => 'signup',
                            'data' => ['message' => $email_setting['body']]
                        ];
                        $this->SendMail($email_data);

                    endif;
                    
                    $data['status'] = 'success';
                    $data['msg'] = "Your Redeem request sent successfully.";
                    
                }

                                

            } else {

                $data['status'] = 'error';
                $data['msg'] = "Something went wrong !";

            }

            return response()->json($data);
        }

    }

    public function logout() {
        Auth::guard('frontend')->logout();
        return redirect('/')->with('success', 'You are successfully logged out.');
    }
   

}
