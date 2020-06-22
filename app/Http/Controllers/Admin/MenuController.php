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
use App\Http\Requests\MenuRequest ;
use App\Models\MenuModel;

class MenuController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data['active_menu'] = "Menu";
        parent::$data["breadcrumbs"]=["Menu"=>parent::$data['cp_route_name'],"Menu"=>parent::$data['cp_route_name']."/menu"]; 
    }

    public function index()
    {
        try {
            parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
            parent::$data['roles'] = RoleModel::all();
            parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();
        }
        catch (\Exception $e) {
            $e->getMessage();
        }

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] =  "Menu";
        parent::$data["breadcrumbs"]["Menu"]="";
        return view('cp.menu.menuList', parent::$data);
    }


    public function get(Request $request)
    {
        $columns = \Input::input('columns');
    
        $filter = [];
        
        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $menu = MenuModel::getMenuList($filter);


        $table= Datatables::of($menu)
            ->editColumn('active', function ($data) use($request) {
                if($request->input("export"))
                    return $data->active;
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger' ). ' label label-sm"> Status </span>';
            })
            ->editColumn('title', function ($data) use($request) {
                if($request->input("export"))
                    return $data->title;
                if (in_array(7, self::$data["allowedActions"])) {
                    return '<a class="id" data-id="' . $data->id . '" href="'.parent::$data['cp_route_name'].'/menu/edit/' . $data->id . '">' . $data->title . '</a>';
                } else {
                    return '<a class="id" data-id="' . $data->id . '">' . $data->title . '</a>';
                }
            })
            ->editColumn('language', function ($data) use($request) {
                if($request->input("export"))
                    return $data->language;
                return '<span class="" data-container="body"  data-content="' . $data->language . '">' . $data->language . '</span>';
            })
            ->editColumn('m_order', function ($data) use($request) {
                if($request->input("export"))
                    return $data->m_order;
                return '<span class="m_order">' . $data->m_order . '</span>';
            })

            ->editColumn('action', function ($data) use($request) {
                if($request->input("export"))
                    return $data->action;
                return '<span class="action">' . $data->action . '</span>';
            })
           
            ->editColumn('id', function ($data) use($request) {
                return '<span class="action">' . $data->id . '</span>';
            });

        if(!$request->input("export") && $request->ajax()){
            $table->addColumn('m_action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';
                if (in_array(7, self::$data["allowedActions"])) {
                    $result .= '<a title="Edit Menu" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="'.parent::$data['cp_route_name'].'/menu/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';
                }

                if (in_array(7, self::$data["allowedActions"])) {
                    $result .= '<a title="' .( $data->active == 1 ? "Deactivate" : "Activate") . '" href="'.parent::$data['cp_route_name'].'/menu/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
                                                        <i class="fa fa-' .($data->active == 1 ? "square-o" : "check-square" ). '"></i>
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
            $aliases=["title"=>"title","m_order"=>"Order","action"=>"Action","language"=>"Language"];
            $type=$request->input("export");
            if(!in_array($type, ["xlsx","csv","pdf"]))
                $type="csv";
            $this->exportFile("Menu Report",$this->formatAliases($table,$aliases),$type,true);
        }
        redirect(parent::$data['cp_route_name'].'/menu');
    }


     public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/'.parent::$data['cp_route_name'].'/menu');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                MenuModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                MenuModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $menu=new MenuModel();
            $this->logAction(0,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$menu->getTableName(),"Menu",$menu->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./'.parent::$data['cp_route_name'].'/menu');
        }
    }


     public function edit($id)
    {
        $menu = MenuModel::find($id);
        if (!$menu)
            return redirect(parent::$data['cp_route_name']."/menu");
        parent::$data['title'] = "Edit Menu";
        parent::$data["result"] = $menu;
        parent::$data['languages'] = LanguagesModel::lists('language','id')->toArray();

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"]="";
        return view('cp.menu.edit', parent::$data);
    }

    public function update(MenuRequest $request, $id)
    {
        $menu = MenuModel::get()->find($id);
        if (!$menu)
            return redirect(parent::$data['cp_route_name']."/menu");
        $menu->title = $request->input('title');
        $menu->m_order = $request->input('m_order');
        $menu->action = $request->input('action');
        $menu->lang = $request->input('lang');
        
      
        $menu->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $menu;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/menu/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/menu")->with($status, $message);
    }

     public function create()
    {
        parent::$data['title'] = "Add Menu";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");
        parent::$data['languages'] = LanguagesModel::lists('language','id')->toArray();
     
        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""]="";
        return view('cp.menu.add', parent::$data);
    }

    public function store(MenuRequest $request)
    {
        $menu = new MenuModel();
        $menu->title = $request->input('title');
        $menu->m_order = $request->input('m_order');
        $menu->action = $request->input('action');
        $menu->lang = $request->input('lang');
      
        $menu->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $menu;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/menu/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/menu")->with($status, $message);
    }



}
