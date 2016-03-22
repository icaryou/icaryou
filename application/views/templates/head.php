<!-- En HTML5 no hay DTD asociado -->
<!DOCTYPE html >
<html>
<head>
	<meta charset="utf-8">
	<!--<?= link_tag('assets/css/main.css') ?>-->	



	
	<link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap-theme.min.css">	
	<script src="<?= base_url();?>assets/js/jquery-2.1.3.js"></script>
	<script src="<?= base_url();?>assets/js/jquery.validate.min.js"></script>
	<script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
	<style>
		input.error 
		{
	    	color: red;
	    	border:solid 1px red;
		}
		
		input.valid 
		{
	    	border:solid 1px green;
		}
		#formularioRegistro .error
		{
			color:red;
		}
		
		
		/* Menús */
nav ul#navigation {
	margin: 0px auto;
	position: relative;
	float: left;
	border-left: 1px solid #c4dbe7;
	border-right: 1px solid #c4dbe7;
}

nav ul#navigation li {
	display: inline;
	font-size: 12px;
	font-weight: bold;
	margin: 0;
	padding: 0;
	float: left;
	position: relative;
	border-top: 1px solid #c4dbe7;
	border-bottom: 2px solid #c4dbe7;
}

nav ul#navigation li a {
	padding: 10px 25px;
	color: #616161;
	text-shadow: 1px 1px 0px #fff;
	text-decoration: none;
	display: inline-block;
	border-right: 1px solid #fff;
	border-left: 1px solid #C2C2C2;
	border-top: 1px solid #fff;
	background: #f5f5f5;
	-webkit-transition: color 0.2s linear, background 0.2s linear;
	-moz-transition: color 0.2s linear, background 0.2s linear;
	-o-transition: color 0.2s linear, background 0.2s linear;
	transition: color 0.2s linear, background 0.2s linear;
}

nav ul#navigation li a:hover {
	background: #f8f8f8;
	color: #282828;
}

nav ul#navigation li a.first {
	border-left: 0 none;
}

nav ul#navigation li a.last {
	border-right: 0 none;
}

nav ul#navigation li:hover>a {
	background: #fff;
}

/* Drop-Down Navigation */
nav ul#navigation li:hover>ul {
	/*these 2 styles are very important, 
being the ones which make the drop-down to appear on hover */
	visibility: visible;
	opacity: 1;
}

nav ul#navigation ul, nav ul#navigation ul li ul {
	list-style: none;
	margin: 0;
	padding: 0;
	/*the next 2 styles are very important, 
being the ones which make the drop-down to stay hidden */
	visibility: hidden;
	opacity: 0;
	position: absolute;
	z-index: 99999;
	width: 180px;
	background: #f8f8f8;
	box-shadow: 1px 1px 3px #ccc;
	/* css3 transitions for smooth hover effect */
	-webkit-transition: opacity 0.2s linear, visibility 0.2s linear;
	-moz-transition: opacity 0.2s linear, visibility 0.2s linear;
	-o-transition: opacity 0.2s linear, visibility 0.2s linear;
	transition: opacity 0.2s linear, visibility 0.2s linear;
}

nav ul#navigation ul {
	top: 43px;
	left: 1px;
}

nav ul#navigation ul li ul {
	top: 0;
	left: 181px; /* strong related to width:180px; from above */
}

nav ul#navigation ul li {
	clear: both;
	width: 100%;
	border: 0 none;
	border-bottom: 1px solid #c9c9c9;
}

nav ul#navigation ul li a {
	background: none;
	padding: 7px 15px;
	color: #616161;
	text-shadow: 1px 1px 0px #fff;
	text-decoration: none;
	display: inline-block;
	border: 0 none;
	float: left;
	clear: both;
	width: 150px;
}
	
	</style>
	
	
	
	
</head>
<body>