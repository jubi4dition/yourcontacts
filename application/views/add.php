<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/navbar'); ?>
<div class="container">
<div class="content" style="display:none">
  <div class="page-header">
    <h2>Add A Contact</h2>
  </div>
  <div class="row">
    <div class="span4">
      <form id="formAdd" class="well" accept-charset="utf-8">
        <input type="text" name="name" class="input-block-level" value="Name" placeholder="Name" required maxlength="40" autofocus />
        <input type="email" name="email" class="input-block-level" placeholder="Email" required maxlength="40" />
        <input type="text" name="phone" class="input-block-level" placeholder="Phone" required maxlength="15" />
        <button type="submit" class="btn btn-success btn-large">
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
<script src="<?=base_url('js/jquery.js'); ?>"></script>
<script>
$(document).ready(function() {

    $('#formAdd').submit(function() {

      var form = $(this);
      form.children('button').prop('disabled', true);
      $('#success').hide();
      $('#error').hide();

      var faction = '<?=site_url('site/add_contact'); ?>';
      var fdata = form.serialize();

      $.post(faction, fdata, function(rdata) {
          var json = jQuery.parseJSON(rdata);
          if (json.isSuccessful) {
              $('#successMessage').html(json.message);
              $('#success').show();
          } else {
              $('#errorMessage').html(json.message);
              $('#error').show();
          }

          form.children('button').prop('disabled', false);
          form.children('input[name="name"]').select();
      });

      return false;
    });

    $('#nav-add').addClass('active');

    $('.content').fadeIn(1000);
});
</script>
<? $this->load->view('includes/footer'); ?>
