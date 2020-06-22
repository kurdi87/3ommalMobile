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
use App\Http\Requests\SpecialityRequest ;
use App\Models\SpecialityModel;
use App\Models\IconModel;

class SpecialityController extends SuperAdminController
{

    public function __construct()
    {
        try {
            parent::__construct();
            parent::$data['active_menu'] = "special";
            parent::$data["breadcrumbs"] = ["Speciality" => parent::$data['cp_route_name'], "Speciality" => parent::$data['cp_route_name'] . "/speciality"];
            parent::$data["create_edit"] = array(10, 1, 12);
            parent::$data["spu"] = array(15);
            parent::$data['role']  = \Auth::user("admin")->role;
        }catch (\Exception $e) {
            redirect(parent::$data['cp_route_name'] . '/login');
        }
    }

    public function index()
    {
    
            parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
            parent::$data['roles'] = RoleModel::all();
            parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();


        
        

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] =  "Speciality";
        parent::$data["breadcrumbs"]["Speciality"]="";
        return view('cp.speciality.specialityList', parent::$data);
    }


    public function get(Request $request)
    {
        $columns = \Input::input('columns');
        $role = parent::$data["role"];
        $create_edit = parent::$data["create_edit"];
        $spu = parent::$data["spu"];
        $filter = [];
        
        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $speciality = SpecialityModel::getSpecialityList($filter);


        $table= Datatables::of($speciality)
            ->editColumn('active', function ($data) use($request) {
                if($request->input("export"))
                    return $data->active;
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger' ). ' label label-sm"> Status </span>';
            })
            ->editColumn('special', function ($data) use($request) {
                if($request->input("export"))
                    return $data->special;

                    return '<a class="id" data-id="' . $data->id . '" href="'.parent::$data['cp_route_name'].'/speciality/edit/' . $data->id . '">' . $data->special . '</a>';

            })



            ->editColumn('keywords', function ($data) use($request) {
                if($request->input("export"))
                    return $data->keywords;
                return '<span class="type">' .$data->keywords. '</span>';
            })
           
            ->editColumn('id', function ($data) use($request) {
                if($request->input("export"))
                    return $data->id;
                return '<span class="action">' . $data->id . '</span>';
            });



        if(!$request->input("export") && $request->ajax()){
            $table->addColumn('m_action', function ($data)use ($role, $create_edit) {

                    $result = '<div class="actions tbl-sm-actions tblactions-four">';
                if (in_array($role, $create_edit)) {
                    $result .= '<a title="Edit speciality" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="' . parent::$data['cp_route_name'] . '/speciality/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';


                    $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" link="' . parent::$data['cp_route_name'] . '/speciality/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered" data-toggle="confirmation" data-popout="true"   href="javascript:;">
                                                        <i class="fa fa-' . ($data->active == 1 ? "square-o" : "check-square") . '"></i>
                                                    </a>';
                    $result .= '<a title="Delete" link="' . parent::$data['cp_route_name'] . '/speciality/delete" class="btn btn-circle btn-icon-only btn-default btn-delete tooltip-one-info tooltipstered "  data-toggle="confirmation" data-popout="true"  href="javascript:;">
                                                        <i class="fa fa-remove"></i>
                                                    </a>';
                }

                

                return $result;
            });
        }

        $table=$table->make(true);

        if ($request->ajax())
            return $table;
        if($request->input("export")){
            $table=json_decode(json_encode($table->getData()),true);
            $aliases=["id"=>"id","special"=>"name","code"=>"code",'active'=>'active'];
            $type=$request->input("export");
            if(!in_array($type, ["xlsx","csv","pdf"]))
                $type="csv";
            $this->exportFile("Speciality Report",$this->formatAliases($table,$aliases),$type,true);
        }
        redirect(parent::$data['cp_route_name'].'/speciality');
    }


     public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/'.parent::$data['cp_route_name'].'/speciality');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                SpecialityModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                SpecialityModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $speciality=new SpecialityModel();
            $this->logAction(0,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$speciality->getTableName(),"Speciality",$speciality->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./'.parent::$data['cp_route_name'].'/speciality');
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/speciality');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }

            specialityModel::whereIn("id", $ids)->update(["deleted_at" =>date('Y-m-d H:i:s'),"active" =>0 ]);
            $message = "Done successfully";


            $speciality = new specialityModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $speciality->getTableName(), "speciality", $speciality->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/speciality');
        }
    }

    


    public function edit($id)
    {
        $speciality = SpecialityModel::find($id);
        if (!$speciality)
            return redirect(parent::$data['cp_route_name']."/speciality");
        parent::$data['title'] = "Edit Speciality";
        parent::$data["result"] = $speciality;
        parent::$data['languages'] = LanguagesModel::lists('language','id')->toArray();

       

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"]="";
        return view('cp.speciality.edit', parent::$data);
    }

    public function update(SpecialityRequest $request, $id)
    {
        $speciality = SpecialityModel::get()->find($id);
        if (!$speciality)
            return redirect(parent::$data['cp_route_name']."/speciality");
        $speciality->special = $request->input('special');
        $speciality->special_ar = $request->input('special_ar');
        $speciality->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $speciality;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/speciality/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/speciality")->with($status, $message);
    }

     public function create()
    {
        parent::$data['title'] = "Add Speciality";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");
    

       
     
        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""]="";
        return view('cp.speciality.add', parent::$data);
    }

    public function store(SpecialityRequest $request)
    {
        $speciality = new SpecialityModel();
        $speciality->special = $request->input('special');
        $speciality->special_ar = $request->input('special_ar');
        
      
        $speciality->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $speciality;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/speciality/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/speciality")->with($status, $message);
    }



}
