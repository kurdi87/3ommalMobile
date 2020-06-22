<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionRequest;
use App\Models\ActionModel;
use App\Models\ModuleProcessModel;
use App\Models\QuestionOptionModel;
use App\Models\QuestionModel;
use App\Models\SpecialityModel;
use App\Models\StatusModel;
use App\Models\TypesModel;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;


class QuestionController extends SuperAdminController
{
    public function __construct()
    {
        try {
            parent::__construct();
            parent::$data['active_menuPlus'] = "Question";
            parent::$data['active_menu'] = "Question";
            parent::$data["breadcrumbs"] = ["Question" => parent::$data['cp_route_name'], "Question" => parent::$data['cp_route_name'] . "/question"];
            parent::$data["role"] = \Auth::user("admin")->role;
            parent::$data["create_edit"] = array("1");
            parent::$data["create"] = array("1");
        } catch (\Exception $e) {
            redirect(parent::$data['cp_route_name'] . '/login');
        }

    }

    public function index()
    {
        if (!in_array(ActionModel::where('Action_Name', 'like', '%' . parent::$data['active_menuPlus'] . '%')->first()->Action_ID, parent::$data["allowedActions"])) {
            return redirect(parent::$data['cp_route_name'] . '/');
        }
        parent::$data['status'] = StatusModel::getStatus('question');
        parent::$data['type'] = TypesModel::getTypes('question');
        parent::$data['active'] = ["0" => 'All', 2 => 'Active', 1 => "Inactive"];
        parent::$data['speciality'] = SpecialityModel::getSpeciality();
        parent::$data['type'] = TypesModel::getTypes('question');

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] = "Question";
        parent::$data["breadcrumbs"]["Question"] = "";
        return view('cp.question.questionList', parent::$data);
    }

    public function get(Request $request)
    {
        $columns = \Input::input('columns');
        $status = ($request->input("status") != 0) ? explode(',', $request->input("status")) : 0;
        $speciality = ($request->input("speciality") != 0) ? explode(',', $request->input("speciality")) : 0;
        $type = ($request->input("type") != 0) ? explode(',', $request->input("type")) : 0;
        $active = $request->input("active");
        $role = parent::$data["role"];
        $create_edit = parent::$data["create_edit"];
        $create = parent::$data["create"];


        $filter = [];
        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $question = QuestionModel::getQuestionList($filter, $speciality, $active, $status);


        $table = Datatables::of($question)
            ->editColumn('active', function ($data) use ($request) {
                if ($request->input("export"))
                    return StatusModel::getStatusName($data->status);
                return ' <span class="' . ($data->active == 1 ? StatusModel::getStatusColor($data->status) : 'label-danger') . ' label label-sm">' . StatusModel::getStatusName($data->status) . ' </span>';
            })
            ->editColumn('question_text', function ($data) use ($request, $role, $create_edit) {
                if ($request->input("export"))
                    return $data->question_text;
                if (in_array($role, $create_edit))
                    return '<a class="id" data-id="' . $data->id . '" href="' . parent::$data['cp_route_name'] . '/question/edit/' . $data->id . '">' . $data->question_text . '</a>';
                else
                    return $data->question_text;

            })
            ->editColumn('id', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->id;
                return '<span class="action">' . $data->id . '</span>';
            });


        if (!$request->input("export") && $request->ajax()) {
            $table->addColumn('m_action', function ($data) use ($request, $role, $create_edit, $create) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';

                if (in_array($role, $create_edit)) {
                    $result .= '<a title="Edit question" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="' . parent::$data['cp_route_name'] . '/question/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';


                    $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" href="' . parent::$data['cp_route_name'] . '/question/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
                                                        <i class="fa fa-' . ($data->active == 1 ? "square-o" : "check-square") . '"></i>
                                                    </a>';

                    $result .= '<a title="Show Process History " data-modal="modal-process" data-id="' . $data->id . '" class="processModal btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="">
                                                        <i class="fa fa-history"></i>
                                                    </a>';
                    if ($role == "1")
                        $result .= '<a title="Delete" link="' . parent::$data['cp_route_name'] . '/question/delete" class="btn btn-circle btn-icon-only btn-default btn-delete tooltip-one-info tooltipstered "  data-toggle="confirmation" data-popout="true"  href="javascript:;">
                                                        <i class="fa fa-remove"></i>
                                                    </a>';
                }


                return $result;
            });
        }

        $table = $table->make(true);

        if ($request->ajax())
            return $table;
        if ($request->input("export")) {
            $table = json_decode(json_encode($table->getData()), true);
            $aliases = ["question" => "question"];
            $type = $request->input("export");
            if (!in_array($type, ["xlsx", "csv", "pdf"]))
                $type = "csv";
            $this->exportFile("Question Report", $this->formatAliases($table, $aliases), $type, true);
        }
        redirect(parent::$data['cp_route_name'] . '/question');
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/question');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                QuestionModel::whereIn("id", $ids)->update(["active" => "0"]);
                $process = new ModuleProcessModel();
                $process->action_id = 3;//canceled
                $process->module = 'question';
                $process->action_emp = \Auth::user("admin")->SysUsr_ID;
                $process->module_id = $ids[0];
                $process->save();

                $message = "Done successfully";
            } else {
                QuestionModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
                $process = new ModuleProcessModel();
                $process->action_id = 4;//activated
                $process->module = 'question';
                $process->action_emp = \Auth::user("admin")->SysUsr_ID;
                $process->module_id = $ids[0];
                $process->save();
            }

            $question = new QuestionModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $question->getTableName(), "Question", $question->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/question');
        }
    }


    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/question');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }

            QuestionModel::whereIn("id", $ids)->update(["deleted_at" => date('Y-m-d H:i:s'), "active" => 0]);
            $message = "Done successfully";


            $question = new QuestionModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $question->getTableName(), "question", $question->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/question');
        }
    }

    public function edit($id)
    {
        $question = QuestionModel::find($id);

        $speciality_id = ($question->speciality_id) ? explode(',', $question->speciality_id) : 0;

        if (!$question)
            return redirect(parent::$data['cp_route_name'] . "/question");
        $question = QuestionModel::find($question->id);
        $role = \Auth::user("admin")->role;


        parent::$data['title'] = "Edit Question";
        parent::$data["result"] = $question;
        parent::$data['status'] = StatusModel::getStatus('question');
        parent::$data['type'] = TypesModel::getTypes('question');
        parent::$data['active'] = ["0" => 'All', 2 => 'Active', 1 => "Inactive"];
        parent::$data['speciality'] = SpecialityModel::getSpeciality();
        parent::$data['speciality_id'] = $speciality_id;
        $role = \Auth::user("admin")->role;


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"] = "";
        return view('cp.question.edit', parent::$data);


    }


    public function update(QuestionRequest $request, $id)
    {
        $question = QuestionModel::get()->find($id);
        if (!$question)
            return redirect(parent::$data['cp_route_name'] . "/question");
        $question = QuestionModel::find($question->id);
        $role = \Auth::user("admin")->role;


        $question->type = $request->input('type');
        $question->status = $request->input('status');
        $question->question_text = $request->input('question_text');
        $question->updated_at = date('Y-m-d');
        $speciality = ($request->input("speciality") != 0) ? implode(',', $request->input("speciality")) : 0;
        $question->speciality_id =$speciality;
        $question->question_text_ar = $request->input('question_text_ar');
        $question->notes = $request->input('notes');
        $question->question_order = $request->input('question_order');
        $question->active = $request->input('active') ? $request->input('active') : 0;

        $question->question_required = $request->input('question_required') ? $request->input('question_required') : 0;
        $question->created_by = \Auth::user("admin")->SysUsr_ID;

        $question->active = 1;

        $question->save();
        $process = new ModuleProcessModel();
        $process->action_id = 2;//create
        $process->action_emp = \Auth::user("admin")->SysUsr_ID;
        $process->module_id = $question->id;
        $process->module = 'question';
        $process->save();

        $message = "Done";
        $status = "success";


        if ($request->input("quick") == 1) {
            return $question;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name'] . "/question/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name'] . "/question")->with($status, $message);
    }

    public function create(Request $request)
    {
        if (isset($request->question_id)) {
            $question = QuestionModel::find($request->question_id);
            parent::$data['question'] = $question;
        }
        parent::$data['title'] = "Add Question";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;

        $role = \Auth::user("admin")->role;

        parent::$data['title'] = "Edit Question";
        parent::$data['status'] = StatusModel::getStatus('question');
        parent::$data['type'] = TypesModel::getTypes('question');
        parent::$data['speciality'] = SpecialityModel::getSpeciality();
        parent::$data['active'] = ["0" => 'All', 2 => 'Active', 1 => "Inactive"];
        parent::$data['speciality_id'] = [];

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""] = "";
        return view('cp.question.add', parent::$data);
    }

    public function store(QuestionRequest $request)
    {
        $question = new QuestionModel();
        $question->type = $request->input('type');
        $question->status = $request->input('status');
        $question->question_text = $request->input('question_text');
        $question->updated_at = date('Y-m-d');
        $speciality = ($request->input("speciality") != 0) ? implode(',', $request->input("speciality")) : 0;
        $question->speciality_id =$speciality;
        $question->question_required = $request->input('question_required') ? $request->input('question_required') : 0;
        $question->question_text_ar = $request->input('question_text_ar');
        $question->notes = $request->input('notes');

        $question->created_by = \Auth::user("admin")->SysUsr_ID;
        $question->question_order = $request->input('question_order');
        $question->active = $request->input('active') ? $request->input('active') : 0;
        $question->save();
        $process = new ModuleProcessModel();
        $process->action_id = 1;//create
        $process->action_emp = \Auth::user("admin")->SysUsr_ID;
        $process->module_id = $question->id;
        $process->module = 'question';
        $process->save();

        $message = "Done";
        $status = "success-";


        if ($request->input("quick") == 1) {
            return $question;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name'] . "/question/create")->with($status, $message);
        else {
            if ($question->type == "2")
                return redirect(parent::$data['cp_route_name'] . "/question/edit/".$question->id."?msg=Add Options Now")->with($status, $message);
            else
                return redirect(parent::$data['cp_route_name'] . "/question")->with($status, $message);
        }

    }


    public function process($id)
    {
        $question_process = ModuleProcessModel::where('module_id', $id)->where('module', 'question')->orderby('id', 'asc')->get();
        if (!$question_process)
            return redirect(parent::$data['cp_route_name'] . "/question");
        parent::$data['question_process'] = $question_process;


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        return view('cp.question.process', parent::$data);

    }
    ////
    /////////////////////////////////////////////
    public function addOption(Request $request)
    {
        $question_option = new QuestionOptionModel();
        $id = $request->input('question_id');

        $question_option->question_id = $id;
        $question_option->type = $request->input('option_type');
        $question_option->rank = $request->input('option_order');
        $question_option->option_order = $request->input('option_order');
        $question_option->notes = $request->input('notes');
        $question_option->question_option_text 	= $request->input('question_option_text');
        $question_option->question_option_text_ar 	= $request->input('question_option_text_ar');

        $question_option->save();
        $message = "Done";
        $status = "success";
        if ($request->ajax())
            return response(["status" => true, "message" => "Done"], 200);


    }

    public function editOption($id)
    {
        $option = QuestionOptionModel::find($id);
        if (!$option)
            return redirect(parent::$data['cp_route_name'] . "/question");
        parent::$data['question_option'] = $option;



        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        return view('cp.question.editOption', parent::$data);

    }


    public function storeOption(Request $request)
    {
        $option = QuestionOptionModel::find($request->input('id'));
        $option->type = $request->input('option_type');
        $option->rank = $request->input('option_order');
        $option->option_order = $request->input('option_order');
        $option->notes = $request->input('notes');
        $option->question_option_text 	= $request->input('question_option_text');
        $option->question_option_text_ar 	= $request->input('question_option_text_ar');

        $option->save();
        $message = "Done";
        $status = "success";
        if ($request->ajax())
            return response(["status" => true, "message" => "Done"], 200);
    }

    public function getOption(Request $request, $id)
    {
        $columns = \Input::input('columns');
        $question = QuestionModel::find($id);
        $role = parent::$data["role"];
        $create_edit = parent::$data["create_edit"];

        $filter = [];

        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $option = QuestionOptionModel::getOptionByQuestion($id);

        $table = Datatables::of($option)
            ->editColumn('active', function ($data) use ($request, $question, $role, $create_edit) {
                if (in_array($role, $create_edit))
                    return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger') . ' label label-sm"> Status </span>';
                else
                    return "";
            })
            ->editColumn('question_option_text', function ($data) use ($request, $question, $role, $create_edit) {
                if ($request->input("export"))
                    return $data->name;
                else {
                    if (in_array($role, $create_edit))
                        return '<a class="id optionEditmodal" data-modal="modal-optionEdit"  name="' . $data->question_option_text 	 . '" data-id="' . $data->id . '" item-id="' . $data->option_id . '">' . $data->question_option_text 	 . '</a>';
                    else
                        return '<span class="type">' . $data->question_option_text 	 . '</span>';
                }


            })

            ->editColumn('type', function ($data) use ($request) {

                return '<span class="type">'.TypesModel::getTypeName('option').'</span>';
            })
            ->editColumn('id', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->id;
                else
                    return '<span class="action">' . $data->id . '</span>';
            });



        if (!$request->input("export") && $request->ajax()) {
            $table->addColumn('m_action', function ($data) use ($request, $question, $role, $create_edit) {
                if (in_array($role, $create_edit)) {

                    $result = '<div class="actions tbl-sm-actions tblactions-four">';

                    $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" href="' . parent::$data['cp_route_name'] . '/question/changeOptionStatus" class="btn btn-circle btn-icon-only btn-default btn-pstatus ' . ($data->active == 0 ? "pstatus-inactive" : "pstatus-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
                                                        <i class="fa fa-' . ($data->active == 1 ? "fa fa-ban" : "check-square") . '"></i>
                                                    </a>';
                    if ($role == "1")
                        $result .= '<a title="Delete" link="' . parent::$data['cp_route_name'] . '/question/deleteOption" class="btn btn-circle btn-icon-only btn-default btn-delete tooltip-one-info tooltipstered "  data-toggle="confirmation" data-popout="true"  href="javascript:;">
                                                        <i class="fa fa-remove"></i>
                                                    </a>';


                    return $result;
                } else
                    return "";
            });
        }



        $table = $table->make(true);
        if ($request->input("export")) {
            $table = json_decode(json_encode($table->getData()), true);

            $aliases = ["id" => "id", "name" => "name", "qty" => "qty", "total_cost" => "total_cost", "cost" => "cost"];

            $type = $request->input("export");
            if (!in_array($type, ["xlsx", "csv", "pdf"]))
                $type = "csv";
            $this->exportFile("Option Question#".$id, $this->formatAliases($table, $aliases), $type, false);
        }

        if ($request->ajax())
            return $table;
        redirect(parent::$data['cp_route_name'] . '/question/edit/' . $id);


    }

    public function deleteOption(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/question');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }

            QuestionOptionModel::whereIn("id", $ids)->update(["deleted_at" => date('Y-m-d H:i:s'), "active" => 0]);
            $message = "Done successfully";


            $question = new QuestionOptionModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $question->getTableName(), "question", $question->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/question');
        }
    }


    public function changeOptionStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/question/edit/$id');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                QuestionOptionModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                QuestionOptionModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $QuestionOptionModel = new QuestionOptionModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $QuestionOptionModel->getTableName(), "Question", $QuestionOptionModel->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/question/edit/$id');
        }
    }

////


}
