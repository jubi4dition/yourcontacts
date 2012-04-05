<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/admin_navbar', array('active' => 'no')); ?>
<div class="container">
	<div class="content">
		<div class="page-header">
			<h1>Your Users</h1>
		</div>
		<div class="row">
			<div class="span9">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><i class="icon-tags"></i></th>
							<th><i class="icon-envelope"></i> Email</th>
							<th><i class="icon-list-alt"></i> Contacts</th>
						</tr>
					</thead>
					<tbody>
					<? for($i = 0; $i < count($users); $i++): ?>
						<tr>
							<td><?=$i?></td>
							<td><?=$users[$i]['email']?></td>
							<td><?=$users[$i]['contacts']?></td>
						</tr>
						<? endfor;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<? $this->load->view('includes/footer'); ?>