<?php namespace App\Http\Middleware;

use Closure;
use Session;

use App;
use Config;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
//use Illuminate\Contracts\Routing\Middleware;

class Language  {

    public function __construct(Application $app, Redirector $redirector, Request $request) {
        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
       $lang=\Session::get('lang',$this->app->config->get('app.fallback_locale'))  ;
         
        \App::setLocale($lang);
        return $next($request);
    }

}