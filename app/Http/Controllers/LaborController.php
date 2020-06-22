<?php namespace App\Http\Controllers;

use App;
use App\Http\Requests\ContactRequest2;
use App\Models\DepartmentModel;
use App\Models\DoctorDieseasModel;
use App\Models\DoctorModel;
use App\Models\DoctorProcedureModel;
use App\Models\HeadlineModel;
use App\Models\HospitalDieseasModel;
use App\Models\HospitalModel;
use App\Models\HospitalProcedureModel;
use App\Models\MenuModel;
use App\Models\ProcedureModel;
use App\Models\SearchWordModel;
use App\Models\ServiceModel;
use App\Models\SubjectModel;
use App\Models\TypesModel;
use Config;
use Illuminate\Http\Redirect;
use Illuminate\Http\Request;
use PHPUnit\Runner\Exception;

//use App\Models\RoleModel;

class LaborController extends Controller
{
    public function __construct()
    {

        parent::$data['settings'] = App\Models\SettingModel::get();
    }

    public function getlang()
    {
        if (\Session::has('lang')) {

            if (\Session::get('lang') == 'en')
                $lang = 1;
            else if (\Session::get('lang') == 'ar')
                $lang = 2;
            else
                $lang = 3;
        } else
            $lang = 1;
        return $lang;
    }

    public function register(Request $request)
    {

        if ($request->input('category')) {
            \Cookie::queue("category", $request->input('category'), 10);

                }

        $types = TypesModel::where('module', 'register')->lists('type', 'id')->toArray();

        if (\Session::has("success")) {
            parent::$data["success"] = \Session::get("success");

        }


        return view('website.register', parent::$data);

    }

    public function login(Request $request)
    {
        if (\Session::has("success")) {
            parent::$data["success"] = \Session::get("success");

        }
        return view('website.login', parent::$data);
    }

    public function newUser(Request $request)
    {
        if (\Session::has("success")) {
            parent::$data["success"] = \Session::get("success");

        }
        return view('website.newUser', parent::$data);

    }

    public function forgetPassword(Request $request)
    {

        if (\Session::has("success")) {
            parent::$data["success"] = \Session::get("success");

        }

        return view('website.forgetPassword', parent::$data);

    }

    public function resetPassword(Request $request)
    {


        if (\Session::has("success")) {
            parent::$data["success"] = \Session::get("success");

        }

        return view('website.resetPassword', parent::$data);


    }


    public function about()
    {

        return view('website.about', parent::$data);
    }

    public function term()
    {

        return view('website.term', parent::$data);
    }

    public function privacy()
    {

        return view('website.privacy', parent::$data);
    }

    public function contact()
    {

        return view('website.contact-us', parent::$data);
    }

    public function web()
    {

        return view('website.index2', parent::$data);
    }


    public function index()
    {

        return view('website.index', parent::$data);
    }

    public function jobApplication(Request $request)
    {
        if ($request->category)
            \Cookie::queue("category", $request->category, 10);


        if (auth()->user()) {
            if (auth()->user()->SysUsr_FullName) {
                parent::$data["category"] = $request->input('category');
                return view('website.job-application', parent::$data);
            } else
                return redirect("user/profile");

        }
        return redirect("/register?category=" . $request->category);
    }


    public function getCategories()
    {
        $rootCat = App\Models\CategoryModel::where('parent_id', 0)->where('active', 1)->get();
        $cat = [];
        $count = 0;
        foreach ($rootCat as $c) {

            $sub = App\Models\CategoryModel::getSubCategorys($c->id)->get();
            $a = ['name' => 'work_fields', 'val' => $c->name, 'title' => $c->name, 'icon' => $c->icon, 'page' => count($sub) > 0 ? $c->name : 'ما هو نوع بطاقة الهوية', 'props' => "setSelection(this)"];
            $cat[$count] = $a;
            $count++;
        }

        return \Response::json(array('id' => 'work_type', "c" => count($rootCat), 'title' => 'مجالات العمل', 'icon' => 'logo', 'data' => $cat));
    }

    public function getSubCategories()
    {
        $rootCat = App\Models\CategoryModel::where('parent_id', 0)->where('active', 1)->get();

        $childss = [];
        $j = 0;
        foreach ($rootCat as $c) {
            $sub = App\Models\CategoryModel::getSubCategorys($c->id)->get();

            $dataArry = [];
            $i = 0;
            foreach ($sub as $s) {
                $b = ['name' => 'work_special', 'val' => $s->name, 'title' => $s->name, 'icon' => $s->icon, "page" => 'ما هو نوع بطاقة الهوية', 'props' => "setSelection(this)"];
                $dataArry[$i] = $b;
                $i++;
            }
            $childs = ['id' => $c->id,
                'title' => $c->name,
                'icon' => 'icon-constructions icon-lg',
                'data' => $dataArry];

            $childss[$j] = $childs;
            $j++;

        }


        return \Response::json($childss);
    }


}
