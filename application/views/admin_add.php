<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/admin_navbar'); ?>
<div class="container">
<div class="content" style="display:none">
	<div class="page-header">
		<h2>Add A User</h2>
	</div>
	<div class="row">
		<div class="span4">
			<form id="formAdd" class="well" accept-charset="utf-8">
				<input type="text" class="input-block-level" name="email" placeholder="Email" required maxlength="40" autofocus />
				<input type="password" class="input-block-level" name="pwd" placeholder="Password" required maxlength="20" />
				<button type="submit" class="btn btn-success btn-large" data-loading-text="Sending...">
				<i class="icon-file icon-white"></i> Add User</button>
			</form>
		</div>
	</div>
	<div id="success" class="row" style="display: none">
		<div class="span4">
			<div id="successMessage" class="alert alert-success"></div>
		</div>
	</div>
	<div id="error" class="row" style="display: none">
		<div class="span4">
			<div id="errorMessage" class="alert alert-error"></div>
		</div>
	</div>
</div>
<script src="<?=base_url('js/jquery.js'); ?>"></script>
<script src="<?=base_url('js/bootstrap-button.js'); ?>"></script>
<script>
$(document).ready(function() {
	
	$("#formAdd").submit(function(){
		
		$("#formAdd button").button('loading');
		$("#success").hide();
		$("#error").hide();
		
		var faction = "<?=site_url('admin/add_user')?>";
		var fdata = $("#formAdd").serialize();
		
		$.post(faction, fdata, function(rdata){
			var json = jQuery.parseJSON(rdata);
			if (json.isSuccessful) {
				$("#successMessage").html(json.message);
				$("#success").show();
			} else {
				$("#errorMessage").html(json.message);
				$("#error").show();
			}
			
			$("#formAdd button").button('reset');
			$("#formAdd input[name='email']").select();
		});
			
		return false;
	});

	$(".content").fadeIn(1000);
});
</script>
<? $this->load->view('includes/footer'); ?>