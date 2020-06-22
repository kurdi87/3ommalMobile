<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\RoleModel;
use App\Models\SystemUserModel;
use App\Models\SystemUserRoleModel;
use App\Models\LookUpModel;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\SystemLookupModel;
use App\Models\ActionModel;
use App\Models\LanguagesModel;
use App\Http\Requests\LookUpRequest ;

use App\Models\IconModel;

class LookUpController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data['active_menuPlus'] = "LookUp";
        parent::$data['active_menu'] = "LookUp";
        parent::$data["breadcrumbs"]=["LookUp"=>parent::$data['cp_route_name'],"LookUp"=>parent::$data['cp_route_name']."/lookUp"];
    }

    public function index()
    {

        parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
        parent::$data['roles'] = RoleModel::all();
        parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();
        parent::$data['status'] = ['0' => 'Select Status','1'=>'active','2'=>'not active'];
        parent::$data["lookUp_keys"] = ['0' => 'Select LookUp_key']+LookUpModel::getLookUp_keys();



        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] =  "LookUp";
        parent::$data["breadcrumbs"]["LookUp"]="";
        return view('cp.lookUp.lookUpList', parent::$data);
    }


    public function get(Request $request)
    {
        $columns = \Input::input('columns');
        $status = $request->input("status");
        $lookUp_key = $request->input("lookUp_key");
        $filter = [];

        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $lookUp = LookUpModel::getLookUpList($filter,$status,$lookUp_key);


        $table= Datatables::of($lookUp)
            ->editColumn('active', function ($data) use($request) {
                if($request->input("export"))
                    return $data->active;
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger' ). ' label label-sm"> Status </span>';
            })
            ->editColumn('lookUp', function ($data) use($request) {
                if($request->input("export"))
                    return $data->lookUp;

                return '<a class="id" data-id="' . $data->id . '" href="'.parent::$data['cp_route_name'].'/lookUp/edit/' . $data->id . '">' . $data->lookUp . '</a>';

            })
            ->editColumn('lookUp_ar', function ($data) use($request) {

                    return $data->lookUp_ar;



            })



           

            ->editColumn('id', function ($data) use($request) {
                return  $data->id ;
            });



        if(!$request->input("export") && $request->ajax()){
            $table->addColumn('m_action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';

                $result .= '<a title="Edit lookUp" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="'.parent::$data['cp_route_name'].'/lookUp/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';


                $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" link="' . parent::$data['cp_route_name'] . '/lookUp/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered" data-toggle="confirmation" data-popout="true"   href="javascript:;">
                                                        <i class="fa fa-' . ($data->active == 1 ? "square-o" : "check-square") . '"></i>
                                                    </a>';
                $result .= '<a title="Delete" link="' . parent::$data['cp_route_name'] . '/lookUp/delete" class="btn btn-circle btn-icon-only btn-default btn-delete tooltip-one-info tooltipstered "  data-toggle="confirmation" data-popout="true"  href="javascript:;">
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
            $aliases=["name"=>"name","dlookUp"=>"dlookUp","active"=>"active"];
            $lookUp=$request->input("export");
            if(!in_array($lookUp, ["xlsx","csv","pdf"]))
                $lookUp="csv";
            $this->exportFile("LookUp Report",$this->formatAliasesold($table,$aliases),$lookUp,true);
        }
        redirect(parent::$data['cp_route_name'].'/lookUp');
    }


    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/'.parent::$data['cp_route_name'].'/lookUp');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                LookUpModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                LookUpModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $lookUp=new LookUpModel();
            $this->logAction(0,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$lookUp->getTableName(),"LookUp",$lookUp->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./'.parent::$data['cp_route_name'].'/lookUp');
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/lookUp');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }

            lookUpModel::whereIn("id", $ids)->update(["deleted_at" =>date('Y-m-d H:i:s'),"active" =>0 ]);
            $message = "Done successfully";


            $lookUp = new lookUpModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $lookUp->getTableName(), "lookUp", $lookUp->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/lookUp');
        }
    }




    public function edit($id)
    {
        $lookUp = LookUpModel::find($id);
        if (!$lookUp)
            return redirect(parent::$data['cp_route_name']."/lookUp");
        parent::$data['title'] = "Edit LookUp";
        parent::$data["result"] = $lookUp;
        parent::$data["lookUp_keys"] = ['0' => 'Select LookUp_key']+LookUpModel::getLookUp_keys();
        parent::$data['languages'] = LanguagesModel::lists('language','id')->toArray();



        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"]="";
        return view('cp.lookUp.edit', parent::$data);
    }

    public function update(LookUpRequest $request, $id)
    {
        $lookUp = LookUpModel::get()->find($id);
        if (!$lookUp)
            return redirect(parent::$data['cp_route_name']."/lookUp");
        $lookUp->lookUp = $request->input('lookUp');
        $lookUp->lookUp_ar = $request->input('lookUp_ar');
        $lookUp->lookUp_key = $request->input('lookUp_key');

        $lookUp->id=$lookUp->idd;
        $lookUp->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $lookUp;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/lookUp/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/lookUp")->with($status, $message);
    }

    public function create()
    {
        parent::$data['title'] = "Add LookUp";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");

        parent::$data["lookUp_keys"] = ['0' => 'Select LookUp_key']+LookUpModel::getLookUp_keys();


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""]="";
        return view('cp.lookUp.add', parent::$data);
    }

    public function store(LookUpRequest $request)
    {
        $lookUp = new LookUpModel();
        $lookUp->lookUp = $request->input('lookUp');
        $lookUp->lookUp_ar = $request->input('lookUp_ar');
        $lookUp->lookUp_key = $request->input('lookUp_key');


        $lookUp->save();
        $lookUp->id=$lookUp->idd;
        $lookUp->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $lookUp;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/lookUp/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/lookUp")->with($status, $message);
    }



}
