<? $this->load->view('includes/header'); ?>
<div class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?=site_url('site')?>">Your Contacts</a>
			<ul class="nav">
				<li><?=anchor('site/add', 'Add')?></li>
				<li><?=anchor('site/delete', 'Delete')?></li>
				<li><?=anchor('site/edit', 'Edit')?></li>
			</ul>
			<div class="pull-right">
				<small class="navbar-text">User: <?=anchor('site/profile', $this->session->userdata('email'))?></small>
				<a href="<?=site_url('site/logout')?>" class="btn btn-primary"> <i class="icon-road icon-white"></i> Logout</a>
			</div>
		</div>
	</div>
</div>
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
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
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