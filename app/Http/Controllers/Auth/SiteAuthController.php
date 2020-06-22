<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ThrottlesLogins;

use Sarav\Multiauth\Foundation\AuthenticatesAndRegistersUsers;

class SiteAuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = "user";
        //$this->middleware('admin.guest', ['except' => 'getLogout']);
    }
}
