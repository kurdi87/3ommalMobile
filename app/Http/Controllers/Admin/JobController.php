<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobRequest;
use App\Models\CategoryModel;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\IconModel;
use App\Models\JobApplicationModel;
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

class JobController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data["lang"]=1;
        parent::$data['active_menu'] = "طلبات العمل";
        parent::$data["breadcrumbs"] = ["طلبات العمل" => parent::$data['cp_route_name'], "طلبات العمل" => parent::$data['cp_route_name'] . "/job"];
    }

    public function index()
    {

        parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
        parent::$data['roles'] = RoleModel::all();
        parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();
        parent::$data['category'] = ['0' => 'اختر التصنيف'] +CategoryModel::getCategoryAlllist();
        parent::$data['city'] = CountryModel::getlist();
        parent::$data['users'] = ['0' => 'المستخدم'] + SystemUserModel::getUsersArray(1);
        parent::$data['status'] = StatusModel::getTypes('RequestsTransaction');

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] = "طلبات العمل";
        parent::$data["breadcrumbs"]["طلبات العمل"] = "";
        return view('cp.job.jobList', parent::$data);
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
        $category = $request->input("category");
        $from = $request->input("from");
        $to = $request->input("to");

        $Job = JobApplicationModel::getJobList($filter,$user_id,$status,$category,0,0,0,$from,$to,0,$city);


        $table = Datatables::of($Job)
            ->editColumn('active', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->active;
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger') . ' label label-sm"> Status </span>';
            })
            ->editColumn('name', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->name;

                return '<a class="id" data-id="' . $data->id . '" href="' . parent::$data['cp_route_name'] . '/job/edit/' . $data->id . '">' . $data->name . '</a>';

            })
            ->editColumn('email', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->email;
                return '<a href="mailto:#" >' . $data->email . '</a>';
            })

            ->editColumn('city', function ($data) use ($request) {
               return CountryModel::getCountryName($data->city);
            })

            ->editColumn('created_at', function ($data) use ($request) {

                    return date('Y-m-d',strtotime($data->created_at));

            })
            ->editColumn('work_fields', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->work_fields;
                return '<span class="m_order">' . $data->work_fields . '</span>';
            })
            ->editColumn('work_special', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->work_special;
                return '<span class="type">' . mb_convert_encoding(substr($data->work_special, 0, 200), 'UTF-8', 'UTF-8') . '</span>';
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
                if ($request->input("export"))
                    return $data->id;
                return '<span class="action">' . $data->id . '</span>';
            });


        if (!$request->input("export") && $request->ajax()) {
            $table->addColumn('m_action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';

                $result .= '<a title="معاينة الطلب" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="' . parent::$data['cp_route_name'] . '/job/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';


                $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" href="' . parent::$data['cp_route_name'] . '/job/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
                                                        <i class="fa fa-' . ($data->active == 1 ? "square-o" : "check-square") . '"></i>
                                                    </a>';


                return $result;
            });
        }

        $table = $table->make(true);

        if ($request->ajax())
            return $table;
        if ($request->input("export")) {

            $table=json_decode(json_encode($table->getData()),true);
            $aliases = ["name" => "name", "email" => "email", "subject" => "subject"];
            $type = $request->input("export");
            if (!in_array($type, ["xlsx", "csv", "pdf"]))
                $type = "csv";
            $this->exportFile("Job Report", $table, $type, true);
        }
        redirect(parent::$data['cp_route_name'] . '/job');
    }


    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/job');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                JobApplicationModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                JobApplicationModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $Job = new JobApplicationModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $Job->getTableName(), "طلبات العمل", $Job->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/job');
        }
    }


    public function edit($id)
    {
        $Job = JobApplicationModel::find($id);
        if (!$Job)
            return redirect(parent::$data['cp_route_name'] . "/job");
        parent::$data['title'] = "معاينة الطلب";
        parent::$data["result"] = $Job;
        parent::$data['att_type'] = TypesModel::getTypes('att', parent::$data["lang"]);
        parent::$data['adminAction'] = StatusModel::getTypes('RequestsTransaction');


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"] = "";
        return view('cp.job.edit', parent::$data);
    }

    public function update(Request $request, $id)
    {
        $Job = JobApplicationModel::get()->find($id);
        if (!$Job)
            return redirect(parent::$data['cp_route_name'] . "/job");

        $Job->status = $request->input('adminAction');
        $Job->admin_id = \Auth::user("admin")->SysUsr_ID;
        $Job->notes = $request->input('notes');


        $Job->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $Job;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name'] . "/job/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name'] . "/job")->with($status, $message);
    }

    /* public function create()
    {
        parent::$data['title'] = "Add Job";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");

        parent::$data['languages'] = LanguagesModel::lists('language','id')->toArray();
        parent::$data['icon'] = IconModel::lists('icon','icon_css')->toArray();


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""]="";
        return view('cp.job.add', parent::$data);
    }

    public function store(JobRequest $request)
    {
        $Job = new JobApplicationModel();
        $Job->name = $request->input('name');
        $Job->s_order = $request->input('s_order');
        $Job->mini_note = $request->input('mini_note');
        $Job->notes = $request->input('notes');
        $Job->icon = $request->input('icon');
        $Job->lang = $request->input('lang');


        $Job->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $Job;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/job/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/job")->with($status, $message);
    }
*/

    //////////////////////////
    public function addAtt(Request $request)
    {
        $Job_att = new AttModel();
        $id = $request->input('Job_id');

        $Job_att->att_id = $id;

        $Job_att->module = "Job";
        $Job_att->title = $request->input('title');
        $Job_att->type = $request->input('type');
        $Job_att->information = $request->input('information');
        $Job_att->name = 'api.3ommal.me/uploads/'.  $request->input('name');
        $Job_att->user_id = JobApplicationModel::find($id)->user_id;
        $Job_att->save();
        $message = "Done";
        $status = "success";
        if ($request->ajax())
            return response(["status" => true, "message" => "Done"], 200);

    }

    public function editAtt($id)
    {
        $Job_att = AttModel::find($id);
        if (!$Job_att)
            return redirect(parent::$data['cp_route_name'] . "/job");
        parent::$data['att'] = $Job_att;
        parent::$data['att_type'] = TypesModel::getTypes('Job_att', parent::$data["lang"]);

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        return view('cp.job.editatt', parent::$data);

    }

    public function storeAtt(Request $request)
    {
        $Job_att = AttModel::find($request->input('id'));


        $Job_att->title = $request->input('title');
        $Job_att->type = $request->input('type');
        $Job_att->information = $request->input('information');
        $Job_att->save();
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

        $stat = AttModel::where('user_id', JobApplicationModel::find($id)->user_id)->where('active', 1);
        $Job = JobApplicationModel::find($id);
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
            ->editColumn('name', function ($data) use ($request, $Job) {

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

                $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" href="' . parent::$data['cp_route_name'] . '/job/changeAttStatus" class="btn btn-circle btn-icon-only btn-default btn-att-status ' . ($data->active == 0 ? "att-inactive" : "att-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
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
        redirect(parent::$data['cp_route_name'] . '/job/edit/' . $id);


    }

    public function changeAttStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/job/edit/$id');
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
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $AttModel->getTableName(), "Job", $AttModel->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/job/edit/$id');
        }
    }

    public function attachImage($id)
    {


        $Job = JobApplicationModel::get()->find($id);
        if (!$Job)
            return redirect(parent::$data['cp_route_name'] . "/job");

        parent::$data['Job'] = $Job;


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");


        return view('cp.job.upload', parent::$data);
    }

    public function delUpload($id)
    {
        $Job = JobApplicationModel::get()->find($id);
        if (!$Job)
            return redirect(parent::$data['cp_route_name'] . "/job");


        $Job->h_image = "1.jpg";
        $Job->save();
    }

    public function uploadAtt(Request $request, $id)
    {
        $path = public_path('uploads'); // upload directory
        $file = \Input::file('choose-file');
        $ext = $file->guessClientExtension();
        $message = '';
        $filename = time() . str_random(25) . '.' . $ext;
        $uploadSuccess = $file->move($path . DIRECTORY_SEPARATOR . "Job", $filename);

        // if($request->hasFile('image'))
        //{


        if ($uploadSuccess) {
            if ($id != '0') {
                $Job = JobApplicationModel::get()->find($id);
                if (!$Job)
                    return redirect(parent::$data['cp_route_name'] . "/job");
            }
            return response(array('status' => 1, 'file_name' => $filename, 'my_server' => \URL::asset('')));
        } else {
            return response(array('status' => 2, 'message' => $message));
        }
    }

    ////////////////////////////////////////

}
