<?php include("header.php"); 
if(ISSET($_SERVER['HTTP_REFERER'])){
	$go_back_url = $_SERVER['HTTP_REFERER'];
}else{ 
    $go_back_url = base_url().'/User/login';
}
?>

<div id="container">
	<h1><?php echo $page_header; ?></h1>

	<div id="body">
	<a href="<?php echo $go_back_url; ?>"><< Go Back!</a>
	 <h3>Please enter a valid email and password!</h3>
	 <p style="max-width:800px; border:1px solid dark-gray; background-color:silver; padding:10px;">
     Please register here. </p>
<table><tbody>
<?php 
echo form_open('User/registration_validation');

echo '<tr><td></td><td><div style="color:red;">'.validation_errors().'</div></td></tr>';

echo "<tr><td style='text-align:right;'>First Name:</td><td> ";
echo form_input('first',$this->input->post('first'));
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Last Name:</td><td> ";
echo form_input('last',$this->input->post('last'));
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Email:</td><td> ";
echo form_input('email',$this->input->post('email'));
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Password:</td><td> ";
echo form_password('password',$this->input->post('password'));
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Confirm Password:</td><td> ";
echo form_password('confirm_password');
echo "</td></tr>";

echo "<tr><td></td><td>";
echo form_submit('login_submit', 'Submit');
echo "</td></tr>";
		 
echo form_close();

?>
</tbody></table>
</div>
</div>

</body>
</html>


