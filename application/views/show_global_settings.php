<div id="container" class="container-fluid">
<div id="body">
<h1><?php echo $page_header; ?></h1>
<a href='<?php echo base_url()."Config/set_defaults"; ?>' desc='Resets the below values to their original default settings' class="btn btn-default">Reset Default Settings</a> &nbsp;&nbsp;


<br><br>
<?php

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
		echo "<td class='setting_value'><a href='#' class='editable' id='from_email' data-type='text' name='from_email' data-url='".base_url()."Config/postValue/1/from_email' data-pk='1' data-title='Enter a valid email'>".$results['from_email']."</a></td></tr>";
		echo "<tr><td class='setting align_right'><strong>Administrator Name (or Title):</strong><br>The name or title of the individual used on outgoing emails.</td>";
		echo "<td class='setting_value'><a href='#' class='editable' id='from_name' data-type='text' name='from_name' data-url='".base_url()."Config/postValue/1/from_name' data-pk='1' data-title='Enter the administrator name or title'>".$results['from_name']."</a></td></tr>";
		echo "<tr><td class='setting align_right'><strong>Retry Limit:</strong><br>The number of allowed password retries. Once exceeded the users account is locked. </td>";
		echo "<td class='setting_value'><a href='#' class='editable' id='retry_limit' data-type='text' name='retry_limit' data-url='".base_url()."Config/postValue/1/retry_limit' data-pk='1' data-title='Enter a limit'>".$results['retry_limit']."</a></td></tr>";
		echo "<tr><td class='setting align_right'><strong>Default Pagination:</strong><br>For pages where tables are paginated. This sets the default number of rows to be displayed when first viewing the page.</td>";
		echo "<td class='setting_value'><a href='#' class='editable' id='default_pagination' data-type='text' name='default_pagination' data-url='".base_url()."Config/postValue/1/default_pagination' data-pk='1' data-title='Enter the default number of rows to paginate'>".$results['default_pagination']."</a></td></tr>";
		
	?>
</tbody>

</div><!--body-->
</div><!--container-->
