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
<a href="<?php echo $go_back_url; ?>"><< Go Back!</a>
 <h3><?php echo $email; ?></h3>
 <p style="max-width:800px; border:1px solid dark-gray; background-color:silver; padding:10px;">Create New Password:</p>

<table><tbody>
<?php 
$hidden = array('key' => $key , 'email' => $email);

echo form_open('User/fmp_password_validation', '', $hidden);

echo '<tr><td></td><td><div style="color:red;">'.validation_errors().'</div></td></tr>';

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



