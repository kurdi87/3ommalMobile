<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\RoleModel;
use App\Models\SystemUserModel;
use App\Models\SystemUserRoleModel;
use App\Models\TypesModel;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\SystemLookupModel;
use App\Models\ActionModel;
use App\Models\LanguagesModel;
use App\Http\Requests\TypesRequest ;

use App\Models\IconModel;

class TypesController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data['active_menuPlus'] = "Types";
        parent::$data['active_menu'] = "General Constants";
        parent::$data["breadcrumbs"]=["Types"=>parent::$data['cp_route_name'],"Types"=>parent::$data['cp_route_name']."/types"];
    }

    public function index()
    {

        parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
        parent::$data['roles'] = RoleModel::all();
        parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();
        parent::$data['status'] = ['0' => 'Select Status','1'=>'active','2'=>'not active'];
        parent::$data["modules"] = ['0' => 'Select Module']+TypesModel::getModules();



        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] =  "Types";
        parent::$data["breadcrumbs"]["Types"]="";
        return view('cp.types.typesList', parent::$data);
    }


    public function get(Request $request)
    {
        $columns = \Input::input('columns');
        $status = $request->input("status");
        $module = $request->input("module");
        $filter = [];

        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $types = TypesModel::getTypesList($filter,$status,$module);


        $table= Datatables::of($types)
            ->editColumn('active', function ($data) use($request) {
                if($request->input("export"))
                    return $data->active;
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger' ). ' label label-sm"> Status </span>';
            })
            ->editColumn('type', function ($data) use($request) {
                if($request->input("export"))
                    return $data->type;

                return '<a class="id" data-id="' . $data->id . '" href="'.parent::$data['cp_route_name'].'/types/edit/' . $data->id . '">' . $data->type . '</a>';

            })
            ->editColumn('type_ar', function ($data) use($request) {

                    return $data->type_ar;



            })



           

            ->editColumn('id', function ($data) use($request) {
                return  $data->id ;
            });



        if(!$request->input("export") && $request->ajax()){
            $table->addColumn('m_action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';

                $result .= '<a title="Edit types" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="'.parent::$data['cp_route_name'].'/types/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';


                $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" link="' . parent::$data['cp_route_name'] . '/types/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered" data-toggle="confirmation" data-popout="true"   href="javascript:;">
                                                        <i class="fa fa-' . ($data->active == 1 ? "square-o" : "check-square") . '"></i>
                                                    </a>';
                $result .= '<a title="Delete" link="' . parent::$data['cp_route_name'] . '/types/delete" class="btn btn-circle btn-icon-only btn-default btn-delete tooltip-one-info tooltipstered "  data-toggle="confirmation" data-popout="true"  href="javascript:;">
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
            $aliases=["name"=>"name","dtype"=>"dtype","active"=>"active"];
            $type=$request->input("export");
            if(!in_array($type, ["xlsx","csv","pdf"]))
                $type="csv";
            $this->exportFile("Types Report",$this->formatAliasesold($table,$aliases),$type,true);
        }
        redirect(parent::$data['cp_route_name'].'/types');
    }


    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/'.parent::$data['cp_route_name'].'/types');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                TypesModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                TypesModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $types=new TypesModel();
            $this->logAction(0,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$types->getTableName(),"Types",$types->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./'.parent::$data['cp_route_name'].'/types');
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/types');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }

            typesModel::whereIn("id", $ids)->update(["deleted_at" =>date('Y-m-d H:i:s'),"active" =>0 ]);
            $message = "Done successfully";


            $types = new typesModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $types->getTableName(), "types", $types->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/types');
        }
    }




    public function edit($id)
    {
        $types = TypesModel::find($id);
        if (!$types)
            return redirect(parent::$data['cp_route_name']."/types");
        parent::$data['title'] = "Edit Types";
        parent::$data["result"] = $types;
        parent::$data["modules"] = ['0' => 'Select Module']+TypesModel::getModules();
        parent::$data['languages'] = LanguagesModel::lists('language','id')->toArray();



        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"]="";
        return view('cp.types.edit', parent::$data);
    }

    public function update(TypesRequest $request, $id)
    {
        $types = TypesModel::get()->find($id);
        if (!$types)
            return redirect(parent::$data['cp_route_name']."/types");
        $types->type = $request->input('type');
        $types->type_ar = $request->input('type_ar');
        $types->module = $request->input('module');

        $types->id=$types->idd;
        $types->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $types;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/types/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/types")->with($status, $message);
    }

    public function create()
    {
        parent::$data['title'] = "Add Types";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");

        parent::$data["modules"] = ['0' => 'Select Module']+TypesModel::getModules();


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""]="";
        return view('cp.types.add', parent::$data);
    }

    public function store(TypesRequest $request)
    {
        $types = new TypesModel();
        $types->type = $request->input('type');
        $types->type_ar = $request->input('type_ar');
        $types->module = $request->input('module');


        $types->save();
        $types->id=$types->idd;
        $types->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $types;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/types/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/types")->with($status, $message);
    }



}
