<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\fc_comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function postcomment(Request $request)
	{
		
		$data = new fc_comment;
		$data->user_id = $request->input("user_id");
        $data->comments = $request->input("comments");
        $data->save();
       // return $data;
       return redirect("comment");	

		
	}

// 	public function listcomment(Request $request)
// {

// 	$result = commentpost::where('post_id',$request->input('id'))->get();

// 	return $result;
//   //return view('front.mainblogs.view')->with('result',$result);
// }

}
