<? $this->load->view('includes/header'); ?>
<div class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?=site_url('site')?>"><img src="<?=base_url('css/img/yourcontacts.png')?>" width="57px"/></a>
			<p class="navbar-text pull-right">not logged in</p>
		</div>
	</div>
</div>
<div class="container">
	<div class="content">
		<div class="page-header">
			<h1>Login</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form class="well" action="<?=site_url('login/check_login')?>" method="post" accept-charset="utf-8">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-envelope"></i></span><input type="text" class="input-large" name="email" placeholder="Email" required maxlength="40" />
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-lock"></i></span>
						<input type="password" class="input-large" name="pwd" placeholder="Password" required maxlength="20" />
					</div>
					<button type="submit" class="btn btn-primary btn-large">
					<i class="icon-home icon-white"></i> Login</button>
				</form>
			</div>
		</div>
		<? if($message == TRUE):?>
		<div class="row">
			<div class="span4">
				<div class="alert alert-error">
					<strong>Login</strong> failed!.
				</div>
			</div>
		</div>
		<? endif;?>
	</div>
<? $this->load->view('includes/footer'); ?>