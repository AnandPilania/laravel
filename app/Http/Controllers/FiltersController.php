<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang;
use Illuminate\Http\Request;
use App\fc_filter;

class FiltersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = fc_filter::get();
	    return view("vendor.pingpong.admin.filters.index")->with("data", $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view("vendor.pingpong.admin.filters.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$data = new fc_filter;
		$data->name = $request->input("title");
		$data->save();
		return redirect("admin/filters");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = fc_filter::find($id);
		//return $data;
		return view("vendor.pingpong.admin.filters.view")->with("data", $data);	
	
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$edit_data = fc_filter::where('id',$id)->first();
		return view("vendor.pingpong.admin.filters.edit")->with('edit', $edit_data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$update_data = fc_filter::where('id',$id)->first();
		//$update_data->id = $request->input("id");
		$update_data->name = $request->input("name");
		$update_data->save();
		return redirect("admin/filters");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$delete_data = fc_filter::where('id',$id)->first();
		$delete_data->delete();
		return redirect("admin/filters");
	}

}
