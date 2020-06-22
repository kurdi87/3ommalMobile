<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SalaryRequest;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\IconModel;
use App\Models\LaborSalaryModel;
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

class SalaryController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data["lang"]=1;
        parent::$data['active_menu'] = "طلبات مستحقات الخدمة";
        parent::$data["breadcrumbs"] = ["طلبات مستحقات الخدمة" => parent::$data['cp_route_name'], "طلبات مستحقات الخدمة" => parent::$data['cp_route_name'] . "/salary"];
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

        parent::$data['title'] = "طلبات مستحقات الخدمة";
        parent::$data["breadcrumbs"]["طلبات مستحقات الخدمة"] = "";
        return view('cp.salary.salaryList', parent::$data);
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

        $Salary = LaborSalaryModel::getSalaryList($filter,$user_id,$status,0,0,0,0,$from,$to,0,$city);


        $table = Datatables::of($Salary)
            ->editColumn('active', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->active;
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger') . ' label label-sm"> Status </span>';
            })
            ->editColumn('name', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->name;

                return '<a class="id" data-id="' . $data->id . '" href="' . parent::$data['cp_route_name'] . '/salary/edit/' . $data->id . '">' . $data->name . '</a>';

            })
            ->editColumn('created_at', function ($data) use ($request) {

                return date('Y-m-d',strtotime($data->created_at));

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

                $result .= '<a title="معاينة الطلب" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="' . parent::$data['cp_route_name'] . '/salary/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';


                $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" href="' . parent::$data['cp_route_name'] . '/salary/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
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
            $this->exportFile("Salary Report", $this->formatAliases($table, $aliases), $type, true);
        }
        redirect(parent::$data['cp_route_name'] . '/salary');
    }


    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/salary');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                LaborSalaryModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                LaborSalaryModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $Salary = new LaborSalaryModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $Salary->getTableName(), "طلبات مستحقات الخدمة", $Salary->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/salary');
        }
    }


    public function edit($id)
    {
        $Salary = LaborSalaryModel::find($id);
        if (!$Salary)
            return redirect(parent::$data['cp_route_name'] . "/salary");
        parent::$data['title'] = "معاينة الطلب";
        parent::$data["result"] = $Salary;
        parent::$data['att_type'] = TypesModel::getTypes('att', parent::$data["lang"]);
        parent::$data['adminAction'] = StatusModel::getTypes('RequestsTransaction');


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"] = "";
        return view('cp.salary.edit', parent::$data);
    }

    public function update(Request $request, $id)
    {
        $Salary = LaborSalaryModel::get()->find($id);
        if (!$Salary)
            return redirect(parent::$data['cp_route_name'] . "/salary");

        $Salary->status = $request->input('adminAction');
        $Salary->admin_id = \Auth::user("admin")->SysUsr_ID;
        $Salary->notes = $request->input('notes');


        $Salary->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $Salary;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name'] . "/salary/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name'] . "/salary")->with($status, $message);
    }

    /* public function create()
    {
        parent::$data['title'] = "Add Salary";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");
    
        parent::$data['languages'] = LanguagesModel::lists('language','id')->toArray();
        parent::$data['icon'] = IconModel::lists('icon','icon_css')->toArray();
       
     
        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""]="";
        return view('cp.salary.add', parent::$data);
    }

    public function store(SalaryRequest $request)
    {
        $Salary = new LaborSalaryModel();
        $Salary->name = $request->input('name');
        $Salary->s_order = $request->input('s_order');
        $Salary->mini_note = $request->input('mini_note');
        $Salary->notes = $request->input('notes');
        $Salary->icon = $request->input('icon');
        $Salary->lang = $request->input('lang');
        
      
        $Salary->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $Salary;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/salary/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/salary")->with($status, $message);
    }
*/

    //////////////////////////
    public function addAtt(Request $request)
    {
        $salary_att = new AttModel();
        $id = $request->input('salary_id');

        $salary_att->att_id = $id;

        $salary_att->module = "salary";
        $salary_att->title = $request->input('title');
        $salary_att->type = $request->input('type');
        $salary_att->information = $request->input('information');
        $salary_att->name = 'api.3ommal.me/uploads/'.  $request->input('name');
        $salary_att->user_id = LaborSalaryModel::find($id)->user_id;
        $salary_att->save();
        $message = "Done";
        $status = "success";
        if ($request->ajax())
            return response(["status" => true, "message" => "Done"], 200);

    }

    public function editAtt($id)
    {
        $salary_att = AttModel::find($id);
        if (!$salary_att)
            return redirect(parent::$data['cp_route_name'] . "/salary");
        parent::$data['att'] = $salary_att;
        parent::$data['att_type'] = TypesModel::getTypes('salary_att', parent::$data["lang"]);

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        return view('cp.salary.editatt', parent::$data);

    }

    public function storeAtt(Request $request)
    {
        $salary_att = AttModel::find($request->input('id'));


        $salary_att->title = $request->input('title');
        $salary_att->type = $request->input('type');
        $salary_att->information = $request->input('information');
        $salary_att->save();
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

        $stat = AttModel::where('user_id', LaborSalaryModel::find($id)->user_id)->where('module', 'salary')->where('active', 1);
        $salary = LaborSalaryModel::find($id);
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
            ->editColumn('name', function ($data) use ($request, $salary) {

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

                $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" href="' . parent::$data['cp_route_name'] . '/salary/changeAttStatus" class="btn btn-circle btn-icon-only btn-default btn-att-status ' . ($data->active == 0 ? "att-inactive" : "att-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
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
        redirect(parent::$data['cp_route_name'] . '/salary/edit/' . $id);


    }

    public function changeAttStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/salary/edit/$id');
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
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $AttModel->getTableName(), "salary", $AttModel->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/salary/edit/$id');
        }
    }

    public function attachImage($id)
    {


        $salary = LaborSalaryModel::get()->find($id);
        if (!$salary)
            return redirect(parent::$data['cp_route_name'] . "/salary");

        parent::$data['salary'] = $salary;


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");


        return view('cp.salary.upload', parent::$data);
    }

    public function delUpload($id)
    {
        $salary = LaborSalaryModel::get()->find($id);
        if (!$salary)
            return redirect(parent::$data['cp_route_name'] . "/salary");


        $salary->h_image = "1.jpg";
        $salary->save();
    }

    public function uploadAtt(Request $request, $id)
    {
        $path = public_path('uploads'); // upload directory
        $file = \Input::file('choose-file');
        $ext = $file->guessClientExtension();
        $message = '';
        $filename = time() . str_random(25) . '.' . $ext;
        $uploadSuccess = $file->move($path . DIRECTORY_SEPARATOR . "salary", $filename);

        // if($request->hasFile('image'))
        //{


        if ($uploadSuccess) {
            if ($id != '0') {
                $salary = LaborSalaryModel::get()->find($id);
                if (!$salary)
                    return redirect(parent::$data['cp_route_name'] . "/salary");
            }
            return response(array('status' => 1, 'file_name' => $filename, 'my_server' => \URL::asset('')));
        } else {
            return response(array('status' => 2, 'message' => $message));
        }
    }

    ////////////////////////////////////////

}
