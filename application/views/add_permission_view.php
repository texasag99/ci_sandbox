
<div id="container" class="container-fluid">
<h1><?php echo $page_header; ?></h1>

<div id="body">
<div id="form_container_500">
	
<div class="form-group">
<p style="max-width:100%; border:1px solid dark-gray; background-color:silver; padding:10px;">
Please enter the new role. </p>

<?php 
echo form_open('Permissions/add_validation');
echo '<div class="warning" style="color:red;">'.validation_errors().'</div>';
echo "<label for='Permission_ID'>Permission ID:</label>";
echo form_input('id',$this->input->post('id'));
echo "<label for='Permission'>Permission Name:</label>";
echo form_input('permission',$this->input->post('permission'));
echo "<label for='description'>Description:</label>";
echo form_input('description',$this->input->post('description'));
$status = array(
  	    	'ACTIVE' => 'Active', 
			'INACTIVE' => 'Inactive'
             );

echo "<label for='status'>Status:</label> ";
echo form_dropdown('status', $status, 'Choose one');
echo "<label for='category'>Category:</label>";
echo form_input('category',$this->input->post('category'));
echo '<br><button type="submit" class="btn btn-primary">Submit</button>';
echo form_close();

?>
</div><!--container-->
</div><!--body-->
</div>
</div>