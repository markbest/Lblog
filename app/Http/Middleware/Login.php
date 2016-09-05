<?php namespace App\Http\Middleware;

use Closure;
use Cookie;
use Redirect;
use Illuminate\Contracts\Routing\Middleware;
use App\Customer;

class Login {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    //取得用户信息的Cookie
        $token = Cookie::get("TOKEN");
        //如果有Cookie
        if(isset($token)){
        	$user = json_decode($token);
        	$customer = Customer::where('email',$user->email)->get();
        	foreach($customer as $user){
        		$token = $user->remember_token;
        	}
        	if($token == $user->remember_token){
        		//往下执行
        		return $next($request);
        	}else{
        		return Redirect::action("CustomerController@login", ["path" => $request->fullUrl()]);
        	}
        }else{
            //如果取不到用户的cookie，跳转到用户登陆页面
            return Redirect::action("CustomerController@login", ["path" => $request->fullUrl()]);
        }
	}
}
