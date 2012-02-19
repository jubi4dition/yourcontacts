<?php $this->load->view('includes/header'); ?>

<div class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?php echo site_url('site');?>">Your Contacts</a>
			<ul class="nav">
				<li><?php echo anchor('site/add', 'Add');?></li>
				<li><?php echo anchor('site/delete', 'Delete');?></li>
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
			<?php  
			for($i=0; $i < count($contacts); $i++){
				echo "<tr>\n";
				echo "<td>".$i."</td>\n";
				echo "<td>".$contacts[$i]->name."</td>\n";
				echo "<td>".$contacts[$i]->email."</td>\n";
				echo "<td>".$contacts[$i]->phone."</td>\n";
				echo "</tr>";
			}
			?>
			</tbody>
			</table>
			</div>
		</div>
			
	</div>
<?php $this->load->view('includes/footer'); ?>