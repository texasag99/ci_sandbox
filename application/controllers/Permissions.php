<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
filename: Permissions.php
Author: Bejan Nouri
Last update: 8-1-2014

Notes- 

This is the "Permission" controller which manages everything related to permissions functionality including:
- add, delete and update all permissions on the system

*/


class Permissions extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->model("Roles_permissions_model");
	$this->load->library('pagination');
	$this->load->model('Config_model');
	$this->load->model('Audit_model');	
}

public function index(){
		$this-> show_active_permissions_paginated(0, 0);
	}

/*************HAS PERMISSIONS*********************/
private function has_permission_to_view(){
	$all_permissions = $this->session->userdata('permissions');
	$permission = array();
	foreach ($all_permissions as $value){
			$permission[]= $value->id;				
		}
	if( in_array(9050, $permission) ||in_array(9999, $permission)){
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
	if( in_array(9055, $permission) ||in_array(9999, $permission)){
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
	if( in_array(9060, $permission) ||in_array(9999, $permission)  ){
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
	if( in_array(9055, $permission) ||in_array(9999, $permission)  ){
    return true;
    	}else{
    	return false;
    	}
}

/********************PAGINATION SETUP*********************************/
/*
private function pagination_setup(){		
	$default_pagination= $this->Config_model->get_default_pagination();
	$per_page = ($this->uri->segment(4))? $this->uri->segment(4) : $default_pagination;	
	$pagination_config = array();
	$pagination_config["base_url"] = base_url()."Permissions/show_all_permissions_paginated/0/".$per_page;
	$pagination_config["total_rows"] = $this->Roles_permissions_model->permissions_record_count();
	$pagination_config["per_page"] = $per_page;
	$pagination_config["uri_segment"] = 5;
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
}*/

public function pagination_setup($type){		
	$default_pagination= $this->Config_model->get_default_pagination();
	$pagination_config = array();
	$sort_by = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	if ($type=='all_permissions'){
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;
	$pagination_config["base_url"] = base_url()."Permissions/show_all_permissions_paginated/".$sort_by."/0/".$per_page."/";
	$pagination_config["total_rows"] = $this->Roles_permissions_model->permissions_record_count();
	$pagination_config["uri_segment"] = 6;//this is where we determine which row start we are on, also referred to as the start page or record:
	$pagination_config["per_page"] = $per_page;	
	}elseif($type=='active_permissions'){
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;
	$pagination_config["base_url"] = base_url()."Permissions/show_active_permissions_paginated/".$sort_by."/0/".$per_page."/";
	$pagination_config["total_rows"] = $this->Roles_permissions_model->active_permissions_record_count();
	$pagination_config["uri_segment"] = 6;//this is where we determine which row start we are on, also referred to as the start page or record:
   $pagination_config["per_page"] = $per_page;	
	}else{//searched users
		$sort_by = ($this->uri->segment(4))? $this->uri->segment(4) : 0;	
		$per_page = ($this->uri->segment(6))? $this->uri->segment(6) : $default_pagination;	
		$pagination_config["base_url"] = base_url()."Permissions/search_permissions_paginated/".$type."/".$sort_by."/0/".$per_page."/";
		$pagination_config["total_rows"] = $this->Roles_permissions_model->search_permissions_record_count($type);		
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

/*********************SHOW ALL PERMISSIONS***********************************/

public function show_all_permissions_paginated($sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup('all_permissions');
		}
		$page =  ($this->uri->segment(6))? $this->uri->segment(6) : 0;	
		$data["results"] = $this->Roles_permissions_model->get_all_permissions_paginated($pagination_config["per_page"], $page, $sort_by);
		$data["categories"] = $this->Roles_permissions_model->get_permission_categories();
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
		$view_data['per_page'] = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
		$view_data['total_records'] = $pagination_config['total_rows'];
		$view_data['controller']="show_all_permissions_paginated";
	   $view_data['sort_by'] = $this->uri->segment(3); 
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['title']="Permissions";
		$view_data['page_header']= "All Permissions";
		$data= array_merge($view_data, $data);
		$audit = array('primary' => 'PERM', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'Permissions', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_permissions_view",$data);
		$this->load->view("footer",$data);				
			}else{
		      redirect ('User/restricted');	
			}
	} 
	
public function show_active_permissions_paginated($sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup('active_permissions');
		}
		$page =  ($this->uri->segment(6))? $this->uri->segment(6) : 0;		
		$data["results"] = $this->Roles_permissions_model->get_active_permissions_paginated($pagination_config["per_page"], $page, $sort_by);
		$data["categories"] = $this->Roles_permissions_model->get_permission_categories();		
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
		$view_data['per_page'] = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
		$view_data['total_records'] = $pagination_config['total_rows'];
		$view_data['controller']="show_active_permissions_paginated";
	   $view_data['sort_by'] = $this->uri->segment(3); 
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['title']="Permissions";
		$view_data['page_header']= "Active Permissions";
		$data= array_merge($view_data, $data);
		$audit = array('primary' => 'PERM', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'Permissions', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_permissions_view",$data);
		$this->load->view("footer",$data);				
			}else{
		      redirect ('User/restricted');	
			}
	} 	
	
	public function search_permissions(){
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
		redirect('Permissions/search_permissions_paginated/'.$search_by.'/0/0/0/');
	}else{ //end of section for the forms valid 
	    $audit = array('primary' => 'PERM', 'secondary'=>'SRCH', 'status'=>false,  'controller'=>'Permissions', 'value'=>$audit_value,  'extra_1' =>'invalid search entry', 'extra_2'=>null, 'extra_3'=>null);
	 	 $this->Audit_model->log_entry($audit);
	    $this->index();
	}}else{//end of section for users properly logged in
		      redirect ('User/restricted');	
			}
	
}


public function search_permissions_paginated($search_by,$sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");		
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup($search_by);
		}
		$page = ($this->uri->segment(7))? $this->uri->segment(7) : 0;	
		$search_by = str_replace('-at-', '@',$search_by);	//this handles the @ symbol when it is passed in the url.
		$data["results"] = $this->Roles_permissions_model->search_permissions_paginated($pagination_config["per_page"], $page, $sort_by, $search_by);
		$data ["links"] = $this->pagination->create_links();
		$data["categories"] = $this->Roles_permissions_model->get_permission_categories();		
		$search_by = str_replace('@', '-at-',$search_by);	 //this changes the @ symbol back to -at-
		$data['search_by']=$search_by;
		$default_pagination= $this->Config_model->get_default_pagination();
	   $view_data['per_page'] = ($this->uri->segment(6))? $this->uri->segment(6) : $default_pagination;	
	   $view_data['total_records'] = $pagination_config['total_rows'];
	   $view_data['sort_by'] = $this->uri->segment(4); 
		$view_data['title']="Permissions";
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['page_header']= "Permissions Found";
		$view_data['controller']="search_permissions_paginated/".$search_by;
		$data= array_merge($view_data, $data);		
		$audit = array('primary' => 'PERM', 'secondary'=>'SRCH', 'status'=>true,  'controller'=>'Permissions', 'value'=>$search_by,  'extra_1' =>'search permissions paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_permissions_view",$data);
		$this->load->view("footer",$data);

	}else{
		      redirect ('User/restricted');	
			}
	} 	


/*********************SHOW ALL PERMISSIONS***********************************
public function show_all_permissions_paginated($pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup();
		}
		$page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;		
		$data["results"] = $this->Roles_permissions_model->get_all_permissions_paginated($pagination_config["per_page"], $page);
		$data["categories"] = $this->Roles_permissions_model->get_permission_categories();
		$data ["links"] = $this->pagination->create_links();
	  $default_pagination= $this->Config_model->get_default_pagination();
	  $view_data['per_page'] = ($this->uri->segment(4))? $this->uri->segment(4) : $default_pagination;	
	  $view_data['allow_add'] = $this->has_permission_to_add();
	  $view_data['allow_edit'] = $this->has_permission_to_edit();
	  $view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['title']="Permissions";
		$view_data['page_header']= "All Permissions";
		$data= array_merge($view_data, $data);
		$audit = array('primary' => 'PERM', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'Permission', 'value'=>null,  'extra_1' =>'show permissions paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_permissions_view",$data);
		$this->load->view("footer",$data);		
			}else{
		      redirect ('User/restricted');	
			}
	}
*/
public function json_backup(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
		$this->load->helper('file');
		$data = $this->Roles_permissions_model->get_all_permissions();
		$data = json_encode($data);
		$file_path = APPPATH."../json/permissions.json";
		if (!empty($data) && isset($data)){		
		if (write_file($file_path, $data)){
			echo "it worked!";
		}else{
			echo "it didn't work";
			}
		}
		else{ 
		write_file($file_path, 'empty');
		}
		}else{
		      redirect ('User/restricted');	
			}
	}
	
public function show_all_permissions(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$data["results"] = $this->Roles_permissions_model->get_all_permissions();
		$view_data['title']="permissions";
		$view_data['page_header']= "All permissions";
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$data= array_merge($view_data, $data);
		$audit = array('primary' => 'PERM', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'Permission', 'value'=>null,  'extra_1' =>'show all permissions', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_permissions_view",$data);
		$this->load->view("footer",$data);					
			}else{
		      redirect ('User/restricted');	
			}
	}

/*********************ADD, DELETE & UPDATE A PERMISSION***********************************/
public function delete($id){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_delete()){
		if ($this->Roles_permissions_model->delete_permission($id)){
			$audit = array('primary' => 'PERM', 'secondary'=>'DELP', 'status'=>true,  'controller'=>'Permission', 'value'=>$id,  'extra_1' =>'deleted the permission', 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);
			$message = "<div class='alert alert-info'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Deleted!</strong> The permission was deleted from the system.</p></div>";
			$this->session->set_flashdata('message',$message);
			redirect('Permissions');			
			}else{
			$audit = array('primary' => 'PERM', 'secondary'=>'DELP', 'status'=>false,  'controller'=>'Permission', 'value'=>null,  'extra_1' =>'failed to delete the permission', 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);			
			$message = "<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Failure!</strong> Failed to delete permission.</div>";
			$this->session->set_flashdata('message',$message);
			redirect('Permissions');
			}					
		}else{
		redirect ('User/restricted');	
		}
	} 	
public function postValue($id, $column){	//FOR INLINE EDITS
  if($this->session->userdata('is_logged_in')){
  	$audit_value = json_encode($this->input->post());			
	$this->load->library('form_validation');
	if($column=='permission'){
		$this->form_validation->set_rules('value', 'Permission name', 'required|trim|min_length[4]|max_length[16]|is_unique[permissions.permission]');
		$this->form_validation->set_message('is_unique','The permission already exists.');}
	if($column=='description'){$this->form_validation->set_rules('value', 'Description', 'required|max_length[100]|trim');}
	if($column=='status'){$this->form_validation->set_rules('value', 'Status', 'required|trim');}
	if($column=='category'){$this->form_validation->set_rules('value', 'Category', 'required|trim');}
	if ($this->form_validation->run() && $this->has_permission_to_edit()){
		if($column=='permission'){$data = array('permission'=>strtoupper($this->input->post('value'))); }
		if($column=='description'){$data = array('description'=>$this->input->post('value'));}
		if($column=='status'){$data = array('status'=>$this->input->post('value'));}
		if($column=='category'){$data = array('category'=>$this->input->post('value'));}
		if ($this->Roles_permissions_model->update_permission($data, $id)){
			$audit = array('primary' => 'PERM', 'secondary'=>'UPDT', 'status'=>true,  'controller'=>'Permission', 'value'=>$audit_value,  'extra_1'=>$column, 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);		
			http_response_code(200);
		}else{
			$audit = array('primary' => 'PERM', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Permission', 'value'=>$audit_value,  'extra_1'=>$column, 'extra_2'=>'failed to update', 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);		
			http_response_code(400);
			echo "The database didn't update";
		}}else{
  	  $audit = array('primary' => 'PERM', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Permission', 'value'=>$audit_value,  'extra_1'=>$column, 'extra_2'=>'forms validation error', 'extra_3'=>null);
	  $this->Audit_model->log_entry($audit);		
		http_response_code(400);
		 echo strip_tags(validation_errors());
	}}else{
			$audit = array('primary' => 'PERM', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Permission', 'value'=>$audit_value,  'extra_1'=>$column, 'extra_2'=>'session timeout error', 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);		
			http_response_code(400);
	   	echo "The session timed out";
	   	}
}

public function add(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_add()){
	$audit = array('primary' => 'PERM', 'secondary'=>'ADDV', 'status'=>true,  'controller'=>'Permission', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);		
	$data['title']="Create a permission";
	$data['page_header']="Create a permission";
	$this->load->view("header",$data);
	$this->load->view("navbar",$data);
	$this->load->view('add_permission_view',$data);
  $this->load->view("footer",$data);
	}else{
		redirect ('User/restricted');	
		}
}

public function add_validation(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_add()){
	$audit_value = json_encode($this->input->post());
	$this->load->library('form_validation');
	$this->form_validation->set_rules('permission', 'Permission Name', 'required|trim|min_length[4]|max_length[16]|is_unique[permissions.permission]');
	$this->form_validation->set_rules('description', 'Description', 'required|max_length[100]|trim');
	$this->form_validation->set_rules('status', 'Status', 'required|trim');
	$this->form_validation->set_rules('category', 'Category', 'required|trim');
	$this->form_validation->set_message('is_unique',"The permission already exists.");
	if ($this->form_validation->run()){
		$data = array(
		'id'=>$this->input->post('id'),
		'permission'=>strtoupper($this->input->post('permission')),
		'description'=>$this->input->post('description'),
		'status'=>$this->input->post('status'),
		'category'=>$this->input->post('category')
		);
		if($this->Roles_permissions_model->add_permission($data)){
			$audit = array('primary' => 'PERM', 'secondary'=>'ADD', 'status'=>true,  'controller'=>'Permission', 'value'=>$audit_value,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);	
			$message = "<div class='alert alert-success' role='alert'><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> Permission successfully added.</div>";
			$this->session->set_flashdata('message',$message);
			redirect('Permissions');
			}else{
			$audit = array('primary' => 'PERM', 'secondary'=>'ADD', 'status'=>false,  'controller'=>'Permission', 'value'=>$audit_value,  'extra_1' =>'failed to add permission', 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);	 
			$message = "<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Failure!</strong> Failed to add new permission.</div>";
			$this->session->set_flashdata('message',$message);
			redirect('Permissions');
			}	
	}else{
	$audit = array('primary' => 'PERM', 'secondary'=>'ADD', 'status'=>false,  'controller'=>'Permission', 'value'=>$audit_value,  'extra_1' =>'form validation error', 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);	 
	$this->add();
	}}else{
		redirect ('User/restricted');	
		}	 
}
	
public function update($id){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
	$audit = array('primary' => 'PERM', 'secondary'=>'UPDV', 'status'=>true,  'controller'=>'Permission', 'value'=>$id,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);	
	$data['results']= $this->Roles_permissions_model->get_permission($id);
	$data['title']="Edit the permission";
	$data['page_header']="Edit the permission";
	$this->load->view("header",$data);
	$this->load->view("navbar",$data);
	$this->load->view('edit_permission_view',$data);
	$this->load->view("footer",$data);
	}else{
		redirect ('User/restricted');	
		}	 
}

public function update_validation(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
	$audit_value = json_encode($this->input->post());
	$id = $this->input->post('id');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('description', 'Description', 'required|max_length[100]|trim');
	$this->form_validation->set_rules('status', 'Status', 'required|trim');
	$this->form_validation->set_rules('category', 'Category', 'required|trim');
	if ($this->form_validation->run()){		
		$data = array(
		'permission'=>strtoupper($this->input->post('permission')),
		'description'=>$this->input->post('description'),
		'status'=>$this->input->post('status'),
		'category'=>$this->input->post('category')
		);
		if($this->Roles_permissions_model->update_permission($data, $id)){
			$audit = array('primary' => 'PERM', 'secondary'=>'UPDT', 'status'=>true,  'controller'=>'Permission', 'value'=>$audit_value,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);	
			$message = "<div class='alert alert-success' role='alert'><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> Permission successfully updated.</div>";
			$this->session->set_flashdata('message',$message);
			redirect('Permissions');
			}else{ 
			$audit = array('primary' => 'PERM', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Permission', 'value'=>$audit_value,  'extra_1' =>'failed to update permission', 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);	 
			$message = "<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Failure!</strong> Failed to update permission.</div>";
			$this->session->set_flashdata('message',$message);
			redirect('Permissions');
			}	
	}else{
   $audit = array('primary' => 'PERM', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Permission', 'value'=>$audit_value,  'extra_1' =>'form validation error', 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);	 
	$this->update($id);
	}}else{
		redirect ('User/restricted');	
		}	
}
	

}