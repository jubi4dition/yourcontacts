<?php $this->load->view('includes/header'); ?>

<div class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?php echo site_url('site');?>">Your Contacts</a>
			
			<p class="navbar-text pull-right">
				not logged in
			</p>
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
				<form class="well" action="<?php echo site_url('site/check_login');?>" method="post" accept-charset="utf-8">
					<input type="text" class="input-large" name="email" placeholder="Email" required maxlength="40"> 
					<input type="password" class="input-large" name="password" placeholder="Password" required maxlength="20">
					<br>
					<input type="submit" class="btn btn-primary btn-large" value="Login"/>
				</form>
			</div>
		</div>
		<?php if($message == TRUE):?>
      	<div class="row">
			<div class="span4">
			<div class="alert alert-error">
        	<strong>Login</strong> failed!.
      		</div>
      		</div>
      	</div>
      	<?php endif;?>
	</div>
<?php $this->load->view('includes/footer'); ?>