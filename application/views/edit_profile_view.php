<?php include("header.php"); ?>

<div id="container">
	<h1><?php echo $page_header; ?></h1>

	<div id="body">

<table class="form_table">
<tbody>
<?php 
echo form_open('User/edit_profile_validation');

echo '<tr><td></td><td><div style="color:red;">'.validation_errors().'</div></td></tr>';

echo "<tr><td style='text-align:right;'>First Name:</td><td> ";
echo form_input('first',$first);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Last Name:</td><td> ";
echo form_input('last',$last);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Email:</td><td> ";
echo form_input('email', $email);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Password:</td><td> ";
echo form_password('password');
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Confirm Password:</td><td> ";
echo form_password('confirm_password');
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Address:</td><td> ";
echo form_input('address1',$address1);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Address 2:</td><td> ";
echo form_input('address2',$address2);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>City:</td><td> ";
echo form_input('city',$city);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>State:</td><td> ";
echo form_input('state',$state);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Zip:</td><td> ";
echo form_input('zip',$zip);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Country:</td><td> ";
echo form_input('country',$country);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Direct Tel:</td><td> ";
echo form_input('tel',$tel);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Mobile:</td><td> ";
echo form_input('mobile',$mobile);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Fax:</td><td> ";
echo form_input('fax',$fax);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Website (URL):</td><td> ";
echo form_input('website',$website);
echo "</td></tr>";

echo "<tr><td style='text-align:right;'>Alternate Email:</td><td> ";
echo form_input('email2',$email2);
echo "</td></tr>";

echo'<tr><td class="align_right field_header">Created On:</td><td class="field_value">&nbsp;'.$profile_created.'<td></tr>';
echo'<tr><td class="align_right field_header">Last Updated:</td><td class="field_value">&nbsp;'.$profile_updated.'<td></tr>';

echo "<tr><td></td><td>";
echo form_submit('login_submit', 'Submit');
echo "</td></tr>";
		 
echo form_close();

?>
</tbody>
</table>
<p></p>

<a href="<?php echo base_url().'User/logout'  ?>">Logout</a>
</div></div>

</body>
</html>


