<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use App\Models\SettingModel;

class Site
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$settings=SettingModel::where("name","is_open")->first();
        //if($settings->value!=1)
        //{
        //    $description=SettingModel::where("name","close_message")->first();
        //    return view("site.error",["title"=>"Close","description"=>$description->value]);
        //}

        //return $next($request);
    }

}
