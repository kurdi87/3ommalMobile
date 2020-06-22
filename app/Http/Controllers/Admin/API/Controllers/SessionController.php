<?php

namespace App\Http\Controllers\Admin\API\Controllers;

use App\Models\SystemLookupModel;
use App\Models\SystemUserModel;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\API\Resources\Error;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Session controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class SessionController extends Controller
{
    /**
     * Contains current guard
     *
     * @var array
     */
    protected $guard;

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;


    /**
     * Controller instance
     *
     * @param Webkul\Customer\Repositories\CustomerRepository $customerRepository
     */
    public function __construct()
    {
        try {




        } catch (\Exception $x) {
            return Error::JsonError(500, 500, 'faild', 'خطأ', 'General Server Error');
        }
    }

    /**
     * Method to store user's sign up form data to DB.
     *
     * @return Mixed
     */
    function create()
    {
        // try {

        $validator = Validator::make(request()->all(), [
            'SysUsr_UserName' => 'required',
            'SysUsr_Password' => 'required'
        ]);
        if ($validator->fails()) {
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

        }

        $jwtToken = null;
        $status = SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_ACTIVE");
        $attempt = ['SysUsr_UserName' => request()->input('SysUsr_UserName'), 'password' =>  request()->input('SysUsr_Password'), 'SysUsr_Status' => $status];

        if (!$jwtToken = JWTAuth::attempt($attempt)) {
            return response()->json([
                'message' => 'Invalid Email or Password',
                'code' => 401,
                'error' => 401,
                'messageAr' => 'خطأ في اسم المستخدم أو  كلمة المرور',

            ]);
        }

        //Event::fire('customer.after.login', request()->input('email'));

        $user = auth($this->guard)->user();

        return response()->json([
            'token' => $jwtToken,
            'error' => 0,
            'message' => 'Logged in successfully.',
            'data' => $user,
        ]);
        // } catch (\Exception $x) {
        //    return Error::JsonError(422, 422, 'faild', 'خطأ تسجيل الدخول', 'login Error Unprocessable Entity (validation failed)');
        // }
    }

    /**
     * Get details for current logged in customer
     *
     * @return \Illuminate\Http\Response
     */
    public
    function get()
    {
        try {
            try {

                $user = auth($this->guard)->user();
            } catch (\InvalidArgumentException $x) {
                return Error::JsonError(500, $x->code(), 'faild', 'معلومات الحساب خاظئة', 'Bad login info');
            }

            return response()->json([
                'data' => $user,
                'error' => 0
            ]);
        } catch (\InvalidArgumentException $x) {
            return Error::JsonError(500, $x->getCode(), 'faild', 'معلومات الحساب خاظئة', 'Bad login info');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function update()
    {
        try {
            $user = auth($this->guard)->user();


            $validator = Validator::make(request()->all(), [
                'first_name' => 'required',
                'email' => 'required|email|unique:customers,email,' . $user->id,
                'attachment' => 'file|max:4100',
            ]);
            if ($validator->fails()) {
                return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

            }

            $data = request()->all();


            if (!isset($data['password']) || !$data['password']) {
                unset($data['password']);
            } else {
                $data['password'] = bcrypt($data['password']);
            }
            if (request()->file('attachment')) {
                $picName = request()->file('attachment')->getClientOriginalName();
                $picName = uniqid() . '_' . $picName;
                $path = 'uploads' . DIRECTORY_SEPARATOR . 'profile';
                $destinationPath = rtrim(app()->basePath('public_html/' . $path), '/');//public_path($path); // upload path
                //dd($request);
                //File::makeDirectory($destinationPath, 0777, true, true);
                request()->file('attachment')->move($destinationPath, $picName);
                $user->SysUsr_ThumbImage = $path . DIRECTORY_SEPARATOR . $picName;
                $user->save();
            }





            return response()->json([
                'message' => 'Your account has been created successfully.',
                'error' => 0,
                'data' => $user
            ]);
        } catch (\Exception $x) {
            return Error::JsonError(422, $x->getCode(), 'faild', 'خطأ في البيانات ', 'Data Error Unprocessable Entity (validation failed)');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function destroy()
    {
        //try {
            Auth::logout();

            return response()->json([
                'message' => 'Logged out successfully.',
                'error' => 0,
            ]);
       // } catch (\Exception $x) {
       //     return Error::JsonError(422, $x->getCode(), 'faild', 'خطأ تسجيل الخروج', 'Error when Sign Out');
      //  }
    }
}