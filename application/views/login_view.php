<div id="container" class="container-fluid">
<h1><?php echo $page_header; ?></h1>

<div id="body">
<div id="login_container">
<?php if($allow_registration){?>
<a href='<?php echo base_url()."User/registration"; ?>' class="btn btn-default">Register</a> &nbsp;&nbsp;
<?php } ?>
<a href='<?php echo base_url()."User/forgot_my_password"; ?>' class="btn btn-default">Forgot My Password</a>
<h3>Please enter your email and password!</h3>
<div class="form-group">
<p style="max-width:100%; border:1px solid dark-gray; background-color:silver; padding:10px;">
Please login here. </p>

<?php 
echo form_open('User/login_validation');
echo '<div class="warning" style="color:red;">'.validation_errors().'</div>';
echo "<label for='email'>Email:</label>";
echo form_input('email',$this->input->post('email'));
echo "<label for='password'>Password:</label>";
echo form_password('password');
echo '<br><button type="submit" class="btn btn-primary">Login</button>';
echo form_close();

?>
</div><!--container-->
</div><!--body-->
</div>
</div>


