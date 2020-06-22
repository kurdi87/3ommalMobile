<?php

namespace App\Http\Controllers\Admin\API\Controllers;


use App\Http\Controllers\Admin\API\Resources\Error;
use App\Http\Controllers\Controller;
use App\Models\LaborinjuryModel;
use App\Models\CityModel;
use \Illuminate\Support\Facades\Validator;
use App\Models\LaborSalaryModel;
use App\Models\TypesModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


/**
 * Address controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class LaborController extends Controller
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
        /*
                auth()->setDefaultDriver($this->guard);

               $this->middleware('auth:' . $this->guard);

                $this->_config = request('_config');*/

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function labor_requests_salary(Request $request)
    {
        //try {
            $lang = $this->lang;

            $labor_salary_request = $request->input("limit");

            $order = $request->input("order") ? $request->input("order") : 'labaorslalryrequest_date';
            $status = $request->input("status");
            $type = $request->input("type");
            $limit = $request->input("limit");
            $page = $request->input("page");
            $city = $request->input("city");

            $from = $request->input("from");
            $to = $request->input("to");

            $search = $request->input("search");
            $role = JWTAuth::parseToken()->toUser()->role;
            $columns = \Input::input('columns');
            $user_id = JWTAuth::parseToken()->toUser()->SysUsr_ID;

            $labor_salary = LaborSalaryModel::getRequestListAPI($user_id)->paginate($limit, $columns = ['*'], 'page', $page);


            return response()->json([
                'error' => 0,
                'message' => 'labor_salary',
                'data' =>
                    [
                        'labor_salary' => $labor_salary
                    ]
            ]);
       /* } catch (\Exception $x) {
            return Error::JsonError($x->getMessage(), $x->getLine(), 'faild', 'خطأ في البيانات', 'Address Error');
        }*/

    }

    public function storelaborRequestSalary(Request $request)
    {
        //  try {
        $customer = auth($this->guard)->user();


        $validator = Validator::make(request()->all(), [


        ]);
        if ($validator->fails()) {
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

        }

        $labaorslalryrequest = LaborSalaryModel::create(request()->except('token'));


        $labaorslalryrequest->updated_at = date('Y-m-d');
        $labaorslalryrequest->user_id = JWTAuth::parseToken()->toUser()->SysUsr_ID;


        $labaorslalryrequest->active = 1;

        $labaorslalryrequest->save();





        return response()->json([
            'error' => 0,
            'message' => 'Your Request has been created successfully.',
            'data' => LaborSalaryModel::find($labaorslalryrequest->id)
        ]);
        // } catch (\Exception $x) {
        //   return Error::JsonError($x->getMessage(), $x->getLine(), 'faild', 'خطأ في المدخلات', 'Address Error');
        //  }
    }

    public function updatelaborRequestSalary(Request $request, $id)
    {
        //try {
            $user = JWTAuth::parseToken()->toUser();


            $validator = Validator::make(request()->all(), [
             
            ]);

            if ($validator->fails()) {
                return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

            }

            $labaorslalryrequest = LaborSalaryModel::get()->find($id);
            if (!$labaorslalryrequest)
                return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());



            $labaorslalryrequest->update(request()->except('token'));
            $labaorslalryrequest->updated_at = date('Y-m-d');
            $labaorslalryrequest->user_id = JWTAuth::parseToken()->toUser()->SysUsr_ID;


            $labaorslalryrequest->save();





            $message = "Done";
            $status = "success";


            return response()->json([
                'error' => 0,
                'message' => 'Your labaor slalry request has been updated successfully.',
                'data' => LaborSalaryModel::find($labaorslalryrequest->id)
            ]);

       /* } catch (\Exception $x) {
            return Error::JsonError($x->getMessage(), $x->getCode(), 'faild', 'خطأ في تحديث الحادث', 'labaorslalryrequest Error');
        }*/
    }

    public function destroylaborRequestSalary(Request $request, $id)
    {
        try {
            $user = JWTAuth::parseToken()->toUser();;


            $labaorslalryrequest = LaborSalaryModel::get()->find($id);
            if (!$labaorslalryrequest)
                return Error::JsonError('404', '404', 'faild', 'خطأ في تحديث الحادث', 'labaorslalryrequest Error');

            $labaorslalryrequest->active = 0;
            $labaorslalryrequest->deleted_at = date('Y-m-d');

            $labaorslalryrequest->save();
        

            return response()->json([
                'error' => 0,
                'message' => 'Your labaor slalry request has been deleted successfully.',
            ]);
        } catch (\Exception $x) {
            return Error::JsonError($x->getMessage(), $x->getCode(), 'faild', 'خطأ في تحديث الحادث', 'labaorslalryrequest Error');
        }
    }
    
    
    
    /////

    public function labor_requests_injury(Request $request)
    {
        //try {
        $lang = $this->lang;

        $labor_injury_request = $request->input("limit");

        $order = $request->input("order") ? $request->input("order") : 'labaorslalryrequest_date';
        $status = $request->input("status");
        $type = $request->input("type");
        $limit = $request->input("limit");
        $page = $request->input("page");
        $city = $request->input("city");

        $from = $request->input("from");
        $to = $request->input("to");

        $search = $request->input("search");
        $role = JWTAuth::parseToken()->toUser()->role;
        $columns = \Input::input('columns');
        $user_id = JWTAuth::parseToken()->toUser()->SysUsr_ID;

        $labor_injury = LaborInjuryModel::getRequestListAPI($user_id)->paginate($limit, $columns = ['*'], 'page', $page);


        return response()->json([
            'error' => 0,
            'message' => 'labor_injury',
            'data' =>
                [
                    'labor_injury' => $labor_injury
                ]
        ]);
        /* } catch (\Exception $x) {
             return Error::JsonError($x->getMessage(), $x->getLine(), 'faild', 'خطأ في البيانات', 'Address Error');
         }*/

    }

    public function storelaborRequestInjury(Request $request)
    {
        //  try {
        $customer = auth($this->guard)->user();


        $validator = Validator::make(request()->all(), [


        ]);
        if ($validator->fails()) {
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

        }

        $labaorslalryrequest = LaborInjuryModel::create(request()->except('token'));


        $labaorslalryrequest->updated_at = date('Y-m-d');
        $labaorslalryrequest->user_id = JWTAuth::parseToken()->toUser()->SysUsr_ID;


        $labaorslalryrequest->active = 1;

        $labaorslalryrequest->save();





        return response()->json([
            'error' => 0,
            'message' => 'Your Request has been created successfully.',
            'data' => LaborInjuryModel::find($labaorslalryrequest->id)
        ]);
        // } catch (\Exception $x) {
        //   return Error::JsonError($x->getMessage(), $x->getLine(), 'faild', 'خطأ في المدخلات', 'Address Error');
        //  }
    }

    public function updatelaborRequestInjury(Request $request, $id)
    {
        //try {
        $user = JWTAuth::parseToken()->toUser();


        $validator = Validator::make(request()->all(), [

        ]);

        if ($validator->fails()) {
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

        }

        $labaorslalryrequest = LaborInjuryModel::get()->find($id);
        if (!$labaorslalryrequest)
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());



        $labaorslalryrequest->update(request()->except('token'));
        $labaorslalryrequest->updated_at = date('Y-m-d');
        $labaorslalryrequest->user_id = JWTAuth::parseToken()->toUser()->SysUsr_ID;


        $labaorslalryrequest->save();





        $message = "Done";
        $status = "success";


        return response()->json([
            'error' => 0,
            'message' => 'Your labaor slalry request has been updated successfully.',
            'data' => LaborInjuryModel::find($labaorslalryrequest->id)
        ]);

        /* } catch (\Exception $x) {
             return Error::JsonError($x->getMessage(), $x->getCode(), 'faild', 'خطأ في تحديث الحادث', 'labaorslalryrequest Error');
         }*/
    }

    public function destroylaborRequestInjury(Request $request, $id)
    {
        try {
            $user = JWTAuth::parseToken()->toUser();;


            $labaorslalryrequest = LaborInjuryModel::get()->find($id);
            if (!$labaorslalryrequest)
                return Error::JsonError('404', '404', 'faild', 'خطأ في تحديث الحادث', 'labaorslalryrequest Error');

            $labaorslalryrequest->active = 0;
            $labaorslalryrequest->deleted_at = date('Y-m-d');

            $labaorslalryrequest->save();


            return response()->json([
                'error' => 0,
                'message' => 'Your labaor slalry request has been deleted successfully.',
            ]);
        } catch (\Exception $x) {
            return Error::JsonError($x->getMessage(), $x->getCode(), 'faild', 'خطأ في تحديث الحادث', 'labaorslalryrequest Error');
        }
    }
    ///////




    public function getLists(Request $request)
    {
        // try {
        $lang = $this->lang;
        $yes_no = TypesModel::getTypes('yesno', $lang, "2");

        $city = CityModel::getlist($lang, "2");
        $gender = TypesModel::getTypes('gender', $lang, "2");
        $regions = TypesModel::getTypes('region', $lang, "2");

        $role = JWTAuth::parseToken()->toUser()->role;
        //$role=auth()->user()
        //$Allpatients = PatientModel::getPatients($role, "json");


        return response()->json([
            'error' => 0,
            'message' => 'labaorslalryrequest Data',
            'data' =>
                [

                    'gender' => $gender,
                    'yes_no' => $yes_no,

                    'city' => $city,
                    'region' => $regions,


                ]
        ]);
        // } catch (\Exception $x) {
        //     return Error::JsonError($x->getMessage(), $x->getLine(), 'faild', 'خطأ في البيانات', 'Address Error');
        //  }

    }


}