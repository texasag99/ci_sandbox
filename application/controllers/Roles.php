<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->model("Roles_permissions_model");
	$this->load->library('pagination');
	$this->load->model('Config_model');
	
	
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
	$this->pagination->initialize($pagination_config);
	return $pagination_config;	
}	
	
public function show_all_roles_paginated($pagination_config){
	if ($this->session->userdata('is_logged_in')){
		$this->load->helper("url");
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup();
		}
		$page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;		
		$data["results"] = $this->Roles_permissions_model->get_all_roles_paginated($pagination_config["per_page"], $page);
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
	    $view_data['per_page'] = ($this->uri->segment(4))? $this->uri->segment(4) : $default_pagination;	
		$view_data['title']="Roles";
		$view_data['page_header']= "All Roles";
		$data= array_merge($view_data, $data);
		$this->load->view("show_all_roles_view",$data);					
			}else{
		      redirect ('User/restricted');	
			}
	} 

public function show_all_roles(){
	if ($this->session->userdata('is_logged_in')){
		$data["results"] = $this->Roles_permissions_model->get_all_roles();
		$view_data['title']="Roles";
		$view_data['page_header']= "All Roles";
		$data= array_merge($view_data, $data);
		$this->load->view("show_all_roles_view",$data);					
			}else{
		      redirect ('User/restricted');	
			}
	}

public function delete($id){
	if ($this->session->userdata('is_logged_in')){
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
	
	
public function postValue($id, $column){	
	$this->load->library('form_validation');
	if($column=='role'){
		$this->form_validation->set_rules('value', 'Role name', 'required|trim|is_unique[roles.role]');
		$this->form_validation->set_message('is_unique','The role already exists.');}
	if($column=='description'){$this->form_validation->set_rules('value', 'Description', 'required|trim');}
	if($column=='status'){$this->form_validation->set_rules('value', 'Status', 'required|trim');}
	if ($this->form_validation->run()){
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
	$data['title']="Add a role";
	$data['page_header']="Add a role";
	$this->load->view('add_role_view',$data);
}

public function add_validation(){
		$this->load->library('form_validation');
	$this->form_validation->set_rules('role', 'Role Name', 'required|trim|is_unique[roles.role]');
	$this->form_validation->set_rules('description', 'Description', 'required|trim');
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
/*	
public function update_validation(){
	$this->load->library('form_validation');
	$this->form_validation->set_rules('description', 'Description', 'required|trim');
	$this->form_validation->set_rules('status', 'Status', 'required|trim');
	$this->form
}
*/
}