
<!-- Scripts -->
<div id="chatdata"> </div>
<div class="container ">
	<div class="row">
		<div class="col-lg-4 col-md-3 col-sm-4 col-xs-12 text-center ">
			<ul class="nav-botm">
				<li><a href="{{ url('/pages/privacy-policy') }}" target="_blank">Privacy policy</a></li>
				<li><a href="{{ url('/pages/terms-of-use') }}" target="_blank">Terms of use</a></li>
			</ul>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
			<p>Copyright © 2016 Flying Chalks Pte. Ltd. <i> All rights reserved.</i></p>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
			<ul class="social-icon">
				<li><a href="https://www.facebook.com/flyingchalks" target="_blank"><i class="fa fa-facebook fc-custom"></i></a></li>
				<li><a href="https://www.instagram.com/flyingchalks" target="_blank"><i class="fa fa-instagram"></i></a></li>
			</ul>
		</div>
	</div>
</div>
<script>
	$( document ).ready(function() {
		var baseurl = "{{ URL::to('/')}}";
		setTimeout(function() {
			$("#custom_success").fadeOut("slow");
			$("#custom_error").fadeOut("slow");
	}, 10000);
});
</script>
<script src="{{ asset('/js/jquery.validate.js') }}" type="text/javascript"></script>
<script src="{{ asset('libraries/mixitup-master/src/jquery.mixitup.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#usersignup_submit").click(function(){
        $("#usersignup").submit();
    });
		$('#userlogin').validate();
		$('#usersignup').validate({
			rules: {
				password: {
					required: true,
					minlength: 6
				}
			}
		});
		$('#resetpassword').validate();
		$('#resetform').validate({
			rules: {
				password: {
					required: true,
					minlength: 6
				},
				password_confirmation: {
					equalTo: "#password"
				}
			}
		});
	});
</script>
<script>
$('#message').bind('input propertychange', function() {
	var lett=this.value
	var count= lett.length;
	var left=400-count;
	$("#countChar").html(left+" Char Left");
});
$(function(){
  var $filterSelect = $('#FilterSelect'),
  $container = $('#Container');

  $container.mixItUp({
  	animation: {
		enable: false
	}
  });

  $filterSelect.on('change', function(){
    $container.mixItUp('filter', this.value);
  });



	$('#filter').keyup(function(){
	  var val = $(this).val().toLowerCase();
	  var state = $container.mixItUp('getState');
	  var $filtered = state.$targets.filter(function(index, element){
	    return $(this).text().toString().indexOf( val.trim() ) >= 0;
	  });

	  $container.mixItUp('filter', $filtered);
	});
});
</script>
<script src="http://128.199.146.220:3000/socket.io/socket.io.js"></script>
<script src="{{ asset('/js/socket.js') }}"></script>
<script src="{{ asset('/js/chatpopup.js') }}"></script>
<div class="exchange-notify"></div>
<div class="chatbox-main"></div>
