<?php $this->load->view('includes/header'); ?>

<div class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?php echo site_url('site');?>">Your Contacts</a>
			<ul class="nav">
				<li><?php echo anchor('site/add', 'Add');?></li>
				<li class="active"><?php echo anchor('site/delete', 'Delete');?></li>
				<li><?php echo anchor('site/edit', 'Edit');?></li>
			</ul>
			<div class="pull-right">
				<small class="navbar-text">User: <?php echo anchor('site/profile', $this->session->userdata('email'));?></small>
				<a href="<?php echo site_url('site/logout');?>" class="btn" type="submit">Logout</a>
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
			<select id="formSelect" name="name" class="span3">
				<?php 
				foreach($contacts as $contact){
					echo "<option value=\"".$contact['name']."\">".$contact['name']."</option>\n";	
				}
				?>
            </select>
			<input type="submit" class="btn btn-danger btn-large" value="Delete Contact"/>
			</form>
			</div>
		</div>
		
		<div id="success" class="row" style="display: none">
			<div class="span4">
			<div id="successMessage" class="alert alert-success">
      		</div>
      		</div>
      	</div>
      	
      	<div id="error" class="row" style="display: none">
			<div class="span4">
			<div id="errorMessage" class="alert alert-error">n.
      		</div>
      		</div>
      	</div>
      	
	</div>
	
	<script src="<?php echo base_url("js/jquery.js");?>"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		
		$("#formDelete").submit(function(){
			
			$("#formDelete input[type='submit']").attr("disabled", "true");
			$("#formDelete input[type='submit']").attr("value", "Sending...");
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?php echo site_url('site/delete_contact')?>";
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
				
				$("#formDelete input[type='submit']").attr("value", "Delete Contact");
				$("#formDelete input[type='submit']").removeAttr("disabled");
			});
				
			return false;
		});
	});
	</script>
<?php $this->load->view('includes/footer'); ?>