<?php

namespace App\Http\Controllers\Admin\API\Controllers;


use App\Http\Controllers\Admin\API\Resources\Error;
use App\Http\Controllers\Controller;
use App\Models\SystemUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


/**
 * Address controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class UserController extends Controller
{
    /**
     * Contains current guard
     *
     * @var array
     */
    protected $guard;
    protected $lang;
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CustomerAddressRepository object
     *
     * @var Object
     *
     * /**
     * Controller instance
     *
     * @param Webkul\Customer\Repositories\CustomerAddressRepository $customerAddressRepository
     */
    public function __construct(
        // CustomerAddressRepository $customerAddressRepository
    )
    {

        $this->lang = request()->input('lang') ? '0' : '2';

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'SysUsr_Mobile' => ['required', 'string', 'max:20', 'unique:system_user'],
        ]);
        if ($validator->fails()) {
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

        }
        $data = '1234567890';
        $hashed_random_password = (substr(str_shuffle($data), 0, 6));
        $data = $request->all();
        $type = $request->type;
        try {


            $user = SystemUserModel::create([
                'SysUsr_Mobile' => $data['SysUsr_Mobile'],
                'SysUsr_UserName' => $data['SysUsr_Mobile'],
                'SysUsr_CreatedBy' => 1,
                'SysUsr_Password' => app('hash')->make($request->input('SysUsr_Mobile')),
                'is_verified' => '0',
                'verification_key' => $hashed_random_password,
            ]);


            //  try {


            $Data = [
                "user" => $user


            ];


            smsapi()->gateway('hotsms')->sendMessage($user->SysUsr_Mobile, " شكرا لكم للانضمام إلى عمال كود التفعيل هو " . $user->verification_key . "");

            //  } catch (\Exception $ex) {
            //     $message = "Done";
            //     $status = "success;; Error in mail";
            // }
            if ($user)
                return response()->json([
                    'error' => 0,
                    'message' => 'user',
                    'data' =>
                        [
                            'user' => $user
                        ]
                ]);
            else {
                $message = "Error";
                return Error::JsonError('404', '404', 'faild', 'ادخل رقما أخر', ' Error');
            }

        } catch (\Exception $x) {
            //     $message="Error";
            return Error::JsonError($x->getMessage(), $x->getLine(), 'faild', 'خطأ في البيانات', 'Address Error');
        }


    }

    protected function update(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'SysUsr_FullName' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:20'],
            'social_status' => ['string', 'max:20'],
        ]);
        if ($validator->fails()) {
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

        }


        $data = $request->all();

        //try {

            $user = JWTAuth::parseToken()->toUser();
            $user->update(request()->except('token'));


            //  try {


            $Data = [
                "user" => $user


            ];


            //smsapi()->gateway('hotsms')->sendMessage($user->SysUsr_Mobile, " شكرا لكم للانضمام إلى عمال كود التفعيل هو " . $user->verification_key . "");

            //  } catch (\Exception $ex) {
            //     $message = "Done";
            //     $status = "success;; Error in mail";
            // }
            if ($user)
                return response()->json([
                    'error' => 0,
                    'message' => 'user',
                    'data' =>
                        [
                            'user' => $user
                        ]
                ]);
            else {
                $message = "Error";
                return Error::JsonError('404', '404', 'faild', 'ادخل رقما أخر', ' Error');
            }

        /*} catch (\Exception $x) {
            //     $message="Error";
            return Error::JsonError($x->getMessage(), $x->getLine(), 'faild', 'خطأ في البيانات', 'Address Error');
        }*/


    }

    protected function verify(Request $request)
    {
        $verification_key = $request->input('verification_key');
        $user_id = $request->input('user_id');
        $validator = Validator::make(request()->all(), [
            'verification_key' => ['required', 'string', 'max:6'],
            'user_id' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

        }

        $user = SystemUserModel::where('verification_key', $verification_key)->where('SysUsr_ID', $user_id)->where('is_verified', 0)->get()->first();
        if ($user) {
            $user->SysUsr_Status = 5;
            $user->is_verified = 1;
            $user->save();
            return response()->json([
                'error' => 0,
                'message' => 'user',
                'data' =>
                    [
                        'data' => $user
                    ]
            ]);

        } else {
            return Error::JsonError('404', '404', 'faild', 'خطأ في البيانات', ' Error');
        }
    }

    public function resetPassword(Request $request)
    {
        if (!JWTAuth::parseToken()->toUser()) {
            $mobile = $request->input("mobile");
            $data = '1234567890';
            $user = SystemUserModel::where('SysUsr_UserName', $mobile)->get()->first();
            if ($user) {
                $hashed_random_password = (substr(str_shuffle($data), 0, 6));
                $user->Pass_Reset = ($hashed_random_password);
                $user->save();
                $msg = $hashed_random_password;
                try {

                    //  try {


                    $Data = [
                        "user" => $user


                    ];


                    smsapi()->gateway('hotsms')->sendMessage($user->SysUsr_Mobile, " شكرا لكم للانضمام إلى عمال كود استعادة كلمة المرور هو " . $user->Pass_Reset . "");

                    //  } catch (\Exception $ex) {
                    //     $message = "Done";
                    //     $status = "success;; Error in mail";
                    // }
                    $message = "Password Reset Successfully";
                    if ($user)
                        return response()->json([
                            'error' => 0,
                            'message' => 'please check sms',

                        ]);
                    else {
                        $message = "Error";
                        return Error::JsonError('404', '404', 'faild', 'خطأ في البيانات', ' Error');
                    }

                } catch (\Exception $x) {
                    //     $message="Error";
                    return Error::JsonError($x->getMessage(), $x->getLine(), 'faild', 'ffخطأ في البيانات', 'Address Error');
                }

            } else {
                return Error::JsonError('404', '404', 'faild', 'خطأ في البيانات', ' Error');
            }
        }


    }


    protected function newPass(PasswordRequest $request)
    {
        $validator = Validator::make(request()->all(), [
            'new_pass' => ['required', 'string', 'max:6'],
        ]);
        if ($validator->fails()) {
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

        }
        $new_pass = $request->input('password');

        $user = JWTAuth::parseToken()->toUser();
        if ($user) {
            $user->SysUsr_Password = bcrypt($new_pass);
            $user->save();
            return response()->json([
                'error' => 0,
                'message' => 'user',
                'data' =>
                    [
                        'data' => $user
                    ]
            ]);

        } else {
            return Error::JsonError('404', '404', 'faild', 'خطأ في البيانات', ' Error');
        }
    }

    protected function reset_new_password(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'password' => ['required', 'string', 'min:6'],
            'pass_reset' => ['required', 'string', 'max:6'],
            'mobile' => ['required', 'string', 'max:20'],
        ]);
        if ($validator->fails()) {
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

        }
        $new_pass = $request->input('password');
        $pass_reset = $request->input('pass_reset');
        $mobile = $request->input('mobile');
        $user = SystemUserModel::where('Pass_Reset', $pass_reset)->where('SysUsr_UserName', $mobile)->where('SysUsr_Status', 5)->get()->first();
        if ($user) {
            $user->SysUsr_Password = bcrypt($new_pass);
            $user->save();
            return response()->json([
                'error' => 0,
                'message' => 'user',
                'data' =>
                    [
                        'data' => $user
                    ]
            ]);

        } else {
            return Error::JsonError('404', '404', 'faild', 'خطأ في البيانات', ' Error');
        }
    }


}