<?php include("header.php"); ?>

<div id="container">
	<h1><?php echo $page_header; ?></h1>

<div id="body">
 <p style="max-width:800px; border:1px solid dark-gray; background-color:silver; padding:10px;">
  <?php echo $error_message ?> </p>
 <p><a href='<?php echo base_url()."User/login"; ?>'>Return to login</a>
</p>
</div>
</div>

</body>
</html>


