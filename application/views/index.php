<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/navbar', array('active' => "no")); ?>
<div class="container">
	<div class="content">
		<div class="page-header">
			<h1>Your Contacts</h1>
		</div>
		<div class="row">
			<div class="span9">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><i class="icon-tags"></i></th>
							<th><i class="icon-user"></i> Name</th>
							<th><i class="icon-envelope"></i> Email</th>
							<th><i class="icon-headphones"></i> Phone</th>
						</tr>
					</thead>
					<tbody>
					<? for($i = 0; $i < count($contacts); $i++): ?>
						<tr>
							<td><?=$i?></td>
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
<? $this->load->view('includes/footer'); ?>
