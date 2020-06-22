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
use App\Http\Requests\HeadlineRequest ;
use App\Models\HeadlineModel;
use App\Models\HeadlineTableModel;
use App\Models\UploadHandler;
use Intervention\Image\ImageManagerStatic as Image;


class HeadlineController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data['active_menu'] = "Headline";
        parent::$data["breadcrumbs"]=["Headline"=>parent::$data['cp_route_name'],"Headline"=>parent::$data['cp_route_name']."/headline"]; 
    }

    public function index()
    {
    
            parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
            parent::$data['roles'] = RoleModel::all();
            parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();

        
        
        

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data['title'] =  "Headline";
        parent::$data["breadcrumbs"]["Headline"]="";
        return view('cp.headline.headlineList', parent::$data);
    }


    public function get(Request $request)
    {
        $columns = \Input::input('columns');
    
        $filter = [];
        
        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $headline = HeadlineModel::getHeadlineList($filter);


        $table= Datatables::of($headline)
            ->editColumn('active', function ($data) use($request) {
                if($request->input("export"))
                    return $data->active;
                return ' <span class="' . ($data->active == 1 ? 'label-success' : 'label-danger' ). ' label label-sm"> Status </span>';
            })
            ->editColumn('title', function ($data) use($request) {
                if($request->input("export"))
                    return $data->title;

                    return '<a class="id" data-id="' . $data->id . '" href="'.parent::$data['cp_route_name'].'/headline/edit/' . $data->id . '">' . $data->title . '</a>';

            })
            ->editColumn('language', function ($data) use($request) {
                if($request->input("export"))
                    return $data->language;
                return '<span class="" data-container="body"  data-content="' . $data->language . '">' . $data->language . '</span>';
            })
            ->editColumn('ismain', function ($data) use($request) {
                if($request->input("export"))
                    return $data->ismain;
                return '<span class="ismain">' . ($data->ismain==1?"Yes":"No") . '</span>';
            })

            ->editColumn('small_describtion', function ($data) use($request) {
                if($request->input("export"))
                    return $data->small_describtion;
                return '<span class="type">' .$data->small_describtion. '</span>';
            })
           
            ->editColumn('id', function ($data) use($request) {
                return '<span class="action">' . $data->id . '</span>';
            })

              ->editColumn('h_date', function ($data) use($request) {
                 return '<span class="">'.date_format(date_create($data->h_date), 'Y-m-d').'</span>';
            });

        if(!$request->input("export") && $request->ajax()){
            $table->addColumn('m_action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';

                    $result .= '<a title="Edit headline" class="btn btn-circle btn-h_date-only btn-default tooltip-one-info tooltipstered" href="'.parent::$data['cp_route_name'].'/headline/edit/' . $data->id . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';



                    $result .= '<a title="' .( $data->active == 1 ? "Deactivate" : "Activate") . '" href="'.parent::$data['cp_route_name'].'/headline/changeStatus" class="btn btn-circle btn-h_date-only btn-default btn-mstatus ' . ($data->active == 0 ? "mstatus-inactive" : "mstatus-active") . ' tooltip-one-info tooltipstered"  href="javascript:;">
                                                        <i class="fa fa-' .($data->active == 1 ? "square-o" : "check-square" ). '"></i>
                                                    </a>';

                

                return $result;
            });
        }

        $table=$table->make(true);

        if ($request->ajax())
            return $table;
        if($request->input("export")){
            $table=json_decode(json_encode($table->getData()),true);
            $aliases=["name"=>"name","h_date"=>"h_date","small_describtion"=>"small_describtion","language"=>"Language"];
            $type=$request->input("export");
            if(!in_array($type, ["xlsx","csv","pdf"]))
                $type="csv";
            $this->exportFile("Headline Report",$this->formatAliases($table,$aliases),$type,true);
        }
        redirect(parent::$data['cp_route_name'].'/headline');
    }


     public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/'.parent::$data['cp_route_name'].'/headline');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "1") {
                HeadlineModel::whereIn("id", $ids)->update(["active" => "0"]);
                $message = "Done successfully";
            } else {
                HeadlineModel::whereIn("id", $ids)->update(["active" => "1"]);
                $message = "Done successfully";
            }

            $headline=new HeadlineModel();
            $this->logAction(0,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$headline->getTableName(),"Headline",$headline->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./'.parent::$data['cp_route_name'].'/headline');
        }
    }


     public function edit($id)
    {
        $headline = HeadlineModel::find($id);
        if (!$headline)
            return redirect(parent::$data['cp_route_name']."/headline");
        parent::$data['title'] = "Edit Headline";
        parent::$data["result"] = $headline;
        parent::$data['languages'] = LanguagesModel::lists('language','id')->toArray();
         
         parent::$data['ismain'] = array('1' => 'Yes', '0' => 'NO');

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");
        parent::$data["breadcrumbs"]["Edit"]="";
        return view('cp.headline.edit', parent::$data);
    }

    public function update(HeadlineRequest $request, $id)
    {
        $headline = HeadlineModel::get()->find($id);
        if (!$headline)
            return redirect(parent::$data['cp_route_name']."/headline");
        $headline->title = $request->input('title');
        $headline->describtion = $request->input('describtion');
        $headline->small_describtion = $request->input('small_describtion');
        $headline->h_date = $request->input('h_date');
        $headline->ismain = $request->input('ismain');
        $headline->lang = $request->input('lang');
        $headline->h_image = $request->input('h_image');
        
      
        $headline->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $headline;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/headline/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/headline")->with($status, $message);
    }

     public function create()
    {
        parent::$data['title'] = "Add Headline";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['h_date'] = date("Y-m-d");
    
        parent::$data['languages'] = LanguagesModel::lists('language','id')->toArray();
        parent::$data['ismain'] = array('1' => 'Yes', '0' => 'NO');
        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"][""]="";
        return view('cp.headline.add', parent::$data);
    }

    public function store(HeadlineRequest $request)
    {
        $headline = new HeadlineTableModel();
        $headline->title = $request->input('title');
        $headline->describtion = $request->input('describtion');
        $headline->small_describtion = $request->input('small_describtion');
        $headline->h_date = $request->input('h_date');
        $headline->ismain = $request->input('ismain');
        $headline->lang = $request->input('lang');
        $headline->h_image = $request->input('h_image');
        
      
        $headline->save();
        $message = "Done";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $headline;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/headline/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/headline")->with($status, $message);
    }


    public function attachImage($id)
    {
            

         $headline = HeadlineModel::get()->find($id);
        if (!$headline)
            return redirect(parent::$data['cp_route_name']."/headline");
 
        parent::$data['headline'] = $headline;


        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

      
        return view('cp.headline.upload', parent::$data);
    }

    public function delUpload ($id)
    {
          $headline = HeadlineModel::get()->find($id);
        if (!$headline)
            return redirect(parent::$data['cp_route_name']."/headline");
          

         $headline->h_image="1.jpg";
         $headline->save();
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
                $image       = $file;
              
                $image_resize = Image::make($image->getRealPath());              
                $image_resize->resize(450, 270);
                $image_resize->save(public_path('img/blog/' .$filename));

                $image_resize->resize(70, 65);
                $image_resize->save(public_path('img/blog/small/' .$filename));
            //}

              if ($image_resize) {
                if($id!='0')
                {
                  $headline = HeadlineModel::get()->find($id);     
                    if (!$headline)
                         return redirect(parent::$data['cp_route_name']."/blog");
                
                  $headline->h_image=$filename;
                  $headline->save();
              }
                  return response(array('status' => 1, 'file_name' => $filename, 'my_server' => \URL::asset('')));
              } else {
                  return response(array('status' => 2, 'message' => $message));
              }
          }



}
