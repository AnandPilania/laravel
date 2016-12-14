<?php

namespace App\Http\Controllers\front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\fc_blogs;
use App\fc_comment;
use App\fc_filter;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use Auth;

class BlogController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function blogs()
	{
		$blogs = fc_blogs::where('publish', 1 )->orderBy('id', 'desc')->get();
		$data_blog = array();
		$data_filter = fc_filter::orderBy('name')->get();
		foreach ($blogs as $key => $value) {
			if($value->user_id !=NULL)
			{
			$value->user = "";//DB::table('users')->where('id', $value->user_id)->first()->fname.' '.DB::table('users')->where('id', $value->user_id)->first()->lname;


			}
			else
			{
				$value->user = 'anonymous';
			}
			 $value->filters = DB::table('map_filter')->where('blog_id', $value->id)->lists('filter_id');
			$data_blog[$key] = $value;
		}



	    return view("blogs")->with("data_blog", $data_blog)->with("data_filter", $data_filter);
	}

	public function singleblog($id, $slug)
	{
		//strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
		$comments_count = fc_comment::where('blog_id', $id)->count();
		$data_blog = fc_blogs::where('id', $id)->first();
		$comments = fc_comment::where('blog_id', $id)->get();
		$data_comments = array();
		//foreach ($data_blog as $key => $value) {
			if($data_blog->user_id !=NULL)
			{
			$data_blog->user = DB::table('fc_blogs')->where('id', $data_blog->author)->first();
			}
			else
			{
				$data_blog->user = 'anonymous';
			}
		//}
		foreach ($comments as $key => $value) {
			if($value->user_id !=NULL)
			{
			$value->user = DB::table('users')->where('id', $value->user_id)->get();
			//return $value->user;
			}
			else
			{
				$value->user = array();
			}
			$data_comments[$key] = $value;
		}
		//return $data_comments;
	    return view("blog")->with("data_blog", $data_blog)->with("data_comments", $data_comments)->with("comments_count", $comments_count);
	}

	public function storeComment($id, StoreCommentRequest $request)
	{
        $blog = fc_blogs::findOrFail($id);

        if (Auth::user() != null) {
            $request['user_id'] = Auth::id();
        } else {
            $request['user_id'] = 0;
        }

        $blog->comments()->create($request->only(fc_comment::getFillableAttributes()));

        return redirect()->back();
	}
	public function blogs_userid($user_id)
	{
     // $blogs = fc_blogs::where('user_id', $user_id)->get();
     // return view("blogs");
		$blogs = fc_blogs::where('user_id', $user_id)->where('publish', 1 )->orderBy('id', 'desc')->get();
		$data_blog = array();
		$data_filter = fc_filter::get();
		foreach ($blogs as $key => $value) {
			if($value->user_id !=NULL)
			{
			$value->user = DB::table('users')->where('id', $value->user_id)->first()->fname.' '.DB::table('users')->where('id', $value->user_id)->first()->lname;


			}
			else
			{
				$value->user = 'anonymous';
			}
			$value->filters = DB::table('map_filter')->where('blog_id', $value->id)->lists('filter_id');
			$data_blog[$key] = $value;
		}
	    return view("blogs")->with("data_blog", $data_blog)->with("data_filter", $data_filter);
	}

	public function blogs_tags($tagy)
	{
     // $blogs = fc_blogs::where('user_id', $user_id)->get();
     // return view("blogs");

		$blogs = fc_blogs::where('tags', 'LIKE', '%'.$tagy.'%')->get();

		$data_blog = array();
		$data_filter = fc_filter::get();
		foreach ($blogs as $key => $value) {
			if($value->user_id !=NULL)
			{
			$value->user = ""; //DB::table('users')->where('id', $value->user_id)->first()->fname.' '.DB::table('users')->where('id', $value->user_id)->first()->lname;


			}
			else
			{
				$value->user = 'anonymous';
			}
			$value->filters = DB::table('map_filter')->where('blog_id', $value->id)->lists('filter_id');
			$data_blog[$key] = $value;
		}
	    return view("blogs")->with("data_blog", $data_blog)->with("data_filter", $data_filter);
	}
}
