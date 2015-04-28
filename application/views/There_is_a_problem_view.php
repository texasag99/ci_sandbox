<?php
if(ISSET($_SERVER['HTTP_REFERER'])){
	$go_back_url = $_SERVER['HTTP_REFERER'];
}else{ 
    $go_back_url = base_url().'User/login';
}
?>
<div id="container" class="container-fluid">
<h1><?php echo $page_header; ?></h1>

<div id="body">
	<a class="btn btn-default" href="<?php echo $go_back_url; ?>">Go Back!</a>
   <p></p>
	<div class="panel panel-danger">
  <div class="panel-heading">ERROR!
	</div>
  <div class="panel-body">
   <span class="glyphicon glyphicon-exclamation-sign" style="font-size:24px; color:maroon;"></span>
  <?php echo $error_message ?> 
  </div>
</div><!--panel panel-warning-->
<p></p>
</div>



