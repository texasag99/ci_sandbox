<?php
if(ISSET($_SERVER['HTTP_REFERER'])){
	$go_back_url = $_SERVER['HTTP_REFERER'];
}else{ 
    $go_back_url = base_url().'/User/login';
}
?>

<div id="container" class="container-fluid">
	<h1><?php echo $page_header; ?></h1>

	<div id="body">
	<div id="form_container_500">
	<a class="btn btn-default" href="<?php echo $go_back_url; ?>">Go Back!</a>
	 <h3>Please enter a valid email and password!</h3>
	 <p style="max-width:800px; border:1px solid dark-gray; background-color:silver; padding:10px;">
     Please register here. </p>
<div class="form-group">
<?php 
echo form_open('User/registration_validation');

echo '<div class="warning" style="color:red;">'.validation_errors().'</div>';


echo "<label for='first'>First Name:</label>";
echo form_input('first',$this->input->post('first'));


echo "<label for='last'>Last Name:</label> ";
echo form_input('last',$this->input->post('last'));

$email = array(
              'name'        => 'email',
              'id'          => 'email',
			  'class'		=> 'check-exists',
              'value'       => $this->input->post('email'),
              'data-type'   => 'email'
            );

echo "<div id='control-group'>";
echo "<label for='email'>Email:</label> ";
echo form_input($email);
echo "<div class='warning' style='color:red;'><span class='check-exists-feedback' data-type='email'></span></div>";
echo "</div>";


echo "<label for='password'>Password:</label> ";
echo form_password('password',$this->input->post('password'));

echo "<label for='confirm_password'>Confirm Password:</label> ";
echo form_password('confirm_password');

echo '<br><button type="submit" class="btn btn-primary">Register</button>';
		 
echo form_close();

?>
	<script>
		$('.check-exists').existsChecker();
	</script>
</div><!--form-group-->
</div><!--form container-->
</div>
</div>



