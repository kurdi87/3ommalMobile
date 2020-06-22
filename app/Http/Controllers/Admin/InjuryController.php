<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InjuryRequest;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\IconModel;
use App\Models\LaborInjuryModel;
use App\Models\LanguagesModel;
use App\Models\RequestStatusModel;
use App\Models\RoleModel;
use App\Models\StatusModel;
use App\Models\SystemLookupModel;
use App\Models\SystemUserModel;
use App\Models\AttModel;
use App\Models\TypesModel;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

class InjuryController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data["lang"]=1;
        parent::$data['active_menu'] = "طلبات إصابةعمل";
        parent::$data["breadcrumbs"] = ["طلبات إصابةعمل" => parent::$data['cp_route_name'], "طلبات إصابةعمل" => parent::$data['cp_route_name'] . "/injury"];
    }

    public function index()
    {

        parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
        parent::$data['roles'] = RoleModel::all();
        parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();
        parent::$data['city'] = CountryModel::getlist();
        parent::$data['users'] = ['0' => 'Select Employee'] + SystemUserModel::getUsersArray(1);
        parent::$data['status'] = StatusModel::getTypes('RequestsTransaction');

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] = "طلبات إصابةعمل";
        parent::$data["breadcrumbs"]["طلبات إصابةعمل"] = "";
        return view('cp.injury.injuryList', parent::$data);
    }


    public function get(Request $request)
    {
        $columns = \Input::input('columns');

        $filter = [];

        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }
        $status = $request->input("status");

        $user_id = $request->input("user_id");
        $city = $request->input("city");

        $from = $request->input("from");
        $to = $request->input("to");

        $Injury = LaborInjuryModel::getInjuryList($filter,$user_id,$status,0,0,0,0,$from,$to,0,$city);


        $table = Datatables::of($Injury)
            ->editColumn('active', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->active;
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger') . ' label label-sm"> Status </span>';
            })
            ->editColumn('name', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->name;

                return '<a class="id" data-id="' . $data->id . '" href="' . parent::$data['cp_route_name'] . '/injury/edit/' . $data->id . '">' . $data->name . '</a>';

            })
            ->editColumn('email', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->email;
                return '<a href="mailto:#" >' . $data->email . '</a>';
            })
            ->editColumn('subject', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->subject;
                return '<span class="m_order">' . $data->subject . '</span>';
            })
            ->editColumn('created_at', function ($data) use ($request) {

                return date('Y-m-d',strtotime($data->created_at));

            })
            ->editColumn('message', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->message;
                return '<span class="type">' . mb_convert_encoding(substr($data->message, 0, 200), 'UTF-8', 'UTF-8') . '</span>';
            })
            ->editColumn('telephone', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->telephone;
                return '<a href="tel:' . $data->telephone . '" >' . $data->telephone . '</a>';
            })



            ->editColumn('admin_status', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->admin_status;

                $x = '';
                switch ($data->status) {

                    case "0":
                        $x = '<span class="label-success label label-sm">' . $data->admin_status . '</span>';
                        break;
                    case "1":
                        $x = '<span class="label-warning label label-sm">' . $data->admin_status . '</span>';
                        break;
                    case "2":
                        $x = '<span class="label-primary label label-sm">' . $data->admin_status . '</span>';
                        break;
                    case "3":
                        $x = '<span class="label-danger label label-sm">' . $data->admin_status . '</span>';
                        break;
                    default:
                        $x = '<span class="label-default label label-sm">' . $data->admin_status . '</span>';

                }

                return $x;


                '<span class="type">' . $data->admin_status . '</span>';
            })
            ->editColumn('id', function ($data) use ($request) {

                return '<span class="action">' . $data->id . '</span>';
            });


        if (!$request->input("export") && $request->ajax()) {
            $table->addColumn('m_action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';

                $result .= '<a title="معاينة الطلب" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="' . parent::$data['cp_route_name'] . '/injury/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';


                $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" href="' . parent::$data['cp_route_name'] . '/injury/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
                                                        <i class="fa fa-' . ($data->active == 1 ? "square-o" : "check-square") . '"></i>
                                                    </a>';


                return $result;
            });
        }

        $table = $table->make(true);

        if ($request->ajax())
            return $table;
        if ($request->input("export")) {
            // $table=json_decode(json_encode($table->getData()),true);
            $aliases = ["name" => "name", "email" => "email", "subject" => "subject"];
            $type = $request->input("export");
            if (!in_array($type, ["xlsx", "csv", "pdf"]))
                $type = "csv";
            $this->exportFile("Injury Report", $this->formatAliases($table, $aliases), $type, true);
        }
        redirect(parent::$data['cp_route_name'] . '/injury');
    }


    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/injury');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                LaborInjuryModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                LaborInjuryModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $Injury = new LaborInjuryModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $Injury->getTableName(), "طلبات إصابةعمل", $Injury->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/injury');
        }
    }


    public function edit($id)
    {
        $Injury = LaborInjuryModel::find($id);
        if (!$Injury)
            return redirect(parent::$data['cp_route_name'] . "/injury");
        parent::$data['title'] = "معاينة الطلب";
        parent::$data["result"] = $Injury;
        parent::$data['att_type'] = TypesModel::getTypes('att', parent::$data["lang"]);
        parent::$data['adminAction'] = StatusModel::getTypes('RequestsTransaction');


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"] = "";
        return view('cp.injury.edit', parent::$data);
    }

    public function update(Request $request, $id)
    {
        $Injury = LaborInjuryModel::get()->find($id);
        if (!$Injury)
            return redirect(parent::$data['cp_route_name'] . "/injury");

        $Injury->status = $request->input('adminAction');
        $Injury->admin_id = \Auth::user("admin")->SysUsr_ID;
        $Injury->notes = $request->input('notes');


        $Injury->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $Injury;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name'] . "/injury/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name'] . "/injury")->with($status, $message);
    }

    /* public function create()
    {
        parent::$data['title'] = "Add Injury";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");
    
        parent::$data['languages'] = LanguagesModel::lists('language','id')->toArray();
        parent::$data['icon'] = IconModel::lists('icon','icon_css')->toArray();
       
     
        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""]="";
        return view('cp.injury.add', parent::$data);
    }

    public function store(InjuryRequest $request)
    {
        $Injury = new LaborInjuryModel();
        $Injury->name = $request->input('name');
        $Injury->s_order = $request->input('s_order');
        $Injury->mini_note = $request->input('mini_note');
        $Injury->notes = $request->input('notes');
        $Injury->icon = $request->input('icon');
        $Injury->lang = $request->input('lang');
        
      
        $Injury->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $Injury;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/injury/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/injury")->with($status, $message);
    }
*/

    //////////////////////////
    public function addAtt(Request $request)
    {
        $injury_att = new AttModel();
        $id = $request->input('injury_id');

        $injury_att->att_id = $id;

        $injury_att->module = "injury";
        $injury_att->title = $request->input('title');
        $injury_att->type = $request->input('type');
        $injury_att->information = $request->input('information');
        $injury_att->name = 'api.3ommal.me/uploads/'.  $request->input('name');
        $injury_att->user_id = LaborInjuryModel::find($id)->user_id;
        $injury_att->save();
        $message = "Done";
        $status = "success";
        if ($request->ajax())
            return response(["status" => true, "message" => "Done"], 200);

    }

    public function editAtt($id)
    {
        $injury_att = AttModel::find($id);
        if (!$injury_att)
            return redirect(parent::$data['cp_route_name'] . "/injury");
        parent::$data['att'] = $injury_att;
        parent::$data['att_type'] = TypesModel::getTypes('injury_att', parent::$data["lang"]);

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        return view('cp.injury.editatt', parent::$data);

    }

    public function storeAtt(Request $request)
    {
        $injury_att = AttModel::find($request->input('id'));


        $injury_att->title = $request->input('title');
        $injury_att->type = $request->input('type');
        $injury_att->information = $request->input('information');
        $injury_att->save();
        $message = "Done";
        $status = "success";
        if ($request->ajax())
            return response(["status" => true, "message" => "Done"], 200);
    }

    public function getAtt(Request $request, $id)
    {
        $columns = \Input::input('columns');

        $filter = [];

        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $stat = AttModel::where('user_id', LaborInjuryModel::find($id)->user_id)->where('module', 'injury')->where('active', 1);
        $injury = LaborInjuryModel::find($id);
        $table = Datatables::of($stat)
            ->editColumn('active', function ($data) use ($request) {
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger') . ' label label-sm"> Status </span>';
            })
            ->editColumn('type', function ($data) use ($request) {

                return '<span class="type">' . TypesModel::getTypeName($data->type, parent::$data["lang"]) . '</span>';
            })
            ->editColumn('location', function ($data) use ($request) {

                return TypesModel::getTypeName($data->location, parent::$data["lang"]);
            })
            ->editColumn('uploaded_at', function ($data) use ($request) {
                if (!is_null($data->uploaded_at))
                    return Date('Y-m-d H:i:s', strtotime($data->uploaded_at));
                else
                    return "Not Uploaded";
            })
            ->editColumn('name', function ($data) use ($request, $injury) {

                $result = '<a  class="id " target="_blank" href="https://'.$data->name .'" name="' . $data->title . '"  data-id="' . $data->id . '">' . $data->title . '  </a>';


                return $result;


            })
            ->setRowClass(function ($data) use ($id) {

                return $id == $data->att_id ? 'font-purple-seance' : '';
            })
            ->editColumn('title', function ($data) use ($request) {

                return '<span class="type">' . $data->title . '</span>';
            })
            ->editColumn('id', function ($data) use ($request) {
                return '<span class="action">' . $data->id . '</span>';
            });


        if ($request->ajax()) {
            $table->addColumn('m_action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';

                $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" href="' . parent::$data['cp_route_name'] . '/injury/changeAttStatus" class="btn btn-circle btn-icon-only btn-default btn-att-status ' . ($data->active == 0 ? "att-inactive" : "att-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
                                                        <i class="fa fa-' . ($data->active == 1 ? "fa fa-ban" : "check-square") . '"></i>
                                                    </a>';

                $result .= '<a title="Edit Att - تعديل" data-modal="modal-attEdit" data-id="' . $data->id . '" class="attEditmodal btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';


                return $result;
            });
        }

        $table = $table->make(true);

        if ($request->ajax())
            return $table;
        redirect(parent::$data['cp_route_name'] . '/injury/edit/' . $id);


    }

    public function changeAttStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/injury/edit/$id');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                AttModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                AttModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $AttModel = new AttModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $AttModel->getTableName(), "injury", $AttModel->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/injury/edit/$id');
        }
    }

    public function attachImage($id)
    {


        $injury = LaborInjuryModel::get()->find($id);
        if (!$injury)
            return redirect(parent::$data['cp_route_name'] . "/injury");

        parent::$data['injury'] = $injury;


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");


        return view('cp.injury.upload', parent::$data);
    }

    public function delUpload($id)
    {
        $injury = LaborInjuryModel::get()->find($id);
        if (!$injury)
            return redirect(parent::$data['cp_route_name'] . "/injury");


        $injury->h_image = "1.jpg";
        $injury->save();
    }

    public function uploadAtt(Request $request, $id)
    {
        $path = public_path('uploads'); // upload directory
        $file = \Input::file('choose-file');
        $ext = $file->guessClientExtension();
        $message = '';
        $filename = time() . str_random(25) . '.' . $ext;
        $uploadSuccess = $file->move($path . DIRECTORY_SEPARATOR . "injury", $filename);

        // if($request->hasFile('image'))
        //{


        if ($uploadSuccess) {
            if ($id != '0') {
                $injury = LaborInjuryModel::get()->find($id);
                if (!$injury)
                    return redirect(parent::$data['cp_route_name'] . "/injury");
            }
            return response(array('status' => 1, 'file_name' => $filename, 'my_server' => \URL::asset('')));
        } else {
            return response(array('status' => 2, 'message' => $message));
        }
    }

    ////////////////////////////////////////

}
