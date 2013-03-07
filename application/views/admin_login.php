<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/nli_navbar'); ?>
<div class="container">
<div class="content" style="display:none">
  <div class="page-header">
    <h2>Admin Login</h2>
  </div>
  <div class="row">
    <div class="span4">
      <form class="well" action="<?=site_url('adminlogin/check_login'); ?>" method="post" accept-charset="utf-8">
        <input type="text" class="input-block-level" name="admin" value="Name" placeholder="Name" required maxlength="40" autofocus />
        <input type="password" class="input-block-level" name="pwd" placeholder="Password" required maxlength="20" />
        <button type="submit" class="btn btn-primary btn-block">
        <i class="icon-home icon-white"></i> Login</button>
      </form>
    </div>
  </div>
  <? if (isset($error)): ?>
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
<script src="<?=base_url('js/jquery.js'); ?>"></script>
<script>
$(document).ready(function() {
  $('.content').fadeIn(1000);
});
</script>
<? $this->load->view('includes/footer'); ?>
