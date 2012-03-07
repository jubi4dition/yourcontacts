<?php $this->load->view('includes/header'); ?>

<div class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?=site_url('site')?>">Your Contacts</a>
			<ul class="nav">
				<li><?=anchor('site/add', 'Add')?></li>
				<li><?=anchor('site/delete', 'Delete')?></li>
				<li class="active"><?=anchor('site/edit', 'Edit')?></li>
			</ul>
			<div class="pull-right">
				<small class="navbar-text">User: <?=anchor('site/profile', $this->session->userdata('email'))?></small>
				<a href="<?=site_url('site/logout')?>" class="btn btn-primary">
				<i class="icon-road icon-white"></i> Logout</a>
			</div>
		</div>
	</div>
</div>

<div class="container">

	<div class="content">
		<div class="page-header">
			<h1>Edit A Contact</h1>
		</div>

		<div class="row">
			<div class="span4">
			<form id="formEdit" class="well" accept-charset="utf-8">
			<select id="formSelect" name="name" class="input-large">
			<?php foreach($contacts as $contact): ?>
				<option value="<?=$contact['name']?>"><?=$contact['name']?></option>	
			<?php endforeach;?>
			</select>
			<input type="email" name="email" class="input-large" placeholder="Email" required maxlength="40" value="<?=$firstcontact['email']?>"/>
			<input type="text" name="phone" class="input-large" placeholder="Phone" required maxlength="15" value="<?=$firstcontact['phone']?>"/>
			<br>
			<button type="submit" class="btn btn-warning btn-large" data-loading-text="Sending...">
			<i class="icon-pencil icon-white"></i> Edit Contact</button>
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
			<div id="errorMessage" class="alert alert-error">.
      		</div>
      		</div>
      	</div>
      
	</div>
	<div id="testOutput"></div>
	<script src="<?=base_url("js/jquery.js")?>"></script>
	<script src="<?=base_url("js/bootstrap-button.js")?>"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		
		$("#formEdit").submit(function(){
			
			$("#formEdit button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?=site_url('site/edit_contact')?>";
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

		$("#formSelect").change(function() {

			var faction = "<?=site_url('site/get_contact_data')?>";
			var fdata = $("#formSelect").serialize();
			
			$.post(faction, fdata, function(rdata){
				var json = jQuery.parseJSON(rdata);
				
				$("#formEdit input[name='email']").val(json.email);
				$("#formEdit input[name='phone']").val(json.phone);
			});
		});
	
	});
	</script>
<?php $this->load->view('includes/footer'); ?>