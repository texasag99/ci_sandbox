<script>
$(document).ready(function() {
	if ($(window).width() < 640) {
		$(".session_id_column").remove();
		$(".uri_column").remove();
		$(".value_column").remove();	
		}
	if ($(window).width() < 430) {
		$(".status_column").remove();
		$(".ip_address_column").remove();
		$(".user_email_column").remove();	
		}
	});
</script>

<div id="container" class="container-fluid">
<div id="body">
<h1><?php echo $page_header; ?> <sup> <span title="Total Record Count" class="label label-info"><?php echo $total_records ?></span></sup></h1>
<div class='submenu' style='width:70%; float:left;'>
<?php if($allow_edit){
	echo "<a href='".base_url()."Audit/truncate_log' class='btn btn-default'>Clear Audit Log</a> &nbsp;&nbsp;";
}
if($controller=="show_audit_paginated"){
echo "<a href='".base_url()."Audit/show_failed_log_paginated/0/0/".$per_page."/0' class='btn btn-primary'><span title='Hide Success' class='glyphicon glyphicon-eye-open'></span></a>";
echo "&nbsp;<a href='".base_url()."Audit/".$controller."/".$sort_by."/999999/".$per_page."/0' class='btn btn-primary'><span title='Export to PDF'  class='glyphicon glyphicon-print'></span></a>";
}elseif($controller=="show_failed_log_paginated"){
echo "<a href='".base_url()."Audit/show_audit_paginated/0/0/".$per_page."/0' class='btn btn-warning'><span title='Show All' class='glyphicon glyphicon-eye-close'></span></a>";
echo "&nbsp;<a href='".base_url()."Audit/".$controller."/".$sort_by."/999999/".$per_page."/0' class='btn btn-primary'><span title='Export to PDF'  class='glyphicon glyphicon-print'></span></a>";
}else{ 
echo "<a href='".base_url()."Audit/show_audit_paginated/0/0/".$per_page."/0' class='btn btn-warning'><span title='Show All' class='glyphicon glyphicon-eye-close'></span></a>"; 
echo "&nbsp;<a href='".base_url()."Audit/".$controller."/".$sort_by."/999999/".$per_page."/0' class='btn btn-primary'><span title='Export to PDF'  class='glyphicon glyphicon-print'></span></a>";
}
echo" </div> <!--submenu-->";

echo "<div class='search_by form-group' style='width:30%; float:right;'>";
echo form_open('Audit/search_audit');
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
?>



<br>
<?php   
if(isset($message) && !empty($message)){
echo "<p>$message</p>";
}
?>
<br>
<table class="table">
<thead>
	<tr class="active"><th class='primary_column'>
  <?php if($sort_by == 1){
		  	echo "<a href=' ".base_url()."Audit/".$controller."/2/0/".$per_page."/0'>Pri <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 2){
		  	echo "<a href=' ".base_url()."Audit/".$controller."/1/0/".$per_page."/0'>Pri<span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		 	echo "<a href=' ".base_url()."Audit/".$controller."/1/0/".$per_page."/0'>Pri</a>";
  		}?>
	</th>
		<th class='secondary_column'>
		 <?php if($sort_by == 3){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/4/0/".$per_page."/0'>Sec  <span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 4){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/3/0/".$per_page."/0'>Sec <span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."Audit/".$controller."/3/0/".$per_page."/0'>Sec</a>";
  		}?>
		</th>
		<th class='user_email_column'>
		 <?php if($sort_by == 5){
		  	echo "<a href=' ".base_url()."Audit/".$controller."/6/0/".$per_page."/0'>Email  <span class='glyphicon glyphicon-chevron-up'></span></a>";
		  }elseif($sort_by == 6){
		  	echo "<a href=' ".base_url()."Audit/".$controller."/5/0/".$per_page."/0'>Email <span class='glyphicon glyphicon-chevron-down'></span></a>";
		  	}else{
		  	echo "<a href=' ".base_url()."Audit/".$controller."/5/0/".$per_page."/0'>Email </a>";
  		}?>		
		</th>
		<th class='ip_address_column'>
		<?php if($sort_by == 7){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/8/0/".$per_page."/0'>IP Address<span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 8){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/7/0/".$per_page."/0'>IP Address<span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."Audit/".$controller."/7/0/".$per_page."/0'>IP Address</a>";
  		}?>
		</th>
		<th class='status_column'>
		<?php if($sort_by == 9){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/10/0/".$per_page."/0'>Status <span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 10){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/9/0/".$per_page."/0'>Status <span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."Audit/".$controller."/9/0/".$per_page."/0'>Status</a>";
  		}?>
		</th>
		<th class='datetime_column'>
		<?php if($sort_by == 11){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/12/0/".$per_page."/0'>Date/Time <span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 12){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/11/0/".$per_page."/0'>Date/Time <span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."Audit/".$controller."/11/0/".$per_page."/0'>Date/Time </a>";
  		}?>
		</th>		
			<th class='session_id_column'>
		<?php if($sort_by == 13){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/14/0/".$per_page."/0'>Session ID <span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 14){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/13/0/".$per_page."/0'>Session ID<span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."Audit/".$controller."/13/0/".$per_page."/0'>Session ID</a>";
  		}?>
		</th>
		<th class='uri_column'>
		<?php if($sort_by == 15){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/16/0/".$per_page."/0'>URI <span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 16){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/15/0/".$per_page."/0'>URI <span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."Audit/".$controller."/15/0/".$per_page."/0'>URI</a>";
  		}?>
		</th>
		<th class='value_column'>
		<?php if($sort_by == 17){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/18/0/".$per_page."/0'>Value <span class='glyphicon glyphicon-chevron-up'></span></a>";
			  }elseif($sort_by == 18){
			  	echo "<a href=' ".base_url()."Audit/".$controller."/17/0/".$per_page."/0'>Value <span class='glyphicon glyphicon-chevron-down'></span></a>";
			  	}else{
			  	echo "<a href=' ".base_url()."Audit/".$controller."/17/0/".$per_page."/0'>Value</a>";
  		}?>
		</th>
	</tr>
</thead>
<tbody class="table-hover">
	<?php
	if(isset($results) && !empty($results)){
	foreach ($results as $data){	
		if ($data->status == 0){
		   $status = "Failure";
		}else{
			$status= "Success";
			}
		echo "<tr><td class='primary_column'><a href='#' id='show_audit_".$data->id."'><span class='glyphicon glyphicon-th-list'></span></a>&nbsp;&nbsp;";		
		echo $data->primary."&nbsp;</td>";
		echo "<td class='secondary_column'>".$data->secondary."</td>";
		if (isset($data->user_email) && !empty($data->user_email)){ $user_email = $data->user_email;  } else { $user_email = "empty";}
		$user_email = (strlen($user_email) > 17) ? substr($user_email,0,17).'...' : $user_email ;		
		echo "<td class='user_email_column'>".$user_email."</td>";
		if (isset($data->ip_address) && !empty($data->ip_address)){ $ip_address = $data->ip_address;  } else { $ip_address = "empty";}	
		echo"<td class='ip_address_column'>".$ip_address."</td>";
		echo"<td class='status_column'>".$status."</td>";
		echo"<td class='datetime_column'>".date('m-d-Y H:i:s', strtotime($data->datetime))."</td>";
		if (isset($data->session_id) && !empty($data->session_id)){ $session_id = $data->session_id;  } else { $session_id = "empty";}
		$session_id = (strlen($session_id) > 10) ? substr($session_id,0,9).'...' : $session_id ;
		echo"<td class='session_id_column'>".$session_id."</td>";
		if (isset($data->uri) && !empty($data->uri)){ $uri= $data->uri;  } else { $uri= "empty";}
		$uri = (strlen($uri) > 10) ? substr($uri,0,9).'...' : $uri ;
		echo"<td class='uri_column'>".$uri."</td>";
		if (isset($data->value) && !empty($data->value)){ $value = $data->value;  } else { $value= "empty";}
		$value = (strlen($value) > 13) ? substr($value,0,13).'...' : $value ;
		echo"<td class='value_column'>".$value."</td>";							
		
	
	   
     echo"
     <script>
				$(function() {
				$('#show_audit_".$data->id."').click(function(event) { 
				            bootbox.dialog({
				             						title: \"Show Audit Information\", 
				             						message:\"<div id='audit'></div>\",
				             						buttons: {
				             							   main: {
				             							   	    label: \"Close\",
				             							   	    className: \"btn-primary\"
				             							   	}
				             							}            						
				             						});
				             						 
								$('#audit').load('".base_url()."Audit/getAudit/".$data->id."  #audit_record');								
							});
						});			
				</script>";
		
	}	//end of foreach
}else{//end of if($results isset)
?>
<tr><td colspan=7>
<div class='alert alert-info'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span><strong>Does Not Exist!</strong> There is no data returned for this table.</p></div>
</td></tr>
<?php
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
		 echo "<li><a tabindex='-1' href='".base_url()."Audit/".$controller."/".$sort_by."/0/10/0'>10</a></li>";
		 echo "<li><a tabindex='-1' href='".base_url()."Audit/".$controller."/".$sort_by."/0/20/0'>20</a></li>";
		 echo "<li><a tabindex='-1' href='".base_url()."Audit/".$controller."/".$sort_by."/0/50/0'>50</a></li>";
		 echo "<li><a tabindex='-1' href='".base_url()."Audit/".$controller."/".$sort_by."/0/100/0'>100</a></li>";
?>	
		 </ul>
		 
      </div><br><br>
     <?php } ?>

</div><!--body-->
</div><!--container-->