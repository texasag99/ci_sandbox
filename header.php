<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<link rel="shortcut icon" href="<?php echo base_url().'favicon.ico';?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'styles/style.css';?>"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url().'javascript/my_javascript.js';?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'javascript/bootbox.js';?>"></script>
</head>
<body>
<div id="header">
<p id="title"><?php echo APPLICATION_TITLE; ?> <span class="version_number">Version <?php  echo APPLICATION_VERSION; ?></span></p>
</div>

<!-- Static navbar-->
<nav role="navigation" class="navbar navbar-default">
  <div class="container-fluid">
	 <div class="navbar-header">
		 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
		 <a class="navbar-brand" href="#"><?php echo APPLICATION_TITLE; ?> <span class="version_number">Version <?php  echo APPLICATION_VERSION; ?></a>
	  </div><!--navbar-header-->
     <div class="navbar-collapse collapse">		 
    <?php if ($this->session->userdata('is_logged_in')){ ?> 
	  <ul class ="nav navbar-nav nav-default">
		  <li class="dropdown"><a class"dropdown-toggle" data-toggle="dropdown" href="#">Admin<span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
			  <li><a href="<?php echo base_url().'Roles';?>">Roles</a></li>
			  </ul>
		  </li>
	  </ul><?php }else{ echo "  ";}?>		 
	  <ul class="nav navbar-nav navbar-right">
			 <?php if ($this->session->userdata('is_logged_in')){ 
				echo"<li><a href='".base_url()."Profile'>".$this->session->userdata('name')."</a></li>";
				echo"<li><a href='".base_url()."User/logout'><span class='glyphicon glyphicon-off'></span> Logout</a></li>";
				}else{
				?>
			 <li><a href="<?php echo base_url().'User/login' ?>"><span class="glyphicon glyphicon-off"></span> Login</a></li>
			 <?php
				}
			 ?>
      </ul>
	  
    </div><!--navbar-collapse collapse-->
  </div><!--container-fluid-->
</nav><!--navbar navbar-default -->	
<div id="container" class="container-fluid">
	



