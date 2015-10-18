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
<?php
if(isset($required) && !empty($required)){echo $required;}
?>
<p></p>

 <h3>Please enter a new password!</h3>
 <p style="max-width:800px; border:1px solid dark-gray; background-color:silver; padding:10px;"></p>

<table><tbody>
<?php 
echo form_open('User/password_validation');

echo '<div class="warning" style="color:red;">'.validation_errors().'</div>';

echo "<label for='current_password'>Current Password:</label> ";
echo form_password('current_password',$this->input->post('current_password'));


echo "<label for='password'>Password:</label> ";
echo form_password('password',$this->input->post('password'));


echo "<label for='confirm_password'>Confirm Password:</label> ";
echo form_password('confirm_password');

echo '<br><a class="btn btn-warning" href="'.$go_back_url.'">Go Back</a>&nbsp;';
echo '<button type="submit" class="btn btn-primary">Update</button>';

		 
echo form_close();

?>
</div><!--container-->
</div><!--body-->
</div>
</div>


