<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/nli_navbar'); ?>
<div class="container">
	<div class="content">
		<div class="page-header">
			<h1>Admin Login</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form class="well" action="<?=site_url('adminlogin/check_login')?>" method="post" accept-charset="utf-8">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<input type="text" class="input-large" name="admin" placeholder="Name" required maxlength="40" autofocus />
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
		<? if($message == TRUE): ?>
		<div class="row">
			<div class="span4">
				<div class="alert alert-error">
					<strong>Login</strong> failed!.
				</div>
			</div>
		</div>
		<? else: ?>
		<div class="row">
			<div class="span4">
				<div class="alert alert-info">
					<strong>You</strong> are not logged in!
				</div>
			</div>
		</div>
		<? endif; ?>
	</div>
<? $this->load->view('includes/footer'); ?>
