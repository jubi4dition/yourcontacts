<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/navbar'); ?>
<div class="container">
<div class="content" style="display: none">
  <div class="page-header">
    <h2>Change Your Password</h2>
  </div>
  <div class="row">
    <div class="span4">
      <form id="formPassword" class="well" accept-charset="utf-8">
        <input type="text" name="curpwd" class="input-block-level" value="Current Password" placeholder="Current Password" required maxlength="20" autofocus />
        <input type="text" name="newpwd" class="input-block-level" placeholder="New Password" required maxlength="20" />
        <button type="submit" class="btn btn-danger btn-large">
        <i class="icon-refresh icon-white"></i> Change Password</button>
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
<script src="<?=base_url('js/jquery.js'); ?>"></script>
<script>
$(document).ready(function() {
  
  $('#formPassword').submit(function(){
    
    var form = $(this);
    form.children('button').prop('disabled', true);
    $('#success').hide();
    $('#error').hide();
  
    var faction = '<?=site_url('site/change_password'); ?>';
    var fdata = form.serialize();

    $.post(faction, fdata, function(rdata) {

        var json = jQuery.parseJSON(rdata);
        
        if (json.isSuccessful) {
          $('#successMessage').html(json.message);
          $('#success').show();
          form.children('input[name="curpwd"]').val('');
          form.children('input[name="newpwd"]').val('');
          form.children('input').blur();
        } else {
          $('#errorMessage').html(json.message);
          $('#error').show();
          form.children('input[name="curpwd"]').select();
        }
        
        form.children('button').prop('disabled', false);
    });
    
    return false;
  });

  $('.content').fadeIn(1000);
});
</script>
<? $this->load->view('includes/footer'); ?>
