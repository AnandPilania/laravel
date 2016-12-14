<div class="panel panel-transparent">
  <div class="panel-heading">
    <div class="panel-title">Create new 
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-10">

        <form id="aboutus" class="form-horizontal" role="form" autocomplete="off" novalidate action="{{ URL::route('comments.store') }}" method="POST" enctype="multipart/form-data">
         <div class="form-group">
            <label for="blog_id" class="col-sm-3 control-label">Blog Id</label>
            <select name="blog_id" class="form-control" required>
        <option value="">select </option>
        @foreach($datas as $datas)
       <option value="{{ $datas->id }}">{{ $datas->title}}</option>
        @endforeach
       </select>
          </div>
	          <div class="form-group">
            <label for="user_id" class="col-sm-3 control-label">Users Id</label>
           <select name="user_id" class="form-control" required>
        <option value="">select </option>
        @foreach($data1 as $data1)
       <option value="{{ $data1->id }}">{{ $data1->fname}}</option>
        @endforeach
       </select>
          </div>
           <div class="form-group">
            <label for="comments" class="col-sm-3 control-label">Comment</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="comments" required pavalue="{{old('comments')}}">
            </div>
          </div>
             <div class="form-group">
            <label for="publish" class="col-sm-3 control-label">Publish</label>
            <div class="col-sm-9">
          <select name="publish" class="form-control">
        <option value="">Select Publish</option>
        <option value="1">Yes</option>
         <option value="0">No</option>
        </select>            
        </div>
          </div>

<input type="hidden" name="_method" value="POST"></input>
<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
<input type="submit" value="Submit" class="btn btn-primary"></input>
  </form>

 
