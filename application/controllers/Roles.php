<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->model("Roles_permissions_model");
	$this->load->library('pagination');
	$this->load->model('Config_model');	
}


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

public function index(){
		$this-> show_all_roles_paginated(0, 0);
	}


public function pagination_setup(){		
	$default_pagination= $this->Config_model->get_default_pagination();
	$per_page = ($this->uri->segment(4))? $this->uri->segment(4) : $default_pagination;	
	$pagination_config = array();
	$pagination_config["base_url"] = base_url()."Roles/show_all_roles_paginated/0/".$per_page;
	$pagination_config["total_rows"] = $this->Roles_permissions_model->roles_record_count();
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
	
public function show_all_roles_paginated($pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup();
		}
		$page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;		
		$data["results"] = $this->Roles_permissions_model->get_all_roles_paginated($pagination_config["per_page"], $page);
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
 	   $view_data['per_page'] = ($this->uri->segment(4))? $this->uri->segment(4) : $default_pagination;	
		$view_data['title']="Roles";
		$view_data['page_header']= "All Roles";
		$data= array_merge($view_data, $data);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_roles_view",$data);
		$this->load->view("footer",$data);				
			}else{
		      redirect ('User/restricted');	
			}
	} 

public function show_all_roles(){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$data["results"] = $this->Roles_permissions_model->get_all_roles();
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['title']="Roles";
		$view_data['page_header']= "All Roles";
		$data= array_merge($view_data, $data);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_roles_view",$data);
		$this->load->view("footer",$data);		
			}else{
		      redirect ('User/restricted');	
			}
	}

public function delete($id){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_delete()){
		if ($this->Roles_permissions_model->delete_role($id)){
			$pagination_config = $this->pagination_setup();
			$this->show_all_roles_paginated($pagination_config);			
			}else{
			$error = "Unable to delete the role. Either it doesn't exist or there is something wrong with the database.";
			$this->error_message($error);
			}					
		}else{
		redirect ('User/restricted');	
		}
	} 
		
public function postValue($id, $column){	//FOR INLINE EDITSpublic function link_role_permission($role_id, $permission_id){
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
	$data['title']="Add a role";
	$data['page_header']="Add a role";
	$this->load->view("header",$data);
	$this->load->view("navbar",$data);
	$this->load->view('add_role_view',$data);
	$this->load->view("footer",$data);		
}
}

public function add_validation(){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_add()){
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
			$this->index();
			}else{ 
			echo "Failed to create the new role.";
			}	
	}else{
	$this->add();
	}	 
}
}
	
public function update($id){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
	$data['results']= $this->Roles_permissions_model->get_role($id);
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
	$selecte_permission[5] = 1833;
   $data['id'] = $id;
   $data['active']=$active_permissions;
   $data['selected']=$selected_permissions;
	$data['title']="Edit the role";
	$data['page_header']="Edit the role";
	$this->load->view("header",$data);
	$this->load->view("navbar",$data);
	$this->load->view('edit_role_view',$data);
	$this->load->view("footer",$data);
}
}

public function update_validation(){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
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
			$this->index();
			}else{ 
			echo "Failed to update the new role.";
			}	
	}else{
	$this->update();
	}
}
}

private function link_role_permission($role_id, $permission_id){
	if($this->Roles_permissions_model->link_role_permission($role_id, $permission_id)){
		echo "You successfully linked permission_id: ".$permission_id." with role_id: ".$role_id;
	}else{
		echo "it didn't work";
	}
}
	
private function unlink_role_permission($role_id, $permission_id){
	if($this->Roles_permissions_model->unlink_role_permission($role_id, $permission_id)){
		echo "You successfully unlinked permission_id: ".$permission_id." with role_id: ".$role_id;
	}else{
		echo "it didn't work";
	}
}

}