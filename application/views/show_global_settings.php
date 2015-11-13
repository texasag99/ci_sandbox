<div id="container" class="container-fluid">
<div id="body">
<h1><?php echo $page_header; ?></h1>
<?php if($allow_edit){
echo "<a href='#' id='restore_default' desc='Resets the below values to their original default settings' class='btn btn-default'>Restore Default Settings</a> &nbsp;&nbsp;";
 } ?>

<br><br>
<?php
if ($results['allow_registration'] == 0){
		   $allow_registration= "No";
		}else{
			$allow_registration= "Yes";
			}
?>


<table class="table">
<thead><tr class="active">
<th class='setting align_right'>
Setting Description
</th>
<th class='setting_value'>
Setting Value
</th>
</thead>
<tbody class="table-hover">
	<?php	
		echo "<tr><td class='setting align_right'><strong>Administrator Email:</strong><br>This is the administrator email for the application. Used to send and receive administrative emails</td>";
		echo "<td class='setting_value'>";
		if($allow_edit){echo"<a href='#' class='editable' id='from_email' data-type='text' name='from_email' data-url='".base_url()."Config/postValue/1/from_email' data-pk='1' data-title='Enter a valid email'>".$results['from_email']."</a></td></tr>";
		}else{ 
		echo $results['from_email']."</td></tr>";}
		echo "<tr><td class='setting align_right'><strong>Administrator Name (or Title):</strong><br>The name or title of the individual used on outgoing emails.</td>";
		echo "<td class='setting_value'>";
		if($allow_edit){ echo"<a href='#' class='editable' id='from_name' data-type='text' name='from_name' data-url='".base_url()."Config/postValue/1/from_name' data-pk='1' data-title='Enter the administrator name or title'>".$results['from_name']."</a></td></tr>";
		}else{ 
		echo $results['from_name']."</td></tr>";}
		echo "<tr><td class='setting align_right'><strong>Password Retry Limit:</strong><br>The number of allowed password retries. Once exceeded the user's account is locked. </td>";
		echo "<td class='setting_value'>";
		if($allow_edit){echo"<a href='#' class='editable' id='retry_limit' data-type='text' name='retry_limit' data-url='".base_url()."Config/postValue/1/retry_limit' data-pk='1' data-title='Enter a limit'>".$results['retry_limit']."</a></td></tr>";
		}else{ 
		echo $results['retry_limit']."</td></tr>";}
		echo "<tr><td class='setting align_right'><strong>Default Pagination:</strong><br>For pages where tables are paginated. This sets the default number of rows to be displayed when first viewing the page.</td>";
		echo "<td class='setting_value'>";
		if($allow_edit){echo"<a href='#' class='editable' id='default_pagination' data-type='text' name='default_pagination' data-url='".base_url()."Config/postValue/1/default_pagination' data-pk='1' data-title='Enter the default number of rows to paginate'>".$results['default_pagination']."</a></td></tr>";
		}else{ 
		echo $results['default_pagination']."</td></tr>";}
		echo "<tr><td class='setting align_right'><strong>Days to Require Password Change:</strong><br> The number of days elapsed before requiring each user to change their password <em>(set to 0 to disable)</em>: </td>";
		echo "<td class='setting_value'>";
		if($allow_edit){echo"<a href='#' class='editable' id='reset_pwd_days' data-type='text' name='reset_pwd_days' data-url='".base_url()."Config/postValue/1/reset_pwd_days' data-pk='1' data-title='Enter the number of days to elapse before requiring password change (set 0 to disable)'>".$results['reset_pwd_days']."</a></td></tr>";
		}else{ 
		echo $results['reset_pwd_days']."</td></tr>";}      
      echo "<tr><td class='setting align_right'><strong>Anyone Can Register:</strong><br>  Enable or disable whether the application will allow open registration for new users.</td>";
	   echo "<td class='setting_value'>";
	   if($allow_edit){echo"<a href='#' class='register_editable' id='allow_registration' data-type='select' name='allow_registration' data-url='".base_url()."Config/postValue/1/allow_registration' data-pk='1' data-title=' Set the value to either YES or NO '>".$allow_registration."</a></td></tr>";	
		}else{ 
		echo $allow_registration."</td></tr>";}  	
		echo "<tr><td class='setting align_right'><strong>Kill All Sessions:</strong><br> Kill all currently active user sessions. This will force all users to log off the system.</td>";
		echo "<td class='setting_value'>";
		if($allow_edit){echo"<a href='#' class='btn btn-warning' id='kill_all_sessions' style='margin:1px;'>Kill All Sessions</a></td></tr>";
		}else{ 
		echo "<a href='#' class='btn btn-default disabled' Alt='Disabled'>Kill All Sessions</a></td></tr>";}  	
	?>
</tbody>
<script>			
		$(function(){ 
			$('.register_editable').editable({
				value: "<?php echo $results['allow_registration']; ?>", 
				source: [ 
					{value: '0', text: 'No'}, 
					{value: '1', text: 'Yes'} ]  
			});  
		});   
</script>
<?php //below is the script for the pop-up dialog box to confirm.
echo "<script>$('#kill_all_sessions').click(function(){";
echo "bootbox.dialog({title:\"Confirm Kill Sessions\", message:\"<p style='text-align:center'>Are you sure?<br>";
echo "<br><a class='btn btn-warning' href='".base_url()."Config/kill_all_sessions'>Kill Sessions</a></p>\"}); });</script>";
?>
<?php //below is the script for the pop-up dialog box to confirm.
echo "<script>$('#restore_default').click(function(){";
echo "bootbox.dialog({title:\"Restore Default Settings\", message:\"<p style='text-align:center'>Are you sure?<br>";
echo "<br><a class='btn btn-primary' href='".base_url()."Config/restore_default'>Restore</a></p>\"}); });</script>";
?>

</div><!--body-->
</div><!--container-->
