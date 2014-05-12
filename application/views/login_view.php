<?php include("header.php"); ?>

<div id="container">
	<h1><?php echo $page_header; ?></h1>

	<div id="body">
	 <h3>Please enter your email and password!</h3>
	 <p style="max-width:800px; border:1px solid dark-gray; background-color:silver; padding:10px;">
     Please login here. </p>

<?php 
echo form_open('main/checkLogin');

echo '<div style="color:red;">'.validation_errors().'</div>';

echo "<p>Email: ";
echo form_input('email');
echo "</p>";

echo "<p>Password: ";
echo form_password('password');
echo "</p>";

echo "<p>";
echo form_submit('login_submit', 'Login');
echo "</p>";
		 
echo form_close();

?>
</div>
</div>

</body>
</html>


