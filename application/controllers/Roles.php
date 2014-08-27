<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {


public function index(){
		$this-> show_all_roles();
	}

public function show_all_roles(){
				if ($this->session->userdata('is_logged_in')){
					$this->load->model('RolesPermissions_model');
					$role_data = $this->RolesPermissions_model->get_all_roles();			
					$view_data['title']="Show All Roles";
					$view_data['page_header']= "All Roles";
					$data= array_merge($view_data, $role_data);
					$this->load->view('show_all_roles_view',$data);	
			}else{
		      redirect ('User/restricted');	
			}
	} 
	
}