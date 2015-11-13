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
	$this->load->model('Audit_model');	
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
		$audit = array('primary' => 'CNFG', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'Config', 'value'=>null,  'extra_1' =>'view_user_profile', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view('show_global_settings',$data);
		$this->load->view("footer",$data);
	}else{
		redirect ('User/restricted');	
	   }
}

public function restore_default(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
       if($this->Config_model->restore_default_settings()){
       	$audit = array('primary' => 'CNFG', 'secondary'=>'DFLT', 'status'=>true,  'controller'=>'Config', 'value'=>null,  'extra_1' =>'Restored default configuration settings', 'extra_2'=>null, 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			$message = "<div class='alert alert-success'  role='alert'><p><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> Application default settings restored.</p></div>";
			$this->session->set_flashdata('message',$message);
			 redirect('Config');
		}else{
			$audit = array('primary' => 'CNFG', 'secondary'=>'DFLT', 'status'=>false,  'controller'=>'Config', 'value'=>null,  'extra_1' =>'Failed to restore default configuration settings', 'extra_2'=>null, 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			$message = "<div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Failed!</strong> Failed to restore application default settings.</p></div>";
			$this->session->set_flashdata('message',$message);
			 redirect('Config');    	
       	}
		}else{
		redirect ('User/restricted');	
	   }
	}

public function kill_all_sessions(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
	$userdata = $this->session->all_userdata();
	foreach($userdata as $key=>$value){
		$this->session->unset_userdata($key);
		} 
	$audit = array('primary' => 'CNFG', 'secondary'=>'KILL', 'status'=>false,  'controller'=>'Config', 'value'=>null,  'extra_1' =>'Killed all active sessions', 'extra_2'=>null, 'extra_3'=>null);
 	$this->Audit_model->log_entry($audit);     
   $this->index();
   }else{
		redirect ('User/restricted');	
	   }
	}




public function postValue($id, $column){	//FOR INLINE EDITS
  if($this->session->userdata('is_logged_in')){		
	$this->load->library('form_validation');
	if($column=='from_email'){$this->form_validation->set_rules('value', 'Administrator Email', 'required|trim|valid_email');}
	if($column=='from_name'){$this->form_validation->set_rules('value', 'Administrator Name or Title', 'required|max_length[100]|trim');}
	if($column=='retry_limit'){$this->form_validation->set_rules('value', 'Password Retry Limit', 'required|trim');}
	if($column=='default_pagination'){$this->form_validation->set_rules('value', 'Default Pagination', 'required|trim');}
	if($column=='reset_pwd_days'){$this->form_validation->set_rules('value', 'Days to Require Password Change', 'required|trim|less_than[731]|greater_than[-1]');}
	if($column=='allow_registration'){$this->form_validation->set_rules('value', 'Allow Open Registration', 'required|trim');}
  if ($this->form_validation->run() && $this->has_permission_to_edit()){   
		if($column=='from_email'){$data = array('from_email'=>$this->input->post('value')); }
		if($column=='from_name'){$data = array('from_name'=>$this->input->post('value'));}
		if($column=='retry_limit'){$data = array('retry_limit'=>$this->input->post('value'));}
		if($column=='default_pagination'){$data = array('default_pagination'=>$this->input->post('value'));}
		if($column=='reset_pwd_days'){$data = array('reset_pwd_days'=>$this->input->post('value'));}
		if($column=='allow_registration'){$data = array('allow_registration'=>$this->input->post('value'));}
		if($this->Config_model->update_config($id, $data)){
			$audit_value = json_encode($this->input->post());
			$audit = array('primary' => 'CNFG', 'secondary'=>'UPDT', 'status'=>true,  'controller'=>'Config', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>null, 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			http_response_code(200);
		}else{
			$audit_value = json_encode($this->input->post());
			$audit = array('primary' => 'CNFG', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Config', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>'database update error', 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			http_response_code(400);
			echo "The database didn't update";
		}}else{
		 http_response_code(400);
		 $audit_value = json_encode($this->input->post());
		 $audit = array('primary' => 'CNFG', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Config', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>'validation error', 'extra_3'=>null);
 		 $this->Audit_model->log_entry($audit);
	    echo strip_tags(validation_errors());
	}}else{
		   $audit_value = json_encode($this->input->post());
			$audit = array('primary' => 'CNFG', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Config', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>'timeout error', 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			http_response_code(400);
	   	echo "The session timed out";
		}
}


}
