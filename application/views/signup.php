<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/nli_navbar'); ?>
<div class="container">
	<div class="content">
		<div class="page-header">
			<h1>Sign Up</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form id="formSignup" class="well" accept-charset="utf-8">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-envelope"></i></span>
						<input type="text" class="input-large" name="email" placeholder="Your Email" required maxlength="40" autofocus />
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-envelope"></i></span>
						<input type="text" class="input-large" name="email2" placeholder="Repeat Email" required maxlength="40" />
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-lock"></i></span>
						<input type="password" class="input-large" name="pwd" placeholder="Your Password" required maxlength="20" />
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-lock"></i></span>
						<input type="password" class="input-large" name="pwd2" placeholder="Repeat Password" required maxlength="20" />
					</div>
					<button type="submit" class="btn btn-primary btn-large" data-loading-text="Sending...">
					<i class="icon-book icon-white"></i> Sign Up</button>
				</form>
			</div>
		</div>
		<div id="success" class="row" style="display: none">
			<div class="span4">
				<div id="successMessage" class="alert alert-success">
				<p><strong>Registration</strong> successful!</p>
				<a href="<?=site_url('login')?>" class="btn btn-success"><i class="icon-arrow-right icon-white"></i> log on now</a>
				</div>
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
		
		$("#formSignup").submit(function(){
			
			$("#formSignup button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?=site_url('signup/sign_up')?>";
			var fdata = $("#formSignup").serialize();

			$.post(faction, fdata, function(rdata){
				var json = jQuery.parseJSON(rdata);
				if(json.isSuccessful){
					$("#success").show();
					$("#formSignup input").val("");
					$("#formSignup input").blur()
				}else{
					$("#errorMessage").html(json.message);
					$("#error").show();
					$("#formSignup input[name='email']").select();
				}
				
				$("#formSignup button").button('reset');
			});
				
			return false;
		});
	});
	</script>
<? $this->load->view('includes/footer'); ?>
