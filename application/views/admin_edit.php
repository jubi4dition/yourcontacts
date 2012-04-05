<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/admin_navbar', array('active' => 'edit')); ?>
<div class="container">
	<div class="content">
		<div class="page-header">
			<h1>Edit A User</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form id="formEdit" class="well" accept-charset="utf-8">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<select id="formSelect" name="email" class="input-large">
						<? foreach($users as $user): ?>
							<option value="<?=$user['email']?>">
							<?=$user['email']?>
							</option>
						<? endforeach;?>
						</select>
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-lock"></i></span>
						<input type="password" class="input-large" name="pwd" placeholder="Password" required maxlength="20" />
					</div>
					<button type="submit" class="btn btn-warning btn-large" data-loading-text="Sending...">
					<i class="icon-pencil icon-white"></i> Edit User</button>
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
	<script src="<?=base_url('js/jquery.js')?>"></script>
	<script src="<?=base_url('js/bootstrap-button.js')?>"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		
		$("#formEdit").submit(function(){
			
			$("#formEdit button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?=site_url('admin/edit_user')?>";
			var fdata = $("#formEdit").serialize();
			$.post(faction, fdata, function(rdata){
				var json = jQuery.parseJSON(rdata);
				if(json.isSuccessful){
					$("#successMessage").html(json.message);
					$("#success").show();
				}else{
					$("#errorMessage").html(json.message);
					$("#error").show();
				}
				
				$("#formEdit button").button('reset');
			});
				
			return false;
		});
	
	});
	</script>
<? $this->load->view('includes/footer'); ?>