<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?=site_url('site')?>"><img src="<?=base_url('css/img/yourcontacts.png')?>" width="57px"/></a>
			<ul class="nav">
				<li <? if($active == "add") echo "class=\"active\""?>><?=anchor('site/add', 'Add')?></li>
				<li <? if($active == "delete") echo "class=\"active\""?>><?=anchor('site/delete', 'Delete')?></li>
				<li <? if($active == "edit") echo "class=\"active\""?>><?=anchor('site/edit', 'Edit')?></li>
			</ul>
			<div class="pull-right">
				<small class="navbar-text">User: <?=anchor('site/profile', $this->session->userdata('email'))?> </small>
				<a href="<?=site_url('login/logout')?>" class="btn btn-primary"><i class="icon-road icon-white"></i> Logout</a>
			</div>
		</div>
	</div>
</div>
