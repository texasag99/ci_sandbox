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
<a href="<?php echo $go_back_url; ?>"><< Go Back!</a>
 <h3><?php echo $email; ?></h3>
 <p style="max-width:800px; border:1px solid dark-gray; background-color:silver; padding:10px;">Create New Password:</p>


<?php 
$hidden = array('key' => $key , 'email' => $email);

echo form_open('User/fmp_password_validation', '', $hidden);

echo '<div class="warning" style="color:red;">'.validation_errors().'</div>';

echo "<label for='email'>Password:</label> ";
echo form_password('password', $this->input->post('password'));

echo "<label for='email'>Confirm Password:</label> ";
echo form_password('confirm_password');

echo '<br><button type="submit" class="btn btn-primary">Submit</button>';
	 		 
echo form_close();

?>

</div>
</div>



