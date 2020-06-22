<?php namespace App\Http\Middleware;

      use Closure;
      use App\Models\ActionRouteModel;
      use Route;
      use App\Models\SystemLookupModel;

      class AdminAuthenticate
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
            
              $user = \Auth::user(); 
              if ($user){
              if ($user->SysUsr_Status != SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_ACTIVE")) {
                  \Auth::logout();
                  if(\Cookie::get('relogin'))
                      return redirect(config('app.cp_route_name')."/relogin");

                  return redirect(config('app.cp_route_name')."/login");
              }
              if (ActionRouteModel::inList(Route::currentRouteName()) && !$user->canDo(Route::currentRouteName())) {
                  $route = ActionRouteModel::where("ActRoute_RouteName", Route::currentRouteName())->first();
                  return redirect()->intended(config('app.cp_route_name'))->with("error", "You don't have " . $route->action->Action_Name . " permission");
              }
              return $next($request);
            } 
            else{
              
              return redirect(config('app.cp_route_name')."/login");
            }
          }
      }