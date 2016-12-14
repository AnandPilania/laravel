<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang;
use Illuminate\Http\Request;
use App\fc_blogs;
use Auth;
use App\fc_filter;
use App\User;
use App\FilterBlogMap;

class BlogsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datas = fc_blogs::get();
		$data = array();
		foreach ($datas as $key => $value) {
			if($value->publish == 1) 
				$text = "Published"; 
			else 
				$text =  "unpublished";
			$value->publishtext = $text;
			$data[$key] = $value;

		}
	    return view("vendor.pingpong.admin.blogs.index")->with("data", $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$datas = fc_filter::get();
		$users = User::get();
		return view("vendor.pingpong.admin.blogs.create")->with("datas", $datas)->with("users",$users);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//return $request->all();
		
      // if(Auth::check())
      // {
      //   $user_id = Auth::user()->id;
      // }
      // else
      // {
      //   $user_id = "";
      // }
      
		$data = new fc_blogs;
		$data->id = $request->input("id");
		$data->user_id = $request->input("author_name");
        $data->title = $request->input("title");
		$data->description = $request->input("description");
		$data->tags = json_encode(explode(',',$request->input("tags")));
		//return $data->tags;
		if($request->file('image'))
		{
			$file=$request->file('image');
			$img=time()."-".$file->getClientOriginalName();
			$file->move(public_path().'/upload', $img);
			$data->image=$img;
		}
		$data->author = $request->input("author");
		$data->link = $request->input("link");
		$data->publish = $request->input("publish");
		$check = $data->save();
		if($check)
		{
			$filters = $request->input('filter_id');
			foreach ($filters as $filter) {
				if (fc_filter::where('id',$filter)->count()>0) {
				$fil = new FilterBlogMap;
				$fil->blog_id = $data->id;
				$fil->filter_id = $filter;
				$fil->save();
				}
			}
		}
		return redirect("admin/blogs");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = fc_blogs::find($id);
		
		return view("vendor.pingpong.admin.blogs.view")->with("data", $data);		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$edit_data = fc_blogs::where('id',$id)->first();
		$selected = FilterBlogMap::where('blog_id',$id)->select('filter_id')->lists('filter_id')->toArray();
		 
		
		$data_filters = fc_filter::get();
		$users = User::get();
		return view("vendor.pingpong.admin.blogs.edit")->with('edit', $edit_data)->with("data_filters", $data_filters)->with("selected", $selected)->with('users', $users);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$update_data = fc_blogs::where('id',$id)->first();
		$update_data->title = $request->input("title");
		$update_data->description = $request->input("description");
		$update_data->tags = json_encode(explode(',',$request->input("tags")));
      if($request->file('image'))
		{
			$file=$request->file('image');
			$img=time()."-".$file->getClientOriginalName();
			$file->move(public_path().'/upload', $img);
			$update_data->image=$img;
		}
		$update_data->author = $request->input("author");
		$update_data->link = $request->input("link");
		$update_data->publish = $request->input("publish");
			
			$check = $update_data->save();
		if($check)
		{
				$dataselected = FilterBlogMap::where('blog_id',$id);
				$dataselected->delete();
				
			$filters = $request->input('filter_id');
			foreach ($filters as $filter) {
				if (fc_filter::where('id',$filter)->count()>0) {
				$fil = new FilterBlogMap;
				$fil->blog_id = $update_data->id;
				$fil->filter_id = $filter;
				$fil->save();
				}
			}
		}
		return redirect("admin/blogs");	
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$delete_data = fc_blogs::where('id',$id)->where('publish','0')->first();
		if ($delete_data) {
		$delete_data->delete();
		}
		return redirect("admin/blogs");	
	}

}
