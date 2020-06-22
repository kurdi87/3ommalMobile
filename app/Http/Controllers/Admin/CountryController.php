<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\RoleModel;
use App\Models\SystemUserModel;
use App\Models\SystemUserRoleModel;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\SystemLookupModel;
use App\Models\ActionModel;
use App\Models\LanguagesModel;
use App\Http\Requests\CountryRequest ;
use App\Models\CountryModel;
use App\Models\IconModel;
use App\Models\UploadHandler;
use Intervention\Image\ImageManagerStatic as Image;

class CountryController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data['active_menuPlus'] = "Country";
        parent::$data['active_menu'] = "General Constants";
        parent::$data["breadcrumbs"]=["Country"=>parent::$data['cp_route_name'],"Country"=>parent::$data['cp_route_name']."/country"];
    }

    public function index()
    {

            parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
            parent::$data['roles'] = RoleModel::all();
            parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();





        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] =  "Country";
        parent::$data["breadcrumbs"]["Country"]="";
        return view('cp.country.countryList', parent::$data);
    }


    public function get(Request $request)
    {
        $columns = \Input::input('columns');

        $filter = [];

        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $country = CountryModel::getCountryList($filter);


        $table= Datatables::of($country)
            ->editColumn('active', function ($data) use($request) {
                if($request->input("export"))
                    return $data->country_active;
                return ' <span class="' . ($data->country_active == 1 ? 'label-success' : 'label-danger' ). ' label label-sm"> Status </span>';
            })
            ->editColumn('name_en', function ($data) use($request) {
                if($request->input("export"))
                    return $data->name_en;

                    return '<a class="id" data-id="' . $data->id . '" href="'.parent::$data['cp_route_name'].'/country/edit/' . $data->id . '">' . $data->name_en . '</a>';

                    return '<a class="id" data-id="' . $data->id . '">' . $data->name_en . '</a>';

            })



            ->editColumn('id', function ($data) use($request) {
                return '<span class="action">' . $data->id . '</span>';
            })

              ->editColumn('des', function ($data) use($request) {
             if($data->des==1)
                 return '<span class ="text text-danger">Yes</span>';
             else
                 return '<span class ="text text-success">No</span>';
            });

        if(!$request->input("export") && $request->ajax()){
            $table->addColumn('m_action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';

                    $result .= '<a title="Edit country" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="'.parent::$data['cp_route_name'].'/country/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';



                $result .= '<a title="' . ($data->country_active == 1 ? "Deactivate" : "Activate") . '" link="' . parent::$data['cp_route_name'] . '/country/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->country_active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered" data-toggle="confirmation" data-popout="true"   href="javascript:;">
                                                        <i class="fa fa-' . ($data->country_active == 1 ? "square-o" : "check-square") . '"></i>
                                                    </a>';

                $result .= '<a title="Delete" link="' . parent::$data['cp_route_name'] . '/country/delete" class="btn btn-circle btn-icon-only btn-default btn-delete tooltip-one-info tooltipstered "  data-toggle="confirmation" data-popout="true"  href="javascript:;">
                                                        <i class="fa fa-remove"></i>
                                                    </a>';



                return $result;
            });
        }

        $table=$table->make(true);

        if ($request->ajax())
            return $table;
        if($request->input("export")){
            $table=json_decode(json_encode($table->getData()),true);
            $aliases=["name_en"=>"name_en","country_active"=>"country_active"];
            $type=$request->input("export");
            if(!in_array($type, ["xlsx","csv","pdf"]))
                $type="csv";
            $this->exportFile("Country Report",$this->formatAliases($table,$aliases),$type,true);
        }
        redirect(parent::$data['cp_route_name'].'/country');
    }


    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/country');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }

            countryModel::whereIn("id", $ids)->update(["deleted_at" =>date('Y-m-d H:i:s'),"country_active" =>0 ]);
            $message = "Done successfully";


            $country = new countryModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $country->getTableName(), "country", $country->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/country');
        }
    }
     public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/'.parent::$data['cp_route_name'].'/country');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                CountryModel::whereIn("id", $ids)->update(["country_active" => "0"]);
                $message = "Done successfully";
            } else {
                CountryModel::whereIn("id", $ids)->update(["country_active" => "1"]);
                $message = "Done successfully";
            }

            $country=new CountryModel();
            $this->logAction(0,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$country->getTableName(),"Country",$country->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./'.parent::$data['cp_route_name'].'/country');
        }
    }


     public function edit($id)
    {
        $country = CountryModel::find($id);
        if (!$country)
            return redirect(parent::$data['cp_route_name']."/country");
        parent::$data['title'] = "Edit Country";
        parent::$data["result"] = $country;
        parent::$data['des'] = array('1' => 'Yes', '0' => 'NO');



        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"]="";
        return view('cp.country.edit', parent::$data);
    }

    public function update(CountryRequest $request, $id)
    {
        $country = CountryModel::get()->find($id);
        if (!$country)
            return redirect(parent::$data['cp_route_name']."/country");
        $country->name_en = $request->input('name_en');
        $country->name_ar = $request->input('name_ar');
        $country->img = $request->input('img');
        $country->des = $request->input('des');



        $country->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $country;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/country/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/country")->with($status, $message);
    }

     public function create()
    {
        parent::$data['title'] = "Add Country";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");
        parent::$data['des'] = array('1' => 'Yes', '0' => 'NO');



        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""]="";
        return view('cp.country.add', parent::$data);
    }

    public function store(CountryRequest $request)
    {
        $country = new CountryModel();
        $country->name_en = $request->input('name_en');
        $country->name_ar = $request->input('name_ar');
        $country->des = $request->input('des');
        $country->img = $request->input('img');


        $country->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $country;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/country/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/country")->with($status, $message);
    }
    public function uploadImage(Request $request, $id)
    {
        $path = public_path('img'); // upload directory
        $file = \Input::file('choose-file');
        $ext = $file->guessClientExtension();
        $message = '';
        $filename = time() . str_random(25) . '.' . $ext;
        //$uploadSuccess = $file->move($path . DIRECTORY_SEPARATOR . "headline", $filename);

        // if($request->hasFile('image'))
        //{
        $image       = $file;

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(1280, 720);
        $image_resize->save(public_path('img/country/' .$filename));

        //}

        if ($image_resize) {
            if($id!='0')
            {
                $country = CountryModel::get()->find($id);
                if (!$country)
                    return redirect(parent::$data['cp_route_name']."/blog");

                $country->img=$filename;
                $country->save();
            }
            return response(array('status' => 1, 'file_name' => $filename, 'my_server' => \URL::asset('')));
        } else {
            return response(array('status' => 2, 'message' => $message));
        }
    }


}
