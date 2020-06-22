<?php namespace App\Http\Controllers\User;

use App;


use App\Models\MenuModel;


use Config;
use Illuminate\Http\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\SuperUserController;
use Illuminate\Support\Facades\Mail;

//use App\Models\RoleModel;

class SavedJobsController extends SuperUserController
{
    public function __construct()
    {
        try {
            parent::__construct();
            parent::$data['active_menuPlus'] = "SavedJobs";
            parent::$data['active_menu'] = "SavedJobs";
            parent::$data["breadcrumbs"] = ["SavedJobs" => parent::$data['user_route_name'], "SavedJobs" => parent::$data['user_route_name'] . "/lead"];
            parent::$data["role"] = auth('web2')->user("user")->role;
        } catch (\Exception $e) {
            redirect(parent::$data['user_route_name'] . '/login');
        }

    }

    public function getlang()
    {
        if (\Session::has('lang')) {

            if (\Session::get('lang') == 'en')
                $lang = 1;
            else if (\Session::get('lang') == 'ar')
                $lang = 2;
            else
                $lang = 3;
        } else
            $lang = 1;
        return $lang;
    }

    public function index()
    {
        $lang = $this->getlang();
        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        return view('user.saved_jobs', parent::$data);

    }

}
