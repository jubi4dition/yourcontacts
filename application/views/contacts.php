<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/navbar', array('active' => "no")); ?>
<div class="container">
	<div class="content" style="display:none">
		<div class="page-header">
			<h1>Your Contacts</h1>
		</div>
		<div class="row">
			<div class="span9">
				<table class="table table-striped table-bordered tablesorter" id="tcontacts">
					<thead>
						<tr>
							<th><i class="icon-tags"></i> ID</th>
							<th><i class="icon-user"></i> Name</th>
							<th><i class="icon-envelope"></i> Email</th>
							<th><i class="icon-phone"></i> Phone</th>
						</tr>
					</thead>
					<tbody>
					<? for($i = 0; $i < count($contacts); $i++): ?>
						<tr>
							<td><?=$contacts[$i]['cid']?></td>
							<td><?=$contacts[$i]['name']?></td>
							<td><?=$contacts[$i]['email']?></td>
							<td><?=$contacts[$i]['phone']?></td>
						</tr>
						<? endfor;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="<?=base_url('js/jquery.js')?>"></script>
	<script src="<?=base_url('js/jquery.tablesorter.js')?>"></script>
	<script>
	$(document).ready(function(){
	
		$("#tcontacts").tablesorter();
	
		$(".content").fadeIn(1000);
	});
	</script>
<? $this->load->view('includes/footer'); ?>