<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;


use App\Models\CategoryModel;
use App\Models\RoleModel;

use App\Models\SystemLookupModel;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

class CategoryController extends SuperAdminController
{
    public function __construct()
    {
        parent::__construct();
        parent::$data['active_menu'] = "التصنيفات";
        parent::$data["breadcrumbs"] = ["التصنيفات" => parent::$data['cp_route_name'], "التصنيفات" => parent::$data['cp_route_name'] . "/category"];
    }

    public function index()
    {

        parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
        parent::$data['roles'] = RoleModel::all();
        parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();
        parent::$data['type'] = ["0" => "Is Parent or Child", "1" => "Parent", "2" => "Child"];
        parent::$data['active'] = ["-1" => "Active or Not", "1" => "Active", "0" => "Inactive"];

        parent::$data["categorys"] = ['0' => 'Select Parent'] + CategoryModel::getCategoryAll(0)->lists('name', 'id')->toArray();
        parent::$data["disease"] = ['0' => 'Select Disease'];
        parent::$data["ptype"] = array('0'=>'Treatment or Diagnostic','1' => 'Treatments Fee', '2' => 'Investegation Fee');


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] = "التصنيفات";
        parent::$data["breadcrumbs"]["التصنيفات"] = "";
        return view('cp.category.categoryList', parent::$data);
    }

    public function get(Request $request)
    {
        $columns = \Input::input('columns');
        $active = $request->input('active');
        $type = $request->input('type');
        $ptype = $request->input('ptype');
        $source = $request->input('source');
        $disease = $request->input('disease_id');
        $cost_from = $request->input('cost_from');
        $cost_to = $request->input('cost_to');
        $parent_id = $request->input('parent_id');



        $filter = [];

        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $category = CategoryModel::getCategoryList($filter, $type,$cost_from,$cost_to,$parent_id,$ptype,$disease,$source,$active);


        $table = Datatables::of($category)
            ->editColumn('active', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->active;
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger') . ' label label-sm"> Status </span>';
            })
            ->editColumn('name', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->name;

                return '<a class="id" data-id="' . $data->id . '" href="' . parent::$data['cp_route_name'] . '/category/edit/' . $data->id . '">' . $data->name . '</a>';

            })
            ->editColumn('language', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->language;
                return '<span class="" data-container="body"  data-content="' . $data->language . '">' . $data->language . '</span>';
            })
            ->editColumn('d_order', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->d_order;
                return '<span class="m_order">' . $data->d_order . '</span>';
            })
            ->editColumn('type', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->type;
                return '<span class="type">' . ($data->type == 1 ? "Treatment Fee" : "Investegation Fee") . '</span>';
            })
            ->editColumn('childs', function ($data) use ($request) {
                if ($request->input("export"))
                    return count(CategoryModel::getSubCategorys($data->id)->get());
                return '<span class="type">' . count(CategoryModel::getSubCategorys($data->id)->get()) . '</span>';
            })
            ->editColumn('parent', function ($data) use ($request) {
                if ($request->input("export"))
                    return CategoryModel::getCategoryName($data->parent_id);
                return '<span class="type">' . CategoryModel::getCategoryName($data->parent_id) . '</span>';
            })
            ->editColumn('id', function ($data) use ($request) {
                return '<span class="action">' . $data->id . '</span>';
            })
            ->editColumn('cost', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->cost;
                return '<span class="action"> from:' . $data->cost_from . '$ to: ' . $data->cost_to . '$</span>';
            });

        if (!$request->input("export") && $request->ajax()) {
            $table->addColumn('m_action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';

                $result .= '<a title="Edit category" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="' . parent::$data['cp_route_name'] . '/category/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';

                $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" link="' . parent::$data['cp_route_name'] . '/category/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-mstatus ' . ($data->active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered" data-toggle="confirmation" data-popout="true"   href="javascript:;">
                                                        <i class="fa fa-' . ($data->active == 1 ? "square-o" : "check-square") . '"></i>
                                                    </a>';
                $result .= '<a title="Delete" link="' . parent::$data['cp_route_name'] . '/category/delete" class="btn btn-circle btn-icon-only btn-default btn-delete tooltip-one-info tooltipstered "  data-toggle="confirmation" data-popout="true"  href="javascript:;">
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
            $aliases = ["name" => "name","name_en" => "name_en", "d_order" => "Order", "cost" => "cost", "type" => "type", "childs" => "childs", "parent" => "parent", "language" => "Language"];
            $type = $request->input("export");
            if (!in_array($type, ["xlsx", "csv", "pdf"]))
                $type = "csv";
            $this->exportFile("Category Report", $this->formatAliases($table, $aliases), $type, true);
        }
        redirect(parent::$data['cp_route_name'] . '/category');
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/category');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }

            categoryModel::whereIn("id", $ids)->update(["deleted_at" => date('Y-m-d H:i:s'), "active" => 0]);
            $message = "Done successfully";


            $category = new categoryModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $category->getTableName(), "التصنيفات", $category->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/category');
        }
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/category');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                CategoryModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                CategoryModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $category = new CategoryModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $category->getTableName(), "التصنيفات", $category->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/category');
        }
    }

    public function edit($id)
    {
        $category = CategoryModel::find($id);
        if (!$category)
            return redirect(parent::$data['cp_route_name'] . "/category");
        parent::$data['title'] = "Edit Category";
        parent::$data["result"] = $category;
        parent::$data["categorys"] = ['0' => 'Select Parent'] + CategoryModel::getCategoryAll($id)->lists('name', 'id')->toArray();
        parent::$data['languages'] = [];
        parent::$data['type'] = array('1' => 'Treatments Fee', '2' => 'Investegation Fee');
        parent::$data["disease"] = ['0' => 'Select Disease'] ;

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"] = "";
        return view('cp.category.edit', parent::$data);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = CategoryModel::get()->find($id);
        if (!$category)
            return redirect(parent::$data['cp_route_name'] . "/category");
        $category->name = $request->input('name');
        $category->name_en = $request->input('name_en');
        $category->source = $request->input('source');
        $category->d_order = $request->input('d_order');
        $category->cost_from = $request->input('cost_from');
        $category->cost_to = $request->input('cost_to');
        $category->type = $request->input('type');
        $category->disease_id = $request->input('disease_id');
        $category->lang = $request->input('lang');
        $category->parent_id = $request->input('parent_id');
        $category->isroot = ($request->input('isroot') == null) ? "0" : "1";
        $category->about_category = $request->input('about_category');



        $category->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $category;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name'] . "/category/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name'] . "/category")->with($status, $message);
    }

    public function create()
    {
        parent::$data['title'] = "Add Category";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");
        parent::$data['languages'] =[];
        parent::$data["categorys"] = ['0' => 'Select Parent'] + CategoryModel::getCategoryAll('0')->lists('name', 'id')->toArray();
        parent::$data['type'] = array('1' => 'Treatments Fee', '2' => 'Investegation Fee');
        parent::$data["disease"] = ['0' => 'Select Disease'] ;
        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""] = "";
        return view('cp.category.add', parent::$data);
    }

    public function store(CategoryRequest $request)
    {
        $category = new CategoryModel();
        $category->name = $request->input('name');
        $category->name_en = $request->input('name_en');
        $category->d_order = $request->input('d_order');
        $category->cost_from = $request->input('cost_from');
        $category->cost_to = $request->input('cost_to');
        $category->type = $request->input('type');
        $category->source = $request->input('source');
        $category->disease_id = $request->input('disease_id');
        $category->lang = 1;
        $category->isroot = ($request->input('isroot') == null) ? 0 : 1;
        $category->parent_id = $request->input('parent_id');
        $category->about_category = $request->input('about_category');
       /* if ($request->input('parent_id') != "0")
            $category->isroot = 0;*/

        $category->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $category;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name'] . "/category/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name'] . "/category")->with($status, $message);
    }

    public function getSubCategorys(Request $request, $pid)
    {
        $columns = \Input::input('columns');

        $filter = [];

        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $category = CategoryModel::getSubCategorys($pid);

        $table = Datatables::of($category)
            ->editColumn('active', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->active;
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger') . ' label label-sm"> Status </span>';
            })
            ->editColumn('name', function ($data) use ($request) {
                if ($data->isroot == 0) {
                    return '<a class="id subEditmodal" data-modal="modal-subEdit" href="#"   name="' . $data->name . '"  data-id="' . $data->id . '" item-id="' . $data->parent_id . '">' . $data->name . '</a>';
                }
                return '<a class="id text-danger" data-id="' . $data->id . '" href="' . parent::$data['cp_route_name'] . '/category/edit/' . $data->id . '">' . $data->name . '</a>';

            })
            ->editColumn('language', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->language;
                return '<span class="" data-container="body"  data-content="' . $data->language . '">' . $data->language . '</span>';
            })
            ->editColumn('d_order', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->d_order;
                return '<span class="m_order">' . $data->d_order . '</span>';
            })
            ->editColumn('type', function ($data) use ($request) {
                if ($request->input("export"))
                    return $data->type;
                return '<span class="type">' . ($data->type == 1 ? "Treatment Fee" : "Investegation Fee") . '</span>';
            })
            ->editColumn('id', function ($data) use ($request) {
                return '<span class="action">' . $data->id . '</span>';
            })
            ->editColumn('cost', function ($data) use ($request) {
                return '<span class="action"> from:' . $data->cost_from . '$ to: ' . $data->cost_to . '$</span>';
            });

        $table->addColumn('m_action', function ($data) {
            $result = '<div class="actions tbl-sm-actions tblactions-four">';

            $result .= '<a title="' . ($data->active == 1 ? "Deactivate" : "Activate") . '" href="' . parent::$data['cp_route_name'] . '/category/changeSubStatus" class="btn btn-circle btn-icon-only btn-default btn-spstatus ' . ($data->active == 0 ? "pstatus-inactive" : "pstatus-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
                                                        <i class="fa fa-' . ($data->active == 1 ? "square-o" : "check-square") . '"></i>
                                                    </a>';


            return $result;
        });

        $table = $table->make(true);

        if ($request->ajax())
            return $table;
        if ($request->input("export")) {
            $table = json_decode(json_encode($table->getData()), true);
            $aliases = ["name" => "name","name_en" => "name_en", "d_order" => "Order", "cost" => "cost", "language" => "Language"];
            $type = $request->input("export");
            if (!in_array($type, ["xlsx", "csv", "pdf"]))
                $type = "csv";
            $this->exportFile("Category Report", $this->formatAliases($table, $aliases), $type, true);
        }
        redirect(parent::$data['cp_route_name'] . '/category');
    }

    public function addSub(CategoryRequest $request)
    {
        $category = new CategoryModel();
        $category->name = $request->input('name');
        $category->name_en = $request->input('name_en');
        $category->d_order = $request->input('d_order');
        $category->cost_from = $request->input('cost_from');
        $category->cost_to = $request->input('cost_to');
        $category->type = $request->input('type');
        $category->lang = $request->input('lang');

        $category->isroot = ($request->input('isroot') == null) ? 0 : 1;
        $category->parent_id = $request->input('parent_id');
        $category->about_category = $request->input('about_category');
        /*if ($request->input('parent_id') != "0")
            $category->isroot = 0;*/
        $category->save();
        $message = "Done";
        $status = "success";
        if ($request->ajax())
            return response(["status" => true, "message" => "Done"], 200);
    }

    public function editSub($id)
    {
        $category = CategoryModel::find($id);
        if (!$category)
            return redirect(parent::$data['cp_route_name'] . "/category");
        parent::$data['category'] = $category;
        parent::$data['categoryName'] = CategoryModel::find($category->parent_id)->name;

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        return view('cp.category.editSub', parent::$data);
    }

    public function storeSub(CategoryRequest $request)
    {
        $category = CategoryModel::find($request->input('id'));
        $category->name = $request->input('name');
        $category->name_en = $request->input('name_en');
        $category->d_order = $request->input('d_order');
        $category->cost_from = $request->input('cost_from');
        $category->cost_to = $request->input('cost_to');
        $category->type = $request->input('type');
        $category->lang = $request->input('lang');
        $category->isroot = ($request->input('isroot') == null) ? 0 : 1;
        $category->parent_id = $request->input('parent_id');
        $category->about_category = $request->input('about_category');
       /* if ($request->input('parent_id') != "0")
            $category->isroot = 0;*/
        $category->save();
        $message = "Done";
        $status = "success";
        if ($request->ajax())
            return response(["status" => true, "message" => "Done"], 200);
    }

    public function changeSubStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/' . parent::$data['cp_route_name'] . '/category/');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                CategoryModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                CategoryModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $CategoryModel = new CategoryModel();
            $this->logAction(0, parent::$data["adminUser"]->SysUsr_ID, $request->ip(), parent::$data["actionRouteName"], $CategoryModel->getTableName(), "Hospital", $CategoryModel->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./' . parent::$data['cp_route_name'] . '/category/edit/$id');
        }
    }

}
