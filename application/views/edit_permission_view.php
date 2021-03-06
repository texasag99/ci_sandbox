

<?php 
if(ISSET($_SERVER['HTTP_REFERER'])){
	$go_back_url = $_SERVER['HTTP_REFERER'];
}else{ 
    $go_back_url = base_url().'/Permissions';
}
?>

<div id="container" class="container-fluid">
<h1><?php echo $page_header; ?></h1>

<div id="body">
<div id="form_container_500">
	
<div class="form-group">
<p style="max-width:100%; border:1px solid dark-gray; background-color:silver; padding:10px;">
Please edit the role. </p>

<?php 
echo form_open('Permissions/update_validation/');
echo '<div class="warning" style="color:red;">'.validation_errors().'</div>';
foreach ($results as $data){
echo "<label for='id'>Permission ID:</label> ";
echo form_input(array('name'=>'id','value'=>$data->id,'readonly'=>'readonly'));
echo "<label for='permission_name'>Permission Name:</label>";
echo form_input(array('name'=>'permission','value'=>$data->permission,'readonly'=>'readonly'));
echo "<label for='description'>Description:</label>";
echo form_textarea(array('name'=>'description','value'=>$data->description, 'rows'=> '10', 'id'=>'comment', 'class'=>'form-control'));
$status = array(
  	    	'ACTIVE' => 'Active', 
			'INACTIVE' => 'Inactive'
             );

echo "<label for='status'>Status:</label> ";
echo form_dropdown('status', $status, $data->status);
echo "<label for='category'>Category:</label>";
echo form_input('category',$data->category);				
echo "<label for='created'>Created On:</label> ";
echo form_input(array('name'=>'created','value'=>$data->created,'readonly'=>'readonly'));
echo "<label for='created'>Last Updated:</label> ";
echo form_input(array('name'=>'last_updated','value'=>$data->last_updated,'readonly'=>'readonly'));
}
echo '<br><button type="submit" class="btn btn-primary">Submit</button>';
echo '&nbsp;<a href="'.$go_back_url.'" class="btn btn-warning">Cancel</a>';
echo form_close();

?>
</div><!--container-->
</div><!--body-->
</div>
</div>