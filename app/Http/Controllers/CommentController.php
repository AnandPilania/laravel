<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\fc_blogs;
use App\fc_comment;
use App\user;
use Illuminate\Http\Request;
use DB;

class CommentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datas = fc_comment::get();
		$data = array();
		foreach ($datas as $key => $value) {
			if($value->user_id != NULL){ 
				$texts = DB::table('users')->where('id', $value->user_id)->get();
			    foreach ($texts as $text) {
			      $text = $text->fname .' '.$text->lname ;
			     }
        }


			else 
				$text =  "Anonymous";
			$value->user =$text;
			$data[$key] = $value;

		}

	    return view("vendor.pingpong.admin.comments.index")->with("data", $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$datas = fc_blogs::get();
		$data1 = user::get();
		return view("vendor.pingpong.admin.comments.create")->with("datas", $datas)->with("data1", $data1);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $data = new fc_comment;
		$data->id = $request->input("id");
		$data->blog_id = $request->input("blog_id");
		$data->user_id = $request->input("user_id");
        $data->comments = $request->input("comments");
        $data->save();
		return redirect("admin/comments");	
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = fc_comment::find($id);
		return view("vendor.pingpong.admin.comments.view")->with("data", $data);	
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$edit_data = fc_comment::where('id',$id)->first();
		return view("vendor.pingpong.admin.comments.edit")->with('edit', $edit_data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$update_data = fc_comment::where('id',$id)->first();
		$update_data->comments = $request->input("comments");
		$update_data->save();
		return redirect("admin/comments");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$delete_data = fc_comment::where('id',$id)->first();
		$delete_data->delete();
		return redirect("admin/comments");
	}

}
