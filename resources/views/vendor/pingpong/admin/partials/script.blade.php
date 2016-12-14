<script src="{!! admin_asset('components/jquery/dist/jquery.min.js') !!}"></script>
<script src="{!! admin_asset('components/bootstrap/dist/js/bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="{!! admin_asset('components/jquery-ui/jquery-ui.min.js') !!}" type="text/javascript"></script>
<!-- Sparkline -->
<script src="{!! admin_asset('adminlte/js/plugins/sparkline/jquery.sparkline.min.js') !!}" type="text/javascript"></script>
<!-- datatable -->

<!-- jvectormap -->
<script src="{!! admin_asset('adminlte/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}" type="text/javascript"></script>
<script src="{!! admin_asset('adminlte/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="{!! admin_asset('adminlte/js/plugins/jqueryKnob/jquery.knob.js') !!}" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="{!! admin_asset('adminlte/js/plugins/daterangepicker/daterangepicker.js') !!}" type="text/javascript"></script>
<!-- datepicker -->
<script src="{!! admin_asset('adminlte/js/plugins/datepicker/bootstrap-datepicker.js') !!}" type="text/javascript"></script>

<script src="{{ URL::to('/') }}/js/selectize.js-master/dist/js/standalone/selectize.js" type="text/javascript"></script>
<!-- <script src="{{ URL::to('/') }}/js/selectize.js-master/dist/css/selectize.bootstrap3.css" type="text/javascript"></script>
 -->

<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{!! admin_asset('adminlte/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}" type="text/javascript"></script>
<!-- iCheck -->
<script src="{!! admin_asset('adminlte/js/plugins/iCheck/icheck.min.js') !!}" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/libraries/select2/js/select2.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{!! admin_asset('adminlte/js/AdminLTE/app.js') !!}" type="text/javascript"></script>
<script src="{{ URL::to('/')}}/js/jquery.validate.js"  type="text/javascript"></script>
<script src="{!! admin_asset('js/all.js') !!}" type="text/javascript"></script>
<script src="{{ URL::to('/')}}/packages/pingpong/admin/vendor/ckeditor/ckeditor.js"></script>

    <script src="{{ URL::to('/')}}/packages/pingpong/admin/vendor/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
$(".select2").select2({
	 tags: true,
	 placeholder: "Select Filters",
});
$(".selectauthor").select2();
$(".form_validate").validate();
 $('#dataTable').DataTable();

 $('#input-tags').selectize({
    delimiter: ',',
    persist: false,
    create: function(input) {
        return {
            value: input,
            text: input
        }
    }
});

</script>
 <script type="text/javascript">
       var prefix = '/{!! option("ckfinder.prefix") !!}';
        CKEDITOR.editorConfig = function( config ) {
           config.filebrowserBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html';
           config.filebrowserImageBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Images';
           config.filebrowserFlashBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Flash';
           config.filebrowserUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
           config.filebrowserImageUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
           config.filebrowserFlashUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
        };

        var editor = CKEDITOR.replace( 'ckeditor' );
        CKFinder.setupCKEditor( editor, prefix + '/vendor/ckfinder/') ;
    </script>

