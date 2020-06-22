<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CityRequest;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\RoleModel;
use App\Models\SystemLookupModel;
use App\Models\TypesModel;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use yajra\Datatables\Datatables;

class CityController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data['active_menuPlus'] = "City";
        parent::$data['active_menu'] = "General Constants";
        parent::$data["breadcrumbs"] = ["City" => parent::$data['cp_route_name'], "City" => parent::$data['cp_route_name'] . "/city"];
    }

    public function index()
    {

        parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
        parent::$data['roles'] = RoleModel::all();
        parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();
        parent::$data['country'] = ['' => 'Select Country'] + CountryModel::lists('name_en', 'id')->toArray();


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] = "City";
        parent::$data["breadcrumbs"]["City"] = "";
        return view('cp.city.cityList', parent::$data);
    }


    public function get(Request $request)
    {
        $columns = \Input::input('columns');
        $country = $request->input("country");
        $filter = [];

        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $city = CityModel::getCityList($filter, $country);


        $table = Datatables::of($city)
            ->editColumn('active', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->city_active;
                return ' <span class="' . ($data->city_active == 1 ? 'label-success' : 'label-danger') . ' label label-sm"> Status </span>';
            })
            ->editColumn('country', function ($data) use ($request) {

                return CountryModel::getCountryName($data->country_id);

            })
            ->editColumn('prov', function ($data) use ($request) {

                return CityModel::getCityName($data->prov);

            })
            ->editColumn('region', function ($data) use ($request) {

                return TypesModel::getTypeName($data->region);

            })
            ->editColumn('name_en', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->name_en;

                return '<a class="id" data-id="' . $data->id . '" href="' . parent::$data['cp_route_name'] . '/city/edit/' . $data->id . '">' . $data->name_en . '</a>';

                return '<a class="id" data-id="' . $data->id . '">' . $data->name_en . '</a>';

            })
            ->editColumn('id', function ($data) use ($request) {
                return '<span class="action">' . $data->id . '</span>';
            });


        if (!$request->input("export") && $request->ajax()) {
            $table->addColumn('m_action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';

                $result .= '<a title="Edit city" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="' . parent::$data['cp_route_name'] . '/city/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';


                $result .= '<a title="' . ($data->city_active == 1 ? "Deactivate" : "Activate") . '" link="' . parent::$data['cp_route_name'] . '/city/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->city_active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered" data-toggle="confirmation" data-popout="true"   href="javascript:;">
                                                        <i class="fa fa-' . ($data->city_active == 1 ? "square-o" : "check-square") . '"></i>
                                                    </a>';

                $result .= '<a title="Delete" link="' . parent::$data['cp_route_name'] . '/city/delete" class="btn btn-circle btn-icon-only btn-default btn-delete tooltip-one-info tooltipstered "  data-toggle="confirmation" data-popout="true"  href="javascript:;">
                                                        <i class="fa fa-remove"></i>
                                                    </a>';


                return $result;
            });
        }

        $table = $table->make(true);

        if ($request->ajax())
            return $table;
        if ($request->input("export")) {
            $table = json_decode(json_encode($table->getData()), true);
            $aliases = ["name_en" => "name_en", "city_active" => "city_active"];
            $type = $request->input("export");
            if (!in_array($type, ["xlsx", "csv", "pdf"]))
                $type = "csv";
            $this->exportFile("City Report", $this->formatAliases($table, $aliases), $type, true);
        }
        redirect(parent::$data['cp_route_name'] . '/city');
    }


    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/city');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }

            cityModel::whereIn("id", $ids)->update(["deleted_at" => date('Y-m-d H:i:s'), "city_active" => 0]);
            $message = "Done successfully";


            $city = new cityModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $city->getTableName(), "city", $city->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/city');
        }
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/city');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                CityModel::whereIn("id", $ids)->update(["city_active" => "0"]);
                $message = "Done successfully";
            } else {
                CityModel::whereIn("id", $ids)->update(["city_active" => "1"]);
                $message = "Done successfully";
            }

            $city = new CityModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $city->getTableName(), "City", $city->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/city');
        }
    }


    public function edit($id)
    {
        $city = CityModel::find($id);
        if (!$city)
            return redirect(parent::$data['cp_route_name'] . "/city");
        parent::$data['title'] = "Edit City";
        parent::$data["result"] = $city;
        parent::$data['prov'] = CityModel::getlistProv();
        parent::$data['region'] = TypesModel::getTypes('region');


        parent::$data['country'] = ['' => 'Select Country'] + CountryModel::lists('name_en', 'id')->toArray();

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"] = "";
        return view('cp.city.edit', parent::$data);
    }

    public function update(CityRequest $request, $id)
    {
        $city = CityModel::get()->find($id);
        if (!$city)
            return redirect(parent::$data['cp_route_name'] . "/city");
        $city->name_en = $request->input('name_en');
        $city->name_ar = $request->input('name_ar');
        $city->type = $request->input('type');
        $city->country_id = $request->input('country_id');
        $city->img = $request->input('img');
        $city->prov = $request->input('prov');
        $city->region = $request->input('region');


        $city->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $city;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name'] . "/city/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name'] . "/city")->with($status, $message);
    }

    public function create()
    {
        parent::$data['title'] = "Add City";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");
        parent::$data['prov'] = CityModel::getlistProv();
        parent::$data['region'] = TypesModel::getTypes('region');

        parent::$data['country'] = ['' => 'Select Country'] + CountryModel::lists('name_en', 'id')->toArray();

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""] = "";
        return view('cp.city.add', parent::$data);
    }

    public function store(CityRequest $request)
    {
        $city = new CityModel();
        $city->name_en = $request->input('name_en');
        $city->name_ar = $request->input('name_ar');
        $city->type = $request->input('type');
        $city->prov = $request->input('prov');
        $city->region = $request->input('region');
        $city->country_id = $request->input('country_id');

        $city->img = $request->input('img');


        $city->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $city;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name'] . "/city/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name'] . "/city")->with($status, $message);
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
        $image = $file;

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(1280, 720);
        $image_resize->save(public_path('img/city/' . $filename));

        //}

        if ($image_resize) {
            if ($id != '0') {
                $city = CityModel::get()->find($id);
                if (!$city)
                    return redirect(parent::$data['cp_route_name'] . "/blog");

                $city->img = $filename;
                $city->save();
            }
            return response(array('status' => 1, 'file_name' => $filename, 'my_server' => \URL::asset('')));
        } else {
            return response(array('status' => 2, 'message' => $message));
        }
    }


}
