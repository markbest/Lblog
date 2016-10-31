<?php
use App\Customer;
use App\Article;
use App\Config;
use App\Category;
use Illuminate\Support\Facades\DB;

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

function getArticleTagsList($tag)
{
	$tags_array = explode('、',$tag);
	return $tags_array;
}

function getAllCategorySelectList($parent_id = 0){
	$result = '';
	$parent_category = Category::where('parent_id','0')->get();
	$result .= '<select name="category" class="form-control" required="required">';
	$result .= '<option value="0">顶级目录</option>';
	foreach($parent_category as $category){
		if($parent_id == $category->id){
			$result .= '<option selected="selected" value="'.$category->id.'">'.$category->title.'</option>';
		}else{
			$result .= '<option value="'.$category->id.'">'.$category->title.'</option>';
		}
		$child_category = Category::where('parent_id',$category->id)->get();
		if($child_category->count()){
			foreach($child_category as $child){
				if($parent_id == $child->id){
					$result .= '<option selected="selected" value="'.$child->id.'">&nbsp;&nbsp;'.$child->title.'</option>';
				}else{
					$result .= '<option value="'.$child->id.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$child->title.'</option>';
				}
			}
		}
	}
	$result .= '</select>';
	return $result;
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
	$page_html = '第 '.$start_page.' 到 '.$end_page.' 共 '.$total.' 条';
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

function getChildCategory($category){
	$child = Category::where('parent_id',$category)->get();
	if(count($child)){
		return $child;
	}else{
		return '';
	}
}

function getAllCategoryList(){
	$result = array();
	$index = 0;
	$parent_category = Category::where('parent_id','0')->orderBy('sort','asc')->get();
	foreach($parent_category as $parent){
		$result[$index]['id'] = $parent->id;
		$result[$index]['title'] = $parent->title;

		$child_category = Category::where('parent_id',$parent->id)->orderBy('sort','asc')->get();
		if(count($child_category)){
			$child_index = 0;
			foreach($child_category as $child){
				$result[$index]['child'][$child_index]['id'] = $child->id;
				$result[$index]['child'][$child_index]['title'] = $child->title;
				$child_index++;
			}
		}else{
			$result[$index]['child'] = array();
		}
		$index++;
	}
	return $result;
}

function getAllTagsList()
{
	$tags = Article::orderBy('views','desc')->get();
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

