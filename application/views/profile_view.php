<?php include("header.php"); 
if(ISSET($_SERVER['HTTP_REFERER'])){
	$go_back_url = $_SERVER['HTTP_REFERER'];
}else{ 
    $go_back_url = base_url().'/User/login';
}
?>


<h1><?php echo $page_header; ?></h1>

<div id="body">
<a class="btn btn-default" href="<?php echo base_url().'Profile/edit_profile'  ?>">Edit Profile</a> 
<br><br>
<table class="table-condensed">
<tbody class="table-hover">
<tr><td>Email:</td><td>&nbsp;<?php echo $email; ?><td></tr>
<tr><td>Name:</td><td>&nbsp;<?php echo $first." ".$last; ?><td></tr>
<tr><td>Address:</td><td>&nbsp;<?php echo $address1; ?><td></tr>
<tr><td>Address 2:</td><td>&nbsp;<?php echo $address2; ?><td></tr>
<tr><td>City:</td><td>&nbsp;<?php echo $city; ?><td></tr>
<tr><td>State:</td><td>&nbsp;<?php echo $state; ?><td></tr>
<tr><td>Zip:</td><td>&nbsp;<?php echo $zip; ?><td></tr>
<tr><td>Country:</td><td>&nbsp;<?php echo $country; ?><td></tr>
<tr><td>Direct Tel:</td><td>&nbsp;<?php echo $tel; ?><td></tr>
<tr><td>Mobile:</td><td>&nbsp;<?php echo $mobile; ?><td></tr>
<tr><td>Fax:</td><td>&nbsp;<?php echo $fax; ?><td></tr>
<tr><td>Website (URL):</td><td>&nbsp;<a href="<?php echo $website; ?>"><?php echo $website; ?></a><td></tr>
<tr><td>Alternate Email:</td><td>&nbsp;<?php echo $email2; ?><td></tr>
<tr><td>Created On:</td><td>&nbsp;<?php echo $created; ?><td></tr>
<tr><td>Last Updated:</td><td>&nbsp;<?php echo $profile_updated; ?><td></tr>
</tbody>
</table>
<p></p>

</div></div>

</body>
</html>


