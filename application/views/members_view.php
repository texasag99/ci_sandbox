<?php include("header.php"); ?>

<div id="container">
	<h1><?php echo $page_header; ?></h1>

	<div id="body">
	 

<?php 
	echo "<pre>";
	print_r ($this->session->all_userdata());
	echo "</pre>";

?>
</div>
</div>

</body>
</html>


