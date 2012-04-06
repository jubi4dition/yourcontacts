<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/navbar', array('active' => "add")); ?>
<div class="container">
	<div class="content" style="display:none">
		<div class="page-header">
			<h1>Add A Contact</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form id="formAdd" class="well" accept-charset="utf-8">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<input type="text" name="name" class="input-large" placeholder="Username" required maxlength="40" autofocus />
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-envelope"></i></span>
						<input type="email" name="email" class="input-large" placeholder="Email" required maxlength="40" />
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-headphones"></i></span>
						<input type="text" name="phone" class="input-large" placeholder="Phone" required maxlength="15" />
					</div>
					<button type="submit" class="btn btn-success btn-large" data-loading-text="Sending...">
					<i class="icon-file icon-white"></i> Add Contact</button>
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
	<script>
	$(document).ready(function() {
		
		$("#formAdd").submit(function(){
			
			$("#formAdd button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?=site_url('site/add_contact')?>";
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

		$(".content").fadeIn(1000);
	});
	</script>
<? $this->load->view('includes/footer'); ?>