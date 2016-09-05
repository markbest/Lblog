<?php
    use App\Customer;
	use App\Article;
	use App\Config;
	
	function shortDate($date){
		return date('Y-m-d',strtotime($date));
	}
	
	function checklogin()
	{
		$token = Cookie::get("TOKEN");
		if(isset($token)){
			$user = json_decode($token);
			$customer = Customer::find($user->id);
			if($customer->remember_token == $user->token){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	function getCustomer()
	{
		if(checklogin()){
			$token = Cookie::get("TOKEN");
			$user = json_decode($token);
			return $user;
		}
	}
	
	function getCustomerIcon()
	{
		if(checklogin()){
			$token = Cookie::get("TOKEN");
			$user = json_decode($token);
			$customer = Customer::find($user->id);
			if($customer->icon){
				return asset($customer->icon);
			}else{
				return asset('images/default.gif');
			}
		}
	}
	
	function getCategoryArticleNumber($cat_id)
	{
		$number = Article::where('cat_id','=',$cat_id)->get();
		return count($number);
	}
	
	function getAllTags()
	{
		$tags = \App\Article::latest()->get();
		$all_tags = array();
		$index = 0;
		foreach($tags as $tag){
			$data = explode('、',$tag->slug);
			if(count($data) > 0){
				foreach($data as $value){
					$all_tags[$index]['id'] = $tag->id;
				    $all_tags[$index]['name'] = $value;
					$index++;
				}
			}else{
				$all_tags[$index]['id'] = $tag->id;
				$all_tags[$index]['name'] = $tag->slug;
			}
			$index++;
		}
		return $all_tags;
	}
	
	function getConfig($path)
	{
		$config = Config::where('path',$path)->first();
		if($config->id){
			return $config->value;
		}else{
			return null;
		}
	}
	
	function getPageHtml($perpage,$current_page,$count,$total)
	{
		$start_page = $perpage * ($current_page - 1) + 1;
		$end_page = $perpage * ($current_page - 1) + $count;
		$page_html = 'Showing '.$start_page.' to '.$end_page.' of '.$total.' entries';
		return $page_html;
	}
	
	function getMatchName($keywords,$name){
		if($keywords){
			$keywords_array = explode(' ',$keywords);
			foreach($keywords_array as $value){
				if($value){
					$name = str_ireplace($value,'<span style="color:red;">'.$value.'</span>',$name);
				}
			}
		}
		return $name;
	}

