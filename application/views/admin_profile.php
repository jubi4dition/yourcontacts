<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/admin_navbar'); ?>
<div class="container">
<div class="content" style="display:none">
  <div class="page-header">
    <h2>Change the Admin Password</h2>
  </div>
  <div class="row">
    <div class="span4">
      <form id="formPassword" class="well" accept-charset="utf-8">
        <input type="text" name="curpwd" class="input-block-level" placeholder="Current Password" required maxlength="20" autofocus />
        <input type="text" name="newpwd" class="input-block-level" placeholder="New Password" required maxlength="20" />
        <button type="submit" class="btn btn-danger btn-large" data-loading-text="Sending...">
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
<script src="<?=base_url('js/bootstrap-button.js'); ?>"></script>
<script>
$(document).ready(function() {

  $("#formPassword").submit(function(){
    
    $("#formPassword button").button('loading');
    $("#success").hide();
    $("#error").hide();
    
    var faction = "<?=site_url('admin/change_password')?>";
    var fdata = $("#formPassword").serialize();

    $.post(faction, fdata, function(rdata){
      var json = jQuery.parseJSON(rdata);
      if (json.isSuccessful) {
        $("#successMessage").html(json.message);
        $("#success").show();
        $("#formPassword input[name='curpwd']").val("");
        $("#formPassword input[name='newpwd']").val("");
        $("#formPassword input").blur();
      } else {
        $("#errorMessage").html(json.message);
        $("#error").show();
        $("#formPassword input[name='curpwd']").select();
      }
      
      $("#formPassword button").button('reset');
    });
      
    return false;
  });

  $(".content").fadeIn(1000);
});
</script>
<? $this->load->view('includes/footer'); ?>
