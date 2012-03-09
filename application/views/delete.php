<? $this->load->view('includes/header'); ?>
<div class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?=site_url('site')?>">Your Contacts</a>
			<ul class="nav">
				<li><?=anchor('site/add', 'Add')?></li>
				<li class="active"><?=anchor('site/delete', 'Delete')?></li>
				<li><?=anchor('site/edit', 'Edit')?></li>
			</ul>
			<div class="pull-right">
				<small class="navbar-text">User: <?=anchor('site/profile', $this->session->userdata('email'))?></small> 
				<a href="<?=site_url('site/logout')?>" class="btn btn-primary"><i class="icon-road icon-white"></i> Logout</a>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="content">
		<div class="page-header">
			<h1>Delete A Contact</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form id="formDelete" class="well" accept-charset="utf-8">
					<select id="formSelect" name="name" class="input-large">
					<? foreach($contacts as $contact): ?>
						<option value="<?=$contact['name']?>">
						<?=$contact['name']?>
						</option>
					<? endforeach;?>
					</select>
					<button type="submit" class="btn btn-danger btn-large" data-loading-text="Sending...">
					<i class="icon-trash icon-white"></i> Delete Contact</button>
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
	<script type="text/javascript">
	$(document).ready(function() {
		
		$("#formDelete").submit(function(){
			
			$("#formDelete button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?=site_url('site/delete_contact')?>";
			var fdata = $("#formDelete").serialize();

			$.post(faction, fdata, function(rdata){
				var json = jQuery.parseJSON(rdata);
				if(json.isSuccessful){
					$("#successMessage").html(json.message);
					$("#success").show();
					$("#formSelect option[value='"+ json.name + "']").remove();
				}else{
					$("#errorMessage").html(json.message);
					$("#error").show();
				}
				
				$("#formDelete button").button('reset');
			});
				
			return false;
		});
	});
	</script>
<? $this->load->view('includes/footer'); ?>