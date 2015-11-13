<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
filename: Roles.php
Author: Bejan Nouri
Last update: 8-1-2014

Notes- 

This is the "Roles" controller which manages everything related to roles functionality including:

*/

class Roles extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->model("Roles_permissions_model");
	$this->load->library('pagination');
	$this->load->model('Config_model');
	$this->load->model('Audit_model');		
}

public function index(){
		$this-> show_active_roles_paginated(0, 0);
	}

/*************HAS PERMISSIONS*********************/
private function has_permission_to_view(){
	$all_permissions = $this->session->userdata('permissions');
	$permission = array();
	foreach ($all_permissions as $value){
			$permission[]= $value->id;				
		}
	if( in_array(9030, $permission) ||in_array(9999, $permission)){
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
	if( in_array(9035, $permission) ||in_array(9999, $permission)){
    return true;
    	}else{
    	return false;
    	}
}

private function has_permission_to_delete(){
	$all_permissions = $this->session->userdata('permissions');
	$permission = array();
	foreach ($all_permissions as $value){
			$permission[]= $value->id;			
			}
	if( in_array(9040, $permission) ||in_array(9999, $permission)  ){
    return true;
    	}else{
    	return false;
    	}
}

private function has_permission_to_add(){
	$all_permissions = $this->session->userdata('permissions');
	$permission = array();
	foreach ($all_permissions as $value){
			$permission[]= $value->id;			
			}
	if( in_array(9035, $permission) ||in_array(9999, $permission)  ){
    return true;
    	}else{
    	return false;
    	}
}

/********************PAGINATION SETUP*********************************/
public function pagination_setup($type){		
	$default_pagination= $this->Config_model->get_default_pagination();
	$pagination_config = array();
	$sort_by = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	if ($type=='all_roles'){
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;
	$pagination_config["base_url"] = base_url()."Roles/show_all_roles_paginated/".$sort_by."/0/".$per_page."/";
	$pagination_config["total_rows"] = $this->Roles_permissions_model->roles_record_count();
	$pagination_config["uri_segment"] = 6;//this is where we determine which row start we are on, also referred to as the start page or record:
	$pagination_config["per_page"] = $per_page;	
	}elseif($type=='active_roles'){
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;
	$pagination_config["base_url"] = base_url()."Roles/show_active_roles_paginated/".$sort_by."/0/".$per_page."/";
	$pagination_config["total_rows"] = $this->Roles_permissions_model->active_roles_record_count();
	$pagination_config["uri_segment"] = 6;//this is where we determine which row start we are on, also referred to as the start page or record:
   $pagination_config["per_page"] = $per_page;	
	}else{//searched roles
		$sort_by = ($this->uri->segment(4))? $this->uri->segment(4) : 0;	
		$per_page = ($this->uri->segment(6))? $this->uri->segment(6) : $default_pagination;	
		$pagination_config["base_url"] = base_url()."Roles/search_roles_paginated/".$type."/".$sort_by."/0/".$per_page."/";
		$pagination_config["total_rows"] = $this->Roles_permissions_model->search_roles_record_count($type);		
		$pagination_config["uri_segment"] = 7;	//this is where we determine which row start we are on, also referred to as the start page or record:	
		$pagination_config["per_page"] = $per_page;	
		}
	$pagination_config["full_tag_open"] = "<ul class='pagination'>";
	$pagination_config["full_tag_close"] = "</ul>";
	$pagination_config["first_tag_open"] = "<li>";
	$pagination_config["first_tag_close"] = "</li>";
	$pagination_config["last_tag_open"] = "<li>";
	$pagination_config["last_tag_close"] = "</li>";
	$pagination_config["next_tag_open"] = "<li>";
	$pagination_config["next_tag_close"] = "</li>";
	$pagination_config["prev_tag_open"] = "<li>";
	$pagination_config["prev_tag_close"] = "</li>";
	$pagination_config["cur_tag_open"] = "<li class='active'><a href='#'>";
	$pagination_config["cur_tag_close"] = "</a></li>";
	$pagination_config["num_tag_open"] = "<li>";
	$pagination_config["num_tag_close"] = "</li>";
	$this->pagination->initialize($pagination_config);
	return $pagination_config;	
}	

/*********************SHOW ALL ROLES************************************/

public function show_all_roles_paginated($sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup('all_roles');
		}
		$page =  ($this->uri->segment(6))? $this->uri->segment(6) : 0;	
		$data["results"] = $this->Roles_permissions_model->get_all_roles_paginated($pagination_config["per_page"], $page, $sort_by);
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
		$view_data['per_page'] = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
		$view_data['total_records'] = $pagination_config['total_rows'];
		$view_data['controller']="show_all_roles_paginated";
	   $view_data['sort_by'] = $this->uri->segment(3); 
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['title']="Roles";
		$view_data['page_header']= "All Roles";
		$data= array_merge($view_data, $data);
		$audit = array('primary' => 'ROLE', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'Roles', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_roles_view",$data);
		$this->load->view("footer",$data);				
			}else{
		      redirect ('User/restricted');	
			}
	} 
	
public function show_active_roles_paginated($sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup('active_roles');
		}
		$page =  ($this->uri->segment(6))? $this->uri->segment(6) : 0;		
		$data["results"] = $this->Roles_permissions_model->get_active_roles_paginated($pagination_config["per_page"], $page, $sort_by);
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
		$view_data['per_page'] = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
		$view_data['total_records'] = $pagination_config['total_rows'];
		$view_data['controller']="show_active_roles_paginated";
	   $view_data['sort_by'] = $this->uri->segment(3); 
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['title']="Roles";
		$view_data['page_header']= "Active Roles";
		$data= array_merge($view_data, $data);
		$audit = array('primary' => 'ROLE', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'Roles', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_roles_view",$data);
		$this->load->view("footer",$data);				
			}else{
		      redirect ('User/restricted');	
			}
	} 	
	
	public function search_roles(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
	$audit_value = json_encode($this->input->post());
	$this->load->library('form_validation');
	$this->form_validation->set_rules('search_by', 'Search Field', 'required|trim');
	if ($this->form_validation->run()){
		$search_by=$this->input->post('search_by');
		$search_by=trim($search_by);
		$search_by=strip_tags($search_by,"");
		$search_by = str_replace('@', '-at-',$search_by);		
		$search_by = preg_replace('/[^A-Za-z0-9\s.\s-]/','',$search_by); 		
		redirect('Roles/search_roles_paginated/'.$search_by.'/0/0/0/');
	}else{ //end of section for the forms valid 
	    $audit = array('primary' => 'ROLE', 'secondary'=>'SRCH', 'status'=>false,  'controller'=>'Roles', 'value'=>$audit_value,  'extra_1' =>'invalid search entry', 'extra_2'=>null, 'extra_3'=>null);
	 	 $this->Audit_model->log_entry($audit);
	    $this->index();
	}}else{//end of section for user properly logged in
		      redirect ('User/restricted');	
			}
	
}


public function search_roles_paginated($search_by,$sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");		
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup($search_by);
		}
		$page = ($this->uri->segment(7))? $this->uri->segment(7) : 0;	
		$search_by = str_replace('-at-', '@',$search_by);	//this handles the @ symbol when it is passed in the url.
		$data["results"] = $this->Roles_permissions_model->search_roles_paginated($pagination_config["per_page"], $page, $sort_by, $search_by);
		$data ["links"] = $this->pagination->create_links();
		$search_by = str_replace('@', '-at-',$search_by);	 //this changes the @ symbol back to -at-
		$data['search_by']=$search_by;
		$default_pagination= $this->Config_model->get_default_pagination();
	   $view_data['per_page'] = ($this->uri->segment(6))? $this->uri->segment(6) : $default_pagination;	
	   $view_data['total_records'] = $pagination_config['total_rows'];
	   $view_data['sort_by'] = $this->uri->segment(4); 
		$view_data['title']="Roles";
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['page_header']= "Roles Found";
		$view_data['controller']="search_roles_paginated/".$search_by;
		$data= array_merge($view_data, $data);		
		$audit = array('primary' => 'ROLE', 'secondary'=>'SRCH', 'status'=>true,  'controller'=>'Roles', 'value'=>$search_by,  'extra_1' =>'search roles paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_roles_view",$data);
		$this->load->view("footer",$data);
		$this->benchmark->mark('code_end');	

	}else{
		      redirect ('User/restricted');	
			}
	} 	
	
/*********************ADD, DELETE & UPDATE A ROLE***********************************/
public function delete($id){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_delete()){
		if ($this->Roles_permissions_model->delete_role($id)){
			$audit = array('primary' => 'ROLE', 'secondary'=>'DELR', 'status'=>true,  'controller'=>'Roles', 'value'=>null,  'extra_1' =>'Delete the role', 'extra_2'=>null, 'extra_3'=>null);
		   $this->Audit_model->log_entry($audit);
			$message = "<div class='alert alert-info'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Deleted!</strong> The role was deleted from the system.</p></div>";
			$this->session->set_flashdata('message',$message);
			redirect('Roles');	
			}else{
			$audit = array('primary' => 'ROLE', 'secondary'=>'DELR', 'status'=>false,  'controller'=>'Roles', 'value'=>null,  'extra_1' =>'Failed to delete the role', 'extra_2'=>null, 'extra_3'=>null);
		   $this->Audit_model->log_entry($audit);
			$error = "Unable to delete the role. Either it doesn't exist or there is something wrong with the database.";
			$this->error_message($error);
			}					
		}else{
		redirect ('User/restricted');	
		}
	} 
public function add(){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_add()){
	$data['title']="Add a role";
	$data['page_header']="Add a role";
	$audit = array('primary' => 'ROLE', 'secondary'=>'ADDV', 'status'=>true,  'controller'=>'Roles', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);
	$this->load->view("header",$data);
	$this->load->view("navbar",$data);
	$this->load->view('add_role_view',$data);
	$this->load->view("footer",$data);		
}else{
		redirect ('User/restricted');	
		}
}

public function add_validation(){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_add()){
	$audit_value = json_encode($this->input->post());
	$this->load->library('form_validation');
	$this->form_validation->set_rules('role', 'Role Name', 'required|trim|min_length[4]|max_length[16]|is_unique[roles.role]');
	$this->form_validation->set_rules('description', 'Description', 'required|max_length[100]|trim');
	$this->form_validation->set_rules('status', 'Status', 'required|trim');
	$this->form_validation->set_message('is_unique',"The role already exists.");
	if ($this->form_validation->run()){		
			$data = array(
			'role'=>strtoupper($this->input->post('role')),
			'description'=>$this->input->post('description'),
			'status'=>$this->input->post('status')
			);
		if($this->Roles_permissions_model->add_role($data)){			
			$audit = array('primary' => 'ROLE', 'secondary'=>'ADD', 'status'=>true,  'controller'=>'Roles', 'value'=>$audit_value,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);
			$message = "<div class='alert alert-success'  role='alert'><p><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> The new role was successfully added to the system.</p></div>";
			$this->session->set_flashdata('message',$message);
			 redirect('Roles');
			}else{ 
			$audit = array('primary' => 'ROLE', 'secondary'=>'ADD', 'status'=>false,  'controller'=>'Roles', 'value'=>$audit_value,  'extra_1' =>'failed to add the new role', 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);
			$message = "<div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Failed!</strong>Failed to create the new role.</p></div>";
			$this->session->set_flashdata('message',$message);
			 redirect('Roles/add');			
			}	
	}else{
	$audit = array('primary' => 'ROLE', 'secondary'=>'ADD', 'status'=>false,  'controller'=>'Roles', 'value'=>$audit_value,  'extra_1' =>'forms validation error', 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);
	$this->add();
	}	 
}else{
		redirect ('User/restricted');	
		}
}
	
public function update($id){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
	$data['results']= $this->Roles_permissions_model->get_role($id);
	$audit_value = json_encode($data['results']);
	$lookup['selected_permissions'] = $this->Roles_permissions_model->list_role_permissions($id);
	$lookup['active_permissions'] = $this->Roles_permissions_model->list_active_permissions();	
	$active_permissions = array();
	foreach($lookup['active_permissions'] as $permission){
  	$permission_id=$permission->id;
	$permission = $permission->permission;  
	$active_permissions[$permission_id] = $permission;
  	}	
  	$selected_permissions = array();	
	foreach($lookup['selected_permissions'] as $permission){
	$selected_permissions[] = $permission->permission_id;
	}
	$audit = array('primary' => 'ROLE', 'secondary'=>'UPDV', 'status'=>true,  'controller'=>'Roles', 'value'=>$audit_value,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);
   $data['id'] = $id;
   $data['active']=$active_permissions;
   $data['selected']=$selected_permissions;
	$data['title']="Edit the role";
	$data['page_header']="Edit the role";
	$this->load->view("header",$data);
	$this->load->view("navbar",$data);
	$this->load->view('edit_role_view',$data);
	$this->load->view("footer",$data);
}else{
		redirect ('User/restricted');	
		}
}

public function update_validation(){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
	$audit_value = json_encode($this->input->post());
	$this->load->library('form_validation');
	$this->form_validation->set_rules('role', 'Role Name', 'required|trim|min_length[4]|max_length[16]');
	$this->form_validation->set_rules('description', 'Description', 'required|max_length[100]|trim');
	$this->form_validation->set_rules('status', 'Status', 'required|trim');
	$this->form_validation->set_message('is_unique',"role already exists.");
	if ($this->form_validation->run()){
		$id = $this->input->post('id');
   	$permissions = $this->input->post('permissions');
	   $this->Roles_permissions_model->unlink_all_permissions_to_role($id);		
		$data = array(
			'role'=>strtoupper($this->input->post('role')),
			'description'=>$this->input->post('description'),
			'status'=>$this->input->post('status')
			);		
		if($this->Roles_permissions_model->update_role($data, $id) && $this->Roles_permissions_model->link_multiple_permissions_to_role($id, $permissions)) {	
			$audit = array('primary' => 'ROLE', 'secondary'=>'UPDT', 'status'=>true,  'controller'=>'Roles', 'value'=>$audit_value,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);		
			$message = "<div class='alert alert-success'  role='alert'><p><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> The role was successfully updated in the system.</p></div>";
			$this->session->set_flashdata('message',$message);
			 redirect('Roles'); //SUCCESS 
			}else{
				$audit = array('primary' => 'ROLE', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Roles', 'value'=>$audit_value,  'extra_1' =>'failed to update the role', 'extra_2'=>null, 'extra_3'=>null);
				$this->Audit_model->log_entry($audit);		 
				$message = "<div id='message'><div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span><strong>Notice!</strong>Failed to update the role.</p></div></div>";
				echo $message;
				$this->update($id);
			}	
	}else{
	$audit = array('primary' => 'ROLE', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Roles', 'value'=>$audit_value,  'extra_1' =>'forms validation error', 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);		
	$this->update();
	}
}else{
		redirect ('User/restricted');	
		}
}

public function postValue($id, $column){	//FOR INLINE EDITSpublic function link_role_permission($role_id, $permission_id){
   if($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){	
   $audit_value = json_encode($this->input->post());	
	$this->load->library('form_validation');
	if($column=='role'){
		$this->form_validation->set_rules('value', 'Role name', 'required|trim|min_length[4]|max_length[16]|is_unique[roles.role]');
		$this->form_validation->set_message('is_unique','The role already exists.');}
	if($column=='description'){$this->form_validation->set_rules('value', 'Description', 'required|max_length[100]|trim');}
	if($column=='status'){$this->form_validation->set_rules('value', 'Status', 'required|trim');}
	if ($this->form_validation->run() && $this->has_permission_to_edit()){
		if($column=='role'){$data = array('role'=>strtoupper($this->input->post('value'))); }
		if($column=='description'){$data = array('description'=>$this->input->post('value'));}
		if($column=='status'){$data = array('status'=>$this->input->post('value'));}
		if ($this->Roles_permissions_model->update_role($data, $id)){
			$audit = array('primary' => 'ROLE', 'secondary'=>'UPDT', 'status'=>true,  'controller'=>'Role', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>null, 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			http_response_code(200);
		}else{
			$audit = array('primary' => 'ROLE', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Role', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>'database did not update properly', 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			http_response_code(400);
			echo "Database did not update properly";
		}}else{
		$audit = array('primary' => 'ROLE', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Role', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>'form validation error', 'extra_3'=>null);
 		$this->Audit_model->log_entry($audit);
		http_response_code(400);
		 echo strip_tags(validation_errors());
	}}else{
			$audit = array('primary' => 'ROLE', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Role', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>'timeout error', 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			http_response_code(400);
	   	echo "The session timed out";
	   	}
}



}