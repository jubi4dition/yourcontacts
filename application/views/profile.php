<? $this->load->view('includes/header'); ?>
<div class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?=site_url('site')?>"><img src="<?=base_url('css/img/yourcontacts.png')?>" width="57px"/></a>
			<ul class="nav">
				<li><?=anchor('site/add', 'Add')?></li>
				<li><?=anchor('site/delete', 'Delete')?></li>
				<li><?=anchor('site/edit', 'Edit')?></li>
			</ul>
			<div class="pull-right">
				<small class="navbar-text">User: <?=anchor('site/profile', $this->session->userdata('email'))?></small>
				<a href="<?=site_url('site/logout')?>" class="btn btn-primary"> <i class="icon-road icon-white"></i> Logout</a>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="content">
		<div class="page-header">
			<h1>Change Your Password</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form id="formPassword" class="well" accept-charset="utf-8">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-lock"></i></span>
						<input type="text" name="curpwd" class="input-large" placeholder="Current Password" required maxlength="20" />
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-lock"></i></span>
						<input type="text" name="newpwd" class="input-large" placeholder="New Password" required maxlength="20" />
					</div>
					<button type="submit" class="btn btn-danger btn-large" data-loading-text="Sending...">
					<i class="icon-refresh icon-white"></i> Change Password</button>
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
				<div id="errorMessage" class="alert alert-error">n.</div>
			</div>
		</div>
	</div>
	<script src="<?=base_url("js/jquery.js")?>"></script>
	<script src="<?=base_url("js/bootstrap-button.js")?>"></script>
	<script>
	$(document).ready(function() {
		
		$("#formPassword").submit(function(){
			
			$("#formPassword button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?=site_url('site/change_password')?>";
			var fdata = $("#formPassword").serialize();
			$.post(faction, fdata, function(rdata){
				var json = jQuery.parseJSON(rdata);
				if(json.isSuccessful){
					$("#successMessage").html(json.message);
					$("#success").show();
					$("#formPassword input[name='curpwd']").val("");
					$("#formPassword input[name='newpwd']").val("");
					$("#formPassword input").blur();
				}else{
					$("#errorMessage").html(json.message);
					$("#error").show();
					$("#formPassword input[name='curpwd']").select();
				}
				
				$("#formPassword button").button('reset');
			});
				
			return false;
		});
	});
	</script>
<? $this->load->view('includes/footer'); ?>