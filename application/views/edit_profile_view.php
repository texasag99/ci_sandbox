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
<a class="btn btn-default" href="<?php echo base_url().'Profile'  ?>">View Profile</a> 
<a class="btn btn-default" href="<?php echo base_url().'User/change_password'  ?>">Change My Password</a>

<div class="form-group">
	
	
<?php 
echo form_open('Profile/profile_validation');
echo '<div class="warning" style="color:red;">'.validation_errors().'</div>';

echo "<label for='first'>First Name:</label> ";
echo form_input('first',$first);

echo "<label for='last'>Last Name:</label> ";
echo form_input('last',$last);

echo "<label for='email'>Email:</label> ";
echo form_input(array('name'=>'email','value'=>$email,
     'readonly'=>'readonly')); 

echo "<label for='address1'>Address:</label> ";
echo form_input('address1',$address1);

echo "<label for='address2'>Address 2:</label> ";
echo form_input('address2',$address2);

echo "<label for='address2'>City:</label> ";
echo form_input('city',$city);

echo "<label for='state'>State:</label> ";
echo form_dropdown('state', $statelist, $state);


echo "<label for='zip'>Zip:</label> ";
echo form_input('zip',$zip);

echo "<label for='country'>Country:</label> ";
echo form_dropdown('country',$countries,$country);


echo "<label for='tel'>Direct Tel:</label> ";
echo form_input('tel',$tel);


echo "<label for='mobile'>Mobile:</label> ";
echo form_input('mobile',$mobile);


echo "<label for='fax'>Fax:</label> ";
echo form_input('fax',$fax);


echo "<label for='website'>Website (URL):</label> ";
echo form_input('website',$website);


echo "<label for='email2'>Alternate Email:</label> ";
echo form_input('email2',$email2);

echo "<label for='created'>Created On:</label> ";
echo form_input(array('name'=>'created','value'=>$created,
     'readonly'=>'readonly')); 

echo "<label for='profile_updated'>Last Updated:</label> ";
echo form_input(array('name'=>'profiled_updated','value'=>$profile_updated,
     'readonly'=>'readonly')); 


echo '<br><button type="submit" class="btn btn-primary">Update</button>';

		 
echo form_close();

?>
</div>
</div>
</div>
</div>


