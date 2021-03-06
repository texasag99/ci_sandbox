<div id="container" class="container-fluid">
<div id="body">
<h1><?php echo $page_header; ?></h1>
<?php if($allow_add){
	echo "<a href='".base_url()."UserAdmin/add' class='btn btn-default'>Add User</a> &nbsp;&nbsp;";
}
?>
<a href='<?php echo base_url()."UserAdmin"; ?>' class="btn btn-warning">Hide Inactive </a> 

<br>
<?php   
if(isset($message) && !empty($message)){
echo "<p>$message</p>";
}
?>
<br>
<table class="table">
<thead>
	<tr class="active"><th class='user_column'>
  <?php if($sort_by == 1){
		  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/2/0/".$per_page."/0'>User  <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 2){
		  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/1/0/".$per_page."/0'>User  <span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		 	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/1/0/".$per_page."/0'>User</a>";
  		}?>
	</th>
		<th class='user_email_column'>
		 <?php if($sort_by == 3){
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/4/0/".$per_page."/0'>Email  <span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 4){
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/3/0/".$per_page."/0'>Email <span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/3/0/".$per_page."/0'>Email</a>";
  		}?>
		</th>
		<th class='user_status_column'>
		 <?php if($sort_by == 5){
		  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/6/0/".$per_page."/0'>Status  <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 6){
		  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/5/0/".$per_page."/0'>Status  <span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/5/0/".$per_page."/0'>Status </a>";
  		}?>		
		</th>
		<th class='user_locked_column'>
		<?php if($sort_by == 7){
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/8/0/".$per_page."/0'>Locked <span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 8){
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/7/0/".$per_page."/0'>Locked <span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/7/0/".$per_page."/0'>Locked </a>";
  		}?>
		</th>
		<th class='user_created_column'>
		<?php if($sort_by == 9){
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/10/0/".$per_page."/0'>Created On <span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 10){
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/9/0/".$per_page."/0'>Created On <span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/9/0/".$per_page."/0'>Created On</a>";
  		}?>
		</th>
		<th class='user_updated_column'>
		<?php if($sort_by == 11){
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/12/0/".$per_page."/0'>Last Updated <span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 12){
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/11/0/".$per_page."/0'>Last Updated <span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."UserAdmin/show_all_users_paginated/11/0/".$per_page."/0'>Last Updated</a>";
  		}?>
		</th>		
		<?php if($allow_edit || $allow_delete){ echo "<th class='edit_button_column'></th>"; } ?>
	</tr>
</thead>
<tbody class="table-hover">
	<?php	
	$counter = 0;
	foreach ($results as $data){
	  $counter++;
		if ($data->locked == 0){
		   $locked = "No";
		}else{
			$locked = "Yes";
			}
		echo"<tr><td class='user_column'><a href='#' class='editable' id='first' data-type='text' name='first' data-pk='".$data->id."' data-url='".base_url()."UserAdmin/postValue/".$data->id."/first' data-title='Enter the user's first name'>".$data->first."</a> ";
		echo"<a href='#' class='editable' id='last' data-type='text' name='last' data-pk='".$data->id."' data-url='".base_url()."UserAdmin/postValue/".$data->id."/last' data-title='Enter the user's last name'>".$data->last."</a> <a href='#' id='show_user".$data->id."'><span class='glyphicon glyphicon-list-alt'></span></a></td>";
		echo"<td class='user_email_column'><a href='#' class='editable' id='email' data-type='text' name='email' data-pk='".$data->id."' data-url='".base_url()."UserAdmin/postValue/".$data->id."/email' data-title='Enter a valid email'>".$data->email."</a></td>";
		echo"<td class='user_status_column'><a href='#' id='status' class='status_editable_".$counter."' data-type='select' name='status' data-pk='".$data->id."' data-url='".base_url()."UserAdmin/postValue/".$data->id."/status' data-title='Select Status'>".$data->status."</a></td>";
		echo"<td class='user_locked_column'><a href='#' id='locked' class='locked_editable_".$counter."' data-type='select' name='locked' data-pk='".$data->id."' data-url='".base_url()."UserAdmin/postValue/".$data->id."/locked' data-title='Is locked?'>".$locked."</a></td>";
		echo"<td class='user_created_column'>".date('m-d-Y', strtotime($data->created))."</td>";
		echo"<td class='user_updated_column'>".date('m-d-Y', strtotime($data->last_updated))."</td>";
		if($allow_edit){
		?>
		<script>
		$(function(){ 
			$('.status_editable_<?php echo $counter; ?>').editable({
				value: "<?php echo $data->status; ?>", 
				source: [ 
					{value: 'ACTIVE', text: 'ACTIVE'}, 
					{value: 'INACTIVE', text: 'INACTIVE'} 
					]  
			});  
		});   

		$(function(){ 
			$('.locked_editable_<?php echo $counter; ?>').editable({
				value: "<?php echo $data->locked; ?>", 
				source: [ 
					{value: '0', text: 'No'}, 
					{value: '1', text: 'Yes'} ]  
			});  
		});   
</script>
	
	<?php	 
	 } 
		echo"<td><a href='".base_url()."UserAdmin/update/".$data->id."' class='btn btn-default' id='edit_user".$data->id."' style='margin:1px;'><span class='glyphicon glyphicon-edit' style='font-size:16px;'></span></a>";
		echo"<a href='#' class='btn btn-default' id='delete_user".$data->id."' style='margin:1px;'><span class='glyphicon glyphicon-remove' style='font-size:16px;'></span></a></td></tr>";
		//below is the script for the pop-up dialog box to confirm the item delete.
		echo"<script>$('#delete_user".$data->id."').click(function(){bootbox.dialog({title:\"Confirm Deletion\", message:\"<p style='text-align:center'>Are you sure?<br><br><a class='btn btn-warning' href='".base_url()."UserAdmin/delete/".$data->id."'>Delete</a></p>\"}); });</script>";
	}
	
	?>
</tbody>
</table>
	<?php if(isset($links)){ 
	 echo "<div id='page_links'>".$links."</div>";
	 ?>
	
	 <div class="btn-group pagination_dropdown">
       <button class="btn">Per page: <strong><?php echo $per_page; ?></strong></button>
		 <button class="btn dropdown-toggle" data-toggle="dropdown">
         <span class="caret"></span>
       </button>
		 <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
 <?php
		 if($sort_by < 1){
		 	$sort_by=0;
		 	}
		 echo "<li><a tabindex='-1' href='".base_url()."UserAdmin/show_all_users_paginated/".$sort_by."/0/10/0'>10</a></li>";
		 echo "<li><a tabindex='-1' href='".base_url()."UserAdmin/show_all_users_paginated/".$sort_by."/0/20/0'>20</a></li>";
		 echo "<li><a tabindex='-1' href='".base_url()."UserAdmin/show_all_users_paginated/".$sort_by."/0/50/0'>50</a></li>";
		 echo "<li><a tabindex='-1' href='".base_url()."UserAdmin/show_all_users_paginated/".$sort_by."/0/100/0'>100</a></li>";
?>			
		 </ul>
		 
      </div></br></br>
     <?php } ?>

</div><!--body-->
</div><!--container-->
