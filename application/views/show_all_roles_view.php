<?php include("header.php"); ?>

<div id="body">
<h1><?php echo $page_header; ?></h1>
<a href='<?php echo base_url()."Roles/add"; ?>' class="btn btn-default">Add Role</a> &nbsp;&nbsp;


<table class="table">
<thead>
	<tr><th class='role_column'>Role</th>
		<th class='role_description_column'>Description</th>
		<th class='role_created_column'>Created On</th>
		<th class='role_updated_column'>Last Updated</th>
		<th class='role_status_column'>Status</th>
		<th class='edit_button_column'></th>
	</tr>
</thead>
<tbody class="table-hover">
	<?php
	foreach ($results as $data){
		echo"<tr><td class='role_column'><a href='#' class='editable' id='role' data-type='text' name='role' data-pk='".$data->id."' data-url='".base_url()."Roles/postValue/".$data->id."/role' data-title='Enter Role name'>".$data->role."</a></td>";
		echo"<td class='role_description_column'><a href='#' class='editable' id='description' data-type='text' name='description' data-pk='".$data->id."' data-url='".base_url()."Roles/postValue/".$data->id."/description' data-title='Enter Description'>".$data->description."</a></td>";
		echo"<td class='role_created_column'>".date('m-d-Y', strtotime($data->created))."</td>";
		echo"<td class='role_updated_column'>".date('m-d-Y', strtotime($data->last_updated))."</td>";
		echo"<td class='role_status_column'><a href='#' id='status' class='status_editable' data-type='select' name='status' data-pk='".$data->id."' data-url='".base_url()."Roles/postValue/".$data->id."/status' data-title='Select Status'>".$data->status."</a></td>";
		?>
	<script>
		$(function(){ 
			$('.status_editable').editable({
				value: "<?php echo $data->status; ?>", 
				source: [ 
					{value: 'ACTIVE', text: 'ACTIVE'}, 
					{value: 'INACTIVE', text: 'INACTIVE'} ]  
			});  
		});   
	
	</script>
	<?php
		echo"<td><a href='".base_url()."Roles/editRole/".$data->id."' class='btn btn-default' id='edit_role".$data->id."' style='margin:1px;'><span class='glyphicon glyphicon-edit' style='font-size:16px;'></span></a>";
		echo"<a href='#' class='btn btn-default' id='delete_role".$data->id."' style='margin:1px;'><span class='glyphicon glyphicon-remove' style='font-size:16px;'></span></a></td></tr>";
		//below is the script for the pop-up dialog box to confirm the item delete.
		echo"<script>$('#delete_role".$data->id."').click(function(){bootbox.dialog({title:\"Confirm Deletion\", message:\"<p style='text-align:center'>Are you sure?<br><br><a class='btn btn-warning' href='".base_url()."Roles/delete/".$data->id."'>Delete</a></p>\"}); });</script>";
	}
	?>
</tbody>
</table>
	<?php if(isset($links)){ echo "<div id='page_links'>".$links."&nbsp;";?>
	 <div class="btn-group">
       <button class="btn">Per page: <strong><?php echo $per_page; ?></strong></button>
		 <button class="btn dropdown-toggle" data-toggle="dropdown">
         <span class="caret"></span>
       </button>
		 <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
<li><a tabindex="-1" href="<?php echo base_url().'Roles/show_all_roles_paginated/0/10/0'?>">10</a></li>
<li><a tabindex="-1" href="<?php echo base_url().'Roles/show_all_roles_paginated/0/20/0'?>">20</a></li>
<li><a tabindex="-1" href="<?php echo base_url().'Roles/show_all_roles_paginated/0/50/0'?>">50</a></li>
<li><a tabindex="-1" href="<?php echo base_url().'Roles/show_all_roles_paginated/0/100/0'?>">100</a></li>		
		 </ul></br></br>
		 
      </div>
     <?php } ?>

</div><!--body-->
</div><!--container-->
</body>
</html>