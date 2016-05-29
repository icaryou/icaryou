<!DOCTYPE html>
<html>
<head>
	
	
	<meta charset="utf-8">
  <title>I Car You - Encuentra tu trayecto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">


    <!-- CSS
    ============================================================-->
	<link href="<?= base_url();?>assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/css/style.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/css/formularios.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/css/jquery-ui.css" rel="stylesheet" >
	<link href="<?= base_url();?>assets/css/tooltipster.css" rel="stylesheet" >
	<link href="<?= base_url();?>assets/css/simplePagination.css" rel="stylesheet" >
	
	
	 <!--Font-->
    <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600' rel='stylesheet' type='text/css'> -->
    <link href="<?= base_url();?>assets/css/googleFonts.css" rel="stylesheet" >

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">



    <!-- SCRIPT
    ============================================================-->
    <!-- <script src="http://code.jquery.com/jquery.js"></script> -->
    <script src="<?= base_url();?>assets/js/jquery-2.1.3.js"></script>
    <script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url();?>assets/js/jquery.validate.min.js"></script>
    <script src="<?= base_url();?>assets/js/additional-methods.min.js"></script>
    <!-- <script src="<?= base_url();?>assets/resources/municipios.js"></script> -->
    <script src="<?= base_url();?>municipios/cargarMunicipios"></script>
    <script src="<?= base_url();?>assets/js/jquery-ui.js"></script>
    <script src="<?= base_url();?>assets/js/jquery.tooltipster.min.js"></script>
    <script src="<?= base_url();?>assets/js/loginDiv.js"></script>
    <script src="<?= base_url();?>assets/js/bootstrap-paginator.js"></script>






	<!-- 
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     -->
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
.flexigrid
{
	width:95% !important;
	margin:0 auto;
}

</style>
</head>
<body>


	<!--HEADER ROW-->
	<div id="header-row">
		<div class="container">
			<div class="row">
				<!--LOGO-->
				<div class="span3">
					<a class="brand" href="<?= base_url();?>"><img
						src="<?= base_url();?>assets/img/logo.png" /></a>
				</div>
				<!-- /LOGO -->

				
			</div>
		</div>
	</div>
	<!-- /HEADER ROW -->
	<div>
		<a href='<?php echo base_url()?>admin_app/index/usuario'>Usuarios</a> |
		<a href='<?php echo base_url()?>admin_app/index/trayecto'>Trayecto</a> |
		<a href='<?php echo base_url()?>admin_app/index/usuariotrayecto'>Usuario-trayecto</a> |
		<a href='<?php echo base_url()?>admin_app/index/lugar'>Lugar</a> |
		<a href='<?php echo base_url()?>admin_app/index/conversacion'>Conversacion</a> |
		<a href='<?php echo base_url()?>admin_app/index/mensaje'>Mensaje</a> |		
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>

<footer>
    <div class="container">
      <div class="row">
        <div class="span6">Copyright 2013 Shapebootstrap | All Rights Reserved  <br>
        <small>Aliquam tincidunt mauris eu risus.</small>
        </div>
        <div class="span6">
            <div class="social pull-right">
                <a href="#"><img src="<?= base_url();?>assets/img/social/googleplus.png" alt=""></a>
                <a href="#"><img src="<?= base_url();?>assets/img/social/dribbble.png" alt=""></a>
                <a href="#"><img src="<?= base_url();?>assets/img/social/twitter.png" alt=""></a>
                <a href="#"><img src="<?= base_url();?>assets/img/social/dribbble.png" alt=""></a>
                <a href="#"><img src="<?= base_url();?>assets/img/social/rss.png" alt=""></a>
            </div>
        </div>
      </div>
    </div>
</footer>
</html>
