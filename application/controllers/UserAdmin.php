<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Filename : controllers/UserAdmin.php
 * Author : BEJAN NOURI
 * Date : 2-26-2015
 * Summary: Controls the back office management of users.
 * */
 
 
class UserAdmin extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->model('User_model');
	$this->load->model('Roles_permissions_model');
	$this->load->library('pagination');
	$this->load->model('Config_model');	
}

public function index(){
		$this-> show_all_active_users_paginated(0, 0, 0);
	}

private function has_permission_to_view(){
	$all_permissions = $this->session->userdata('permissions');
	$permission = array();
	foreach ($all_permissions as $value){
			$permission[]= $value->id;				
		}
	if( in_array(9005, $permission) ||in_array(9999, $permission)){
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
	if( in_array(9010, $permission) ||in_array(9999, $permission)){
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
	if( in_array(9020, $permission) ||in_array(9999, $permission)  ){
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
	if( in_array(9015, $permission) ||in_array(9999, $permission)  ){
    return true;
    	}else{
    	return false;
    	}
}

private function pagination_setup(){		
	$default_pagination= $this->Config_model->get_default_pagination();
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	$pagination_config = array();
	$pagination_config["base_url"] = base_url()."UserAdmin/show_all_users_paginated/0/0/".$per_page;
	$pagination_config["total_rows"] = $this->User_model->user_record_count();
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
public function show_all_users_paginated($sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup();
		}
		$page = ($this->uri->segment(6))? $this->uri->segment(6) : 0;	
		$data["results"] = $this->User_model->get_all_users_paginated($pagination_config["per_page"], $page, $sort_by);
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
	  $view_data['per_page'] = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	  $view_data['sort_by'] = $this->uri->segment(3); 
		$view_data['title']="Users";
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['page_header']= "All Users";
		$data= array_merge($view_data, $data);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_users_view",$data);
		$this->load->view("footer",$data);
		$this->benchmark->mark('code_end');
		echo "<div class='elapsed'>".$this->benchmark->elapsed_time('code_start','code_end')." seconds elapsed.</div>";					
			}else{
		      redirect ('User/restricted');	
			}
	} 
public function show_all_active_users_paginated($sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup();
		}
		$page = ($this->uri->segment(6))? $this->uri->segment(6) : 0;	
		$data["results"] = $this->User_model->get_all_active_users_paginated($pagination_config["per_page"], $page, $sort_by);
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
	   $view_data['per_page'] = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	   $view_data['sort_by'] = $this->uri->segment(3); 
		$view_data['title']="Users";
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['page_header']= "All Users";
		$data= array_merge($view_data, $data);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_all_active_users_view",$data);
		$this->load->view("footer",$data);
		$this->benchmark->mark('code_end');
		echo "<div class='elapsed'>".$this->benchmark->elapsed_time('code_start','code_end')." seconds elapsed.</div>";					
			}else{
		      redirect ('User/restricted');	
			}
	}	
public function delete($id){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_delete()){
		if ($this->User_model->delete_user($id)){
			$this->index();	
			}else{
			$error = "Unable to delete the user. Either it doesn't exist or there is something wrong with the database.";
			$this->error_message($error);
			}					
		}else{
		redirect ('User/restricted');	
		}
	} 
public function postValue($id, $column){	//FOR INLINE EDITS 
if ($this->session->userdata('is_logged_in')){	
	$this->load->library('form_validation');
	if($column=='email'){
		$this->form_validation->set_rules('value', 'Email', 'required|trim|valid_email|is_unique[user.email]|is_unique[temp_user.email]');
		$this->form_validation->set_message('is_unique','The email already exists.');}
	if($column=='first'){$this->form_validation->set_rules('value', 'First Name', 'required|trim');}
	if($column=='last'){$this->form_validation->set_rules('value', 'Last Name', 'required|trim');}
	if($column=='status'){$this->form_validation->set_rules('value', 'Status', 'required|trim');}
	if($column=='locked'){$this->form_validation->set_rules('value', 'Status', 'required|trim');}
	if ($this->form_validation->run() && $this->has_permission_to_edit()){
		if($column=='email'){$data = array('email'=>$this->input->post('value'));}
		if($column=='first'){$data = array('first'=>$this->input->post('value'));}
		if($column=='last'){$data = array('last'=>$this->input->post('value'));}
		if($column=='status'){$data = array('status'=>$this->input->post('value'));}
		if($column=='locked'){$data = array('locked'=>$this->input->post('value'));}
		$data['last_updated'] = date("Y-m-d H:i:s");
		if ($this->User_model->update_user_value($data, $id)){
			http_response_code(200);
		}else{
			http_response_code(400);
			echo "The database didn't update";
		}}else{
		http_response_code(400);
		 echo strip_tags(validation_errors());
	}
}else{
		redirect ('User/restricted');	
		}
}

public function add(){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_add()){	
	$data['title']="Add a user";
	$data['page_header']="Add a user";
	$this->load->helper('common');
	$data['statelist'] = get_states();
	$data['countries'] = get_countries();
	$this->load->view("header",$data);
	$this->load->view("navbar",$data);
	$this->load->view('add_user_view',$data);
	$this->load->view("footer",$data);
}else{
		redirect ('User/restricted');	
		}
}

public function add_validation(){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_add()){
	$this->load->library('form_validation');
	$this->form_validation->set_rules('first', 'First Name', 'required|trim');
	$this->form_validation->set_rules('last', 'Last Name', 'required|trim');			
	$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]|is_unique[temp_user.email]');
	$this->form_validation->set_rules('password', 'Password', 'required|trim');
	$this->form_validation->set_rules('confirm_password','Confirm Password', 'required|trim|matches[password]');
	$this->form_validation->set_message('is_unique',"The user email already exists.");
  $this->form_validation->set_rules('zip', 'Zip Code', 'trim|min_length[5]|max_length[10]|xss_clean');
	if ($this->form_validation->run()){
			$user_data = array(
								'first'=>$this->input->post('first'),
								'last'=>$this->input->post('last'),
								'email'=>$this->input->post('email'),
								'password'=>md5($this->input->post('password')),
								'status'=>$this->input->post('status')
			);
		if($this->User_model->create_new_user($user_data)){
			$user = $this->User_model->get_user_data($user_data['email']);
			$id = $user['id'];
			if($this->User_model->create_new_profile($id)){
				if($this->User_model->update_user_profile($id)){ 
				$this->index();
				}else{
					echo "failed to add profile data.";
					$this->index();
					}
				}else{
					echo "failed to create new profile.";
					$this->index();
					}
			}else{ 
			echo "Failed to create the new user.";
			$this->add();
			}	
	}else{
	$this->add();
	}	 
}else{
		redirect ('User/restricted');	
		}
}
	
public function update($id){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
	$user_data = $this->User_model->get_user($id);
	$profile_data = $this->User_model->get_user_profile($id);
	$data = array_merge($user_data, $profile_data);
	$this->load->helper('common');
	$data['statelist'] = get_states();
	$data['countries'] = get_countries();
	$lookup['selected_roles'] = $this->User_model->list_user_roles($id);
	$lookup['active_roles'] = $this->Roles_permissions_model->list_active_roles();	
	$active_roles = array();
	foreach($lookup['active_roles'] as $role){
  	$role_id=$role->id;
	$role = $role->role;  
	$active_roles[$role_id] = $role;
  	}	
  	$selected_roles = array();	
	foreach($lookup['selected_roles'] as $role){
	$selected_roles[] = $role->role_id;
	}
  $data['id'] = $id;
  $data['active']=$active_roles;
  $data['selected']=$selected_roles;
	$data['title']="Edit the user";
	$data['page_header']="Edit the user";
	$this->load->view("header",$data);
	$this->load->view("navbar",$data);
	$this->load->view('edit_user_view',$data);
	$this->load->view("footer",$data);
}else{
		redirect ('User/restricted');	
		}
}

public function update_validation(){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
	$id = $this->input->post('id');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('first', 'First Name', 'required|trim');
	$this->form_validation->set_rules('last', 'Last Name', 'required|trim');			
   if($this->need_to_validate_email($id)){ //if the email in the post is the same one, then we don't need to validate it.
	$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]|is_unique[temp_user.email]');
    }
  $pw=$this->input->post('password'); 
  	if(isset($pw) && !empty($pw)){//if nothing was entered into the password field then we don't need to worry about it.
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
	  $this->form_validation->set_rules('confirm_password','Confirm Password', 'required|trim|matches[password]');
		}
  $this->form_validation->set_message('is_unique',"The user email already exists.");
  $this->form_validation->set_rules('zip', 'Zip Code', 'trim|min_length[5]|max_length[10]|xss_clean');
	
	if($this->form_validation->run()){
		$user_data = array(
								'first'=>$this->input->post('first'),
								'last'=>$this->input->post('last'),
								'email'=>$this->input->post('email'),
								'status'=>$this->input->post('status'),
								'last_updated'=>date("Y-m-d H:i:s")
			);
		if (isset($pw) && !empty($pw)){
			$user_data['password'] = md5($this->input->post('password'));
			}
	   if($this->User_model->update_user_value($user_data, $id)){
	   	if($this->User_model->update_user_profile($id)){ 
		  $roles = $this->input->post('roles');
	    if(isset($roles) && !empty($roles)){
	    	if($this->User_model->unlink_all_roles_to_user($id) && $this->User_model->link_multiple_roles_to_user($id, $roles)){
		  $this->index();//SUCCESS 
				}else{
					echo "failed to link roles to user.";
					$this->update($id);
					}				
				}else{
					$this->index();//SUCCESS BUT NO ROLES LINKED
					}
				}else{
					echo "failed to update profile data.";
					$this->update($id);
				}}else{
					echo "failed to update the user.";
					$this->update($id);
					}
			}else{
			$this->update($id);
	}	 
}else{
		redirect ('User/restricted');	
		}
}

private function need_to_validate_email($id){	 //TO UPDATE  A USER RECORD, SO YOU CAN STILL INPUT THE SAME EMAIL AND PASS VALIDATION, BUT NOT ONE THAT IS ALREADY IN USE.
   $user_data = $this->User_model->get_user($id);
   $current_email = $user_data['email'];
   if($current_email == $this->input->post('email')){
   	return false;
   	}else{
   	return true;
   }
   }
  



}