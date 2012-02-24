<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Your Contacts</title>
<meta name="description" content="">
<meta name="author" content="yubi4dition">

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<!-- Le styles -->
<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet" type="text/css" />
<style type="text/css">
/* Override some defaults */
html,body {
	background-color: #eee;
}
.container>footer p {
	text-align: center; /* center align it with the container */
}

.container {
	width: 820px;
	/* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
}

/* The white background content wrapper */
.content {
	background-color: #fff;
	padding: 20px;
	margin: 0 0px 15px;
	/* negative indent the amount of the padding to maintain the grid system */
	-webkit-border-radius: 0 0 6px 6px;
	-moz-border-radius: 0 0 6px 6px;
	border-radius: 0 0 6px 6px;
	-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .15);
	-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .15);
	box-shadow: 0 1px 2px rgba(0, 0, 0, .15);
}

/* Page header tweaks */
.page-header {
	background-color: #f5f5f5;
	padding: 20px 20px 10px;
	margin: -20px -20px 20px;
}

/* Styles you shouldn't keep as they are for displaying this base example only */
.content .span7,.content {
	min-height: 350px;
}
/* Give a quick and non-cross-browser friendly divider */
.content {
	margin-left: 0;
	padding-left: 19px;
	border-left: 1px solid #eee;
}
</style>

<!-- Le fav and touch icons -->
<link href="<?php echo base_url('css/ico/favicon.ico');?>" rel="shortcut icon" />

</head>

<body>