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
 <h3>Forgot My Password</h3>
 <p style="max-width:800px; border:1px solid dark-gray; background-color:silver; padding:10px;">Please enter your email:</p>

<div class="form-group"
<?php 
echo form_open('User/fmp_email_validation');

echo '<div class="warning" style="color:red;">'.validation_errors().'</div>';

echo "<label for='email'>Email:</label> ";
echo form_input('email',$this->input->post('email'));

echo '<br><button type="submit" class="btn btn-primary">Submit</button>';
	 
echo form_close();

?>

</div><!--form-group-->
</div><!--form container-->
</div>
</div>



