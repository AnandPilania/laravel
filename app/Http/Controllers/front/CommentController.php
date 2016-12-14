<?php namespace App\Http\Controllers\front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\fc_comment;
use App\fc_blogs;

use Illuminate\Http\Request;

class CommentController extends Controller {

	public function comment()
	{
		$dat = fc_comment::get();
		$data_blog = fc_blogs::get();
	    return view("vendor.pingpong.admin.comments.comments")->with("dat", $dat)->with("data_blog", $data_blog);
	}

}
