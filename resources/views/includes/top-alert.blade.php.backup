<!-- custom error/success -->
<div class="alert alert-danger" style="text-align: center;" id="custom_error_client">
</div>
<div class="alert alert-success" style="text-align: center;" id="custom_success_client">
</div>

<script type="text/javascript">
	function showError(msg, duration) {
		var errorBanner = document.getElementById("custom_error_client");
		errorBanner.innerHTML = msg;
		errorBanner.style.display = 'block';
		$("#custom_error_client").trigger("errorShown", [duration])
	}

	function showSuccess(msg, duration) {
		var successBanner = document.getElementById("custom_success_client");
		successBanner.innerHTML = msg;
		successBanner.style.display = 'block';
		$("#custom_success_client").trigger("successShown", [duration])
	}

	function dismissError(e, duration) {
		setTimeout(function() {
			$('#custom_error_client').slideUp(800);
		}, duration);
	}

	function dismissSuccess(e, duration) {
		setTimeout(function() {
			$('#custom_success_client').slideUp(800);
		}, duration);
	}

	$('#custom_error_client').bind('errorShown', dismissError);
	$('#custom_success_client').bind('successShown', dismissSuccess);
</script>

<script type="text/javascript">
	@if (Session::has('custom_error'))
		showError("{{ session('custom_error') }}", 5000);
		{{ Session::forget('custom_error') }}
	@endif
	@if (Session::has('custom_success'))
		showSuccess("{{ session('custom_success') }}", 5000);
		{{ Session::forget('custom_success') }}
	@endif
</script>

