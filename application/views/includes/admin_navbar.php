<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?=site_url('admin')?>"><img src="<?=base_url('css/img/yourcontacts.png')?>" width="57px"/></a>
			<ul class="nav">
				<li class="divider-vertical"></li>
				<li <? if($active == "add") echo "class=\"active\""?>><?=anchor('admin/add', 'Add')?></li>
				<li class="divider-vertical"></li>
				<li <? if($active == "delete") echo "class=\"active\""?>><?=anchor('admin/delete', 'Delete')?></li>
				<li class="divider-vertical"></li>
				<li <? if($active == "edit") echo "class=\"active\""?>><?=anchor('admin/edit', 'Edit')?></li>
				<li class="divider-vertical"></li>
			</ul>
			<div class="pull-right">
				<small class="navbar-text">Admin: <?=anchor('admin/profile', $this->session->userdata('admin'))?> </small>
				<a href="<?=site_url('adminlogin/logout')?>" class="btn btn-primary"><i class="icon-road icon-white"></i> Logout</a>
			</div>
		</div>
	</div>
</div>
