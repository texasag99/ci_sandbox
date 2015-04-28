<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->model("Roles_permissions_model");
	$this->load->library('pagination');
	$this->load->model('Config_model');	
}

public function index(){
		$this-> show_all_permissions_paginated(0, 0);
	}

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
}	
public function show_all_permissions_paginated($pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup();
		}
		$page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;		
		$data["results"] = $this->Roles_permissions_model->get_all_permissions_paginated($pagination_config["per_page"], $page);
		$data ["links"] = $this->pagination->create_links();
	  $default_pagination= $this->Config_model->get_default_pagination();
	  $view_data['per_page'] = ($this->uri->segment(4))? $this->uri->segment(4) : $default_pagination;	
	  $view_data['allow_edit'] = $this->has_permission_to_edit();
	  $view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['title']="Permissions";
		$view_data['page_header']= "All Permissions";
		$data= array_merge($view_data, $data);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_permissions_view",$data);
		$this->load->view("footer",$data);		
			}else{
		      redirect ('User/restricted');	
			}
	}
public function show_all_permissions(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$data["results"] = $this->Roles_permissions_model->get_all_permissions();
		$view_data['title']="permissions";
		$view_data['page_header']= "All permissions";
		$data= array_merge($view_data, $data);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_permissions_view",$data);
		$this->load->view("footer",$data);					
			}else{
		      redirect ('User/restricted');	
			}
	}

public function delete($id){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_delete()){
		if ($this->Roles_permissions_model->delete_permission($id)){
			$pagination_config = $this->pagination_setup();
			$this->show_all_permissions_paginated($pagination_config);			
			}else{
			$error = "Unable to delete the permission. Either it doesn't exist or there is something wrong with the database.";
			$this->error_message($error);
			}					
		}else{
		redirect ('User/restricted');	
		}
	} 	
	
public function postValue($id, $column){	//FOR INLINE EDITS
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
			http_response_code(200);
		}else{
			http_response_code(400);
			echo "The database didn't update";
		}}else{
		http_response_code(400);
		 echo strip_tags(validation_errors());
	}
}

public function add(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_add()){
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
			$this->index();
			}else{ 
			echo "Failed to create the new permission.";
			}	
	}else{
	$this->add();
	}}else{
		redirect ('User/restricted');	
		}	 
}
	
public function update($id){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
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
			$this->index();
			}else{ 
			echo "Failed to update the new permission.";
			}	
	}else{
	$this->update($id);
	}}else{
		redirect ('User/restricted');	
		}	
}
	

}