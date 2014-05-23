<?php include("header.php"); ?>

<div id="container">
	<h1><?php echo $page_header; ?></h1>

	<div id="body">

<table class="field_table">
<tbody>
<tr><td class="align_right field_header">Email:</td><td class="field_value">&nbsp;<?php echo $email; ?><td></tr>
<tr><td class="align_right field_header">Name:</td><td class="field_value">&nbsp;<?php echo $first." ".$last; ?><td></tr>
<tr><td class="align_right field_header">Address:</td><td class="field_value">&nbsp;<?php echo $address1; ?><td></tr>
<tr><td class="align_right field_header">Address 2:</td><td class="field_value">&nbsp;<?php echo $address2; ?><td></tr>
<tr><td class="align_right field_header">City:</td><td class="field_value">&nbsp;<?php echo $city; ?><td></tr>
<tr><td class="align_right field_header ">State:</td><td class="field_value">&nbsp;<?php echo $state; ?><td></tr>
<tr><td class="align_right field_header">Zip:</td><td class="field_value">&nbsp;<?php echo $zip; ?><td></tr>
<tr><td class="align_right field_header">Country:</td><td class="field_value">&nbsp;<?php echo $country; ?><td></tr>
<tr><td class="align_right field_header">Direct Tel:</td><td class="field_value">&nbsp;<?php echo $tel; ?><td></tr>
<tr><td class="align_right field_header">Mobile:</td><td class="field_value">&nbsp;<?php echo $mobile; ?><td></tr>
<tr><td class="align_right field_header">Fax:</td><td class="field_value">&nbsp;<?php echo $fax; ?><td></tr>
<tr><td class="align_right field_header">Website (URL):</td><td class="field_value">&nbsp;<a href="<?php echo $website; ?>"><?php echo $website; ?></a><td></tr>
<tr><td class="align_right field_header">Alternate Email:</td><td class="field_value">&nbsp;<?php echo $email2; ?><td></tr>
<tr><td class="align_right field_header">Created On:</td><td class="field_value">&nbsp;<?php echo $profile_created; ?><td></tr>
<tr><td class="align_right field_header">Last Updated:</td><td class="field_value">&nbsp;<?php echo $profile_updated; ?><td></tr>
</tbody>
</table>
<p></p>

<a href="<?php echo base_url().'User/logout'  ?>">Logout</a>
</div></div>

</body>
</html>


