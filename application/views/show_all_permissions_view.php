<script>
$(document).ready(function() {
	if ($(window).width() < 640) {
		$(".permission_created_column").remove();
		$(".permission_updated_column").remove();
		$(".permission_description_column").remove();	
		}
	if ($(window).width() < 430) {
		$(".permission_category_column").remove();
		}
	});
</script>
<div id="container" class="container-fluid">
<div id="body">
<h1><?php echo $page_header; ?><sup> <span title="Total Record Count" class="label label-info"><?php echo $total_records ?></span></sup> </h1>
<div class='submenu' style='width:70%; float:left;'>
<?php 
if (empty($sort_by)){$sort_by=0;}
if($allow_add){
	echo"<a href='".base_url()."/Permissions/add' class='btn btn-default'>Create permission</a> &nbsp;&nbsp;";
}
if($controller=="show_active_permissions_paginated"){
echo "<a href='".base_url()."Permissions/show_all_permissions_paginated/0/0/".$per_page."/0' class='btn btn-primary'><span title='Show All' class='glyphicon glyphicon-eye-close'></span></a> ";
}elseif($controller=="show_all_permissions_paginated"){
echo "<a href='".base_url()."Permissions/show_active_permissions_paginated/0/0/".$per_page."/0' class='btn btn-warning'><span title='Hide Inactive' class='glyphicon glyphicon-eye-open'></span></a> ";
}else{ 
echo "<a href='".base_url()."Permissions/show_all_permissions_paginated/0/0/".$per_page."/0' class='btn btn-primary'><span  title='Show All' class='glyphicon glyphicon-eye-close'></span></a> "; 
}
echo"</div> <!--submenu-->";
//search by box
echo "<div class='search_by form-group' style='width:30%; float:right;'>";
echo form_open('Permissions/search_permissions');
echo '<div class="warning" style="color:red;">'.validation_errors().'</div>';
$input_options= array(
		'name'=>'search_by', 
		'id'=>'search_by',
		'class'=>'form-control',
		'maxlength'=>'250',
		'size'=>'50', 
		'style'=>'width:75%; float: left;'
		); 
echo form_input($input_options);
$submit_options= array(
	'name'=>'submit',
	'id'=>'search_submit',
	'value'=>'Search',
	'class'=>'form-control btn btn-primary',
	'maxlength'=>'75',
	'size'=>'50',
	'style'=>'width:22%; margin-left:3%;'	
);
echo form_submit($submit_options);
$string = "</div> <!--search_by-->";
echo form_close($string);

if(isset($message) && !empty($message)){
echo "<p>$message</p>";
}
?>

<table class="table">
<thead>
	<tr class="active">
		<th class='permission_column'>
		<?php if($sort_by == 1){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/2/0/".$per_page."/0'>ID  <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 2){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/1/0/".$per_page."/0'>ID <span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		 	echo "<a href=' ".base_url()."Permissions/".$controller."/1/0/".$per_page."/0'>ID </a>";
  		}?>	
  		</th>
		<th class='permission_column'>
		<?php if($sort_by == 3){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/4/0/".$per_page."/0'>Permission  <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 4){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/3/0/".$per_page."/0'>Permission  <span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		 	echo "<a href=' ".base_url()."Permissions/".$controller."/3/0/".$per_page."/0'>Permission  </a>";
  		}?>	
  		</th>
		<th class='permission_description_column'>
		<?php if($sort_by == 5){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/6/0/".$per_page."/0'>Description <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 6){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/5/0/".$per_page."/0'>Description <span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		 	echo "<a href=' ".base_url()."Permissions/".$controller."/5/0/".$per_page."/0'>Description </a>";
  		}?>	
  		</th>
		<th class='permission_status_column'>
		<?php if($sort_by == 7){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/8/0/".$per_page."/0'>Status <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 8){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/7/0/".$per_page."/0'>Status <span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		 	echo "<a href=' ".base_url()."Permissions/".$controller."/7/0/".$per_page."/0'>Status </a>";
  		}?>	
  		</th>
		<th class='permission_category_column'>
			<?php if($sort_by == 9){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/10/0/".$per_page."/0'>Category <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 10){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/9/0/".$per_page."/0'>Category <span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		 	echo "<a href=' ".base_url()."Permissions/".$controller."/9/0/".$per_page."/0'>Category </a>";
  		}?>	
  		</th>
		<th class='permission_created_column'>
			<?php if($sort_by == 11){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/12/0/".$per_page."/0'>Created On <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 12){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/11/0/".$per_page."/0'>Created On <span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		 	echo "<a href=' ".base_url()."Permissions/".$controller."/11/0/".$per_page."/0'>Created On </a>";
  		}?>			
		</th>
		<th class='permission_updated_column'>
			<?php if($sort_by == 13){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/14/0/".$per_page."/0'>Last Updated <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 14){
		  	echo "<a href=' ".base_url()."Permissions/".$controller."/13/0/".$per_page."/0'>Last Updated <span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		 	echo "<a href=' ".base_url()."Permissions/".$controller."/13/0/".$per_page."/0'>Last Updated </a>";
  		}?>				
		</th>	
<?php if($allow_edit || $allow_delete){ echo "<th class='edit_button_column'></th>"; } ?>	
	</tr>
</thead>
<tbody class="table-hover">
	<?php
	$counter = 0;
	foreach ($results as $data){
	if($data->status == 'ACTIVE'){
			$status = $data->status;
			$status_indicator = 'success';
			}elseif($data->status == 'INACTIVE'){
				$status = $data->status;
				$status_indicator = 'warning';
				}else{
					$status = $data->status;
					$status_indicator = 'info';
					}	
	$counter++;
	echo"<tr><td class='permission_id_column'>".$data->id."</td>";		
	echo"<td class='permission_column'><a href='#' class='editable' id='permission' data-type='text' name='permission' data-pk='".$data->id."' data-url='".base_url()."Permissions/postValue/".$data->id."/permission' data-title='Enter permission name'>".$data->permission."</a></td>";
	echo"<td class='permission_description_column'><a href='#' class='editable' id='description' data-type='text' name='description' data-pk='".$data->id."' data-url='".base_url()."Permissions/postValue/".$data->id."/description' data-title='Enter Description'>".$data->description."</a></td>";
	echo"<td class='permission_status_column'><a href='#' id='status' class='status_editable_".$counter."' data-type='select' name='status' data-pk='".$data->id."' data-url='".base_url()."Permissions/postValue/".$data->id."/status' data-title='Select Status'><span class='label label-$status_indicator'>".$status."</span></a></td>";
	echo"<td class='permission_category_column'><a href='#' id='category' class='category_editable_".$counter."' data-type='select' name='category' data-pk='".$data->id."' data-url='".base_url()."Permissions/postValue/".$data->id."/category' data-title='Enter Category'>".$data->category."</a></td>";
	echo"<td class='permission_created_column'>".date('m-d-Y', strtotime($data->created))."</td>";
	echo"<td class='permission_updated_column'>".date('m-d-Y', strtotime($data->last_updated))."</td>";
		if($allow_edit){
		?>
<script>
		$(function(){ 
			$('.status_editable_<?php echo $counter; ?>').editable({
				value: "<?php echo $status; ?>", 
				source: [ 
					{value: 'ACTIVE', text: 'ACTIVE'}, 
					{value: 'INACTIVE', text: 'INACTIVE'} 
					]  
			});  
		});   
 
</script>
<script>
		$(function(){ 
			$('.category_editable_<?php echo $counter; ?>').editable({
				value: "<?php echo $data->category; ?>", 
				source: [ 
				<?php  foreach($categories as $entry){echo "{value:'".$entry->category."', text:'".$entry->category."'},"; }?>
				{value:'Empty',text:'None'}
					]  
			});  
		});   
 
</script>
	<?php
		
		echo"<td><a href='".base_url()."Permissions/update/".$data->id."' class='btn btn-default' id='edit_permission".$data->id."' style='margin:1px;'><span class='glyphicon glyphicon-edit' style='font-size:16px;'></span></a>";
		}
		if($allow_delete){
		echo"<a href='#' class='btn btn-default' id='delete_permission".$data->id."' style='margin:1px;'><span class='glyphicon glyphicon-remove' style='font-size:16px;'></span></a></td></tr>";
		//below is the script for the pop-up dialog box to confirm the item delete.
		echo"<script>$('#delete_permission".$data->id."').click(function(){bootbox.dialog({title:\"Confirm Deletion\", message:\"<p style='text-align:center'>Are you sure?<br><br><a class='btn btn-warning' href='".base_url()."Permissions/delete/".$data->id."'>Delete</a></p>\"}); });</script>";
    }	
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
		 echo "<li><a tabindex='-1' href='".base_url()."Permissions/".$controller."/".$sort_by."/0/10/0'>10</a></li>";
		 echo "<li><a tabindex='-1' href='".base_url()."Permissions/".$controller."/".$sort_by."/0/20/0'>20</a></li>";
		 echo "<li><a tabindex='-1' href='".base_url()."Permissions/".$controller."/".$sort_by."/0/50/0'>50</a></li>";
		 echo "<li><a tabindex='-1' href='".base_url()."Permissions/".$controller."/".$sort_by."/0/100/0'>100</a></li>";
		 ?>
		 </ul>
		 
      </div></br></br>
     <?php } ?>

</div><!--body-->
</div><!--container-->
