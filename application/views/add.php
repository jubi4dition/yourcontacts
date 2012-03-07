<?php $this->load->view('includes/header'); ?>

<div class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?php echo site_url('site');?>">Your Contacts</a>
			<ul class="nav">
				<li class="active"><?php echo anchor('site/add', 'Add');?></li>
				<li><?php echo anchor('site/delete', 'Delete');?></li>
				<li><?php echo anchor('site/edit', 'Edit');?></li>
			</ul>
			<div class="pull-right">
				<small class="navbar-text">User: <?php echo anchor('site/profile', $this->session->userdata('email'));?></small>
				<a href="<?php echo site_url('site/logout');?>" class="btn btn-primary">
				<i class="icon-road icon-white"></i> Logout</a>
			</div>
		</div>
	</div>
</div>

<div class="container">

	<div class="content">
		<div class="page-header">
			<h1>Add A Contact</h1>
		</div>

		<div class="row">
			<div class="span4">
			<form id="formAdd" class="well" accept-charset="utf-8">
			<input type="text" name="name" class="input-large" placeholder="Username" required maxlength="40"/>
			<input type="email" name="email" class="input-large" placeholder="Email" required maxlength="40"/>
			<input type="text" name="phone" class="input-large" placeholder="Phone" required maxlength="15"/>
			<br>
			<button type="submit" class="btn btn-success btn-large" data-loading-text="Sending...">
			<i class="icon-file icon-white"></i> Add Contact</button>
			</form>
			</div>
		</div>
		
		<div id="success" class="row" style="display: none">
			<div class="span4">
			<div id="successMessage" class="alert alert-success">
      		</div>
      		</div>
      	</div>
      	
      	<div id="error" class="row" style="display: none">
			<div class="span4">
			<div id="errorMessage" class="alert alert-error">n.
      		</div>
      		</div>
      	</div>
		
	</div>
	
	<script src="<?php echo base_url("js/jquery.js");?>"></script>
	<script src="<?php echo base_url("js/bootstrap-button.js");?>"></script>
	<script>
	$(document).ready(function() {
		
		$("#formAdd").submit(function(){
			
			$("#formAdd button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?php echo site_url('site/add_contact')?>";
			var fdata = $("#formAdd").serialize();
			$.post(faction, fdata, function(rdata){
				var json = jQuery.parseJSON(rdata);
				if(json.isSuccessful){
					$("#successMessage").html(json.message);
					$("#success").show();
				}else{
					$("#errorMessage").html(json.message);
					$("#error").show();
				}
				
				$("#formAdd button").button('reset');
				$("#formAdd input[name='name']").select();
			});
				
			return false;
		});
	});
	</script>
<?php $this->load->view('includes/footer'); ?>