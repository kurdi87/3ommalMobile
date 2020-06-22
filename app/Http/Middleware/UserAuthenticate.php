<?php namespace App\Http\Middleware;

use Closure;
use App\Models\ActionRouteCustomerModel;
use Route;
use App\Models\SystemLookupModel;

class UserAuthenticate
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


        auth()->setDefaultDriver('web2');

        $user = auth('web2')->user();
        if ($user){
            if ($user->SysUsr_Status != SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_ACTIVE")) {
                auth('web2')->logout();
                if(\Cookie::get('relogin'))
                    return redirect(config('app.user_route_name')."/relogin");

                return redirect(config('app.user_route_name')."/login");
            }
            if (ActionRouteCustomerModel::inList(Route::currentRouteName()) && !$user->canDo(Route::currentRouteName())) {
                $route = ActionRouteCustomerModel::where("ActRoute_RouteName", Route::currentRouteName())->first();
                return redirect()->intended(config('app.user_route_name'))->with("error", "You don't have " . $route->action->Action_Name . " permission");
            }
            return $next($request);
        }
        else{

            return redirect(config('app.user_route_name')."/login");
        }
    }
}