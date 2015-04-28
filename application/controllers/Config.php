<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
filename: Config.php
Author: Bejan Nouri
Last update: 4-1-2015

Notes- 

This is the "Config" controller which manages the application settings:

*/

class Config extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->model('Config_model');	
}

public function index(){
	$this->show_configuration();
}

private function has_permission_to_view(){
	$all_permissions = $this->session->userdata('permissions');
	$permission = array();
	foreach ($all_permissions as $value){
			$permission[]= $value->id;				
		}
	if( in_array(9065, $permission) ||in_array(9999, $permission)){
    return true;
    	}else{
    	return false;
    	}
}

private function has_permission_to_edit(){
	$all_permissions = $this->session->userdata('permissions');
	$permission = array();
	foreach ($all_permissions as $value){
			$permission[]= $value->id;			
			}
	if( in_array(9070, $permission) ||in_array(9999, $permission)){
    return true;
    	}else{
    	return false;
    	}
}

public function show_configuration(){
   if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
   	$data['results'] = $this->Config_model->get_all_settings();
   	//print_r($data);
   	$data['allow_edit'] = $this->has_permission_to_edit();   	
   	$data['title']="Global Settings";
		$data['page_header']="Global Settings";
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view('show_global_settings',$data);
		$this->load->view("footer",$data);
	}else{
		redirect ('User/restricted');	
	   }
}

public function postValue($id, $column){	//FOR INLINE EDITS
	$this->load->library('form_validation');
	if($column=='from_email'){$this->form_validation->set_rules('value', 'Administrator Email', 'required|trim|valid_email');}
	if($column=='from_name'){$this->form_validation->set_rules('value', 'Administrator Name or Title', 'required|max_length[100]|trim');}
	if($column=='retry_limit'){$this->form_validation->set_rules('value', 'Limit', 'required|trim');}
	if($column=='default_pagination'){$this->form_validation->set_rules('value', 'Default Pagination', 'required|trim');}
	if ($this->form_validation->run() && $this->has_permission_to_edit()){
		if($column=='from_email'){$data = array('from_email'=>$this->input->post('value')); }
		if($column=='from_name'){$data = array('from_name'=>$this->input->post('value'));}
		if($column=='retry_limit'){$data = array('retry_limit'=>$this->input->post('value'));}
		if($column=='default_pagination'){$data = array('default_pagination'=>$this->input->post('value'));}
		if($this->Config_model->update_config($id, $data)){
			http_response_code(200);
		}else{
			http_response_code(400);
			echo "The database didn't update";
		}}else{
		http_response_code(400);
		 echo strip_tags(validation_errors());
	}
}


}
