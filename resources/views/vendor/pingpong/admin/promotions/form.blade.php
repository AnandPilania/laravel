@if(isset($model))
{!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.promotions.update', $model->id]]) !!}
@else
{!! Form::open(['files' => true, 'route' => 'admin.promotions.store']) !!}
@endif
    <div class="form-group">
        {!! Form::label('code', 'Code:') !!}
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('code', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('company_name', 'Company Name:') !!}
        {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_name', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('company_description', 'Company Description:') !!}
        {!! Form::textarea('company_description', null, ['class' => 'form-control', 'id' => 'ckeditor-company']) !!}
        {!! $errors->first('company_description', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('company_logo', 'Company Logo:') !!}
        {!! Form::file('company_logo', ['class' => 'form-control']) !!}
        {!! $errors->first('company_logo', '<div class="text-danger">:message</div>') !!}
    </div>
    @if(isset($model))
    <div class="form-group">
        @if($model->company_logo)
        <img class="img-responsive" src="{!! asset('/images/promotions/' . $model->company_logo) !!}">
        @endif
    </div>
    @endif
    <div class="form-group">
        {!! Form::label('offer_name', 'Offer Name:') !!}
        {!! Form::text('offer_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('offer_name', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('offer_description', 'Offer Description:') !!}
        {!! Form::textarea('offer_description', null, ['class' => 'form-control', 'id' => 'ckeditor-offer']) !!}
        {!! $errors->first('offer_description', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('discount', 'Discount:') !!}
        {!! Form::text('discount', null, ['class' => 'form-control']) !!}
        {!! $errors->first('discount', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('type_id', 'Type:') !!}
        {!! Form::select('type_id', $types, null, ['class' => 'form-control']) !!}
        {!! $errors->first('type_id', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

@section('script')

    {!! script('vendor/ckeditor/ckeditor.js') !!}
    {!! script('vendor/ckfinder/ckfinder.js') !!}

    <script type="text/javascript">
        var prefix = '{!! asset(option("ckfinder.prefix")) !!}';
        CKEDITOR.editorConfig = function( config ) {
           config.filebrowserBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html';
           config.filebrowserImageBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Images';
           config.filebrowserFlashBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Flash';
           config.filebrowserUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
           config.filebrowserImageUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
           config.filebrowserFlashUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
        };

        var editorCompany = CKEDITOR.replace('ckeditor-company');
        CKFinder.setupCKEditor(editorCompany, prefix + '/vendor/ckfinder/') ;
        var editorOffer = CKEDITOR.replace('ckeditor-offer');
        CKFinder.setupCKEditor(editorOffer, prefix + '/vendor/ckfinder/') ;
    </script>
@stop
