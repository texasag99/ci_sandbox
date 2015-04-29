<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

public function index(){
		$this-> view_profile();
	}

public function view_profile(){
				if ($this->session->userdata('is_logged_in')){
					$this->load->model('User_model');
					$this->load->model('Roles_permissions_model');
					$email = $this->session->userdata('email');
					$user_data = $this->User_model->get_user_data($email);
					$id = $user_data['id'];
					$row = $user_data['permissions'];
					$permission = array();
					$counter = 0;
					foreach($row as $value){
						 $permission[] =$this->Roles_permissions_model->get_permission($value->id);						
						}
					$view_data['permission'] = $permission;
					$profile_data = $this->User_model->get_user_profile($id);					
					$view_data['title']="User Profile";
					$view_data['page_header']= "User Profile for: <strong>".$user_data['first']." ".$user_data['last']."</strong>";
					$data= array_merge($view_data, $user_data, $profile_data);
					$this->load->view("header",$data);
					$this->load->view("navbar",$data);
					$this->load->view('profile_view',$data);
					$this->load->view("footer",$data);	
			}else{
		      redirect ('User/restricted');	
			}
	} 	
public function edit_profile(){
				if ($this->session->userdata('is_logged_in')){
					$this->load->model('User_model');
					$email = $this->session->userdata('email');
					$user_data = $this->User_model->get_user_data($email);
					$id = $user_data['id'];
					$profile_data = $this->User_model->get_user_profile($id);					
					$this->load->helper('common');
					$view_data['statelist'] = get_states();
					$view_data['countries'] = get_countries();
					$view_data['title']="Edit My Profile";
					$view_data['page_header']= "User Profile for: <strong>".$user_data['first']." ".$user_data['last']."</strong>";
					$data= array_merge($view_data, $user_data, $profile_data);
					$this->load->view("header",$data);
					$this->load->view("navbar",$data);
					$this->load->view('edit_profile_view',$data);
					$this->load->view("footer",$data);	
			}else{
		      redirect ('User/restricted');	
			}
	} 	
public function profile_validation(){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first', 'First Name', 'required|trim');
			$this->form_validation->set_rules('last', 'Last Name', 'required|trim');	
			$this->form_validation->set_rules('zip', 'Zip Code', 'trim|min_length[5]|max_length[10]|xss_clean');
			if ($this->form_validation->run()){
					    $this->load->model('User_model');
					    $user_data = $this->User_model->get_user_data($this->session->userdata('email'));
						 $id = $user_data['id'];
					    if (($this->User_model->update_user_data())&&($this->User_model->update_user_profile($id))){
					     echo "User data updated properly!";
					     redirect('Profile');
					     }else{
					     $error = 'There was an error in loading the user data';
					     $this->error_message($error);
					     }  
			 }else{ //Else if the form is not valid...they didn't enter a field properly or user already exists. Then reload the registration page with the errors.
						$this->edit_profile();
			}
}
 
 }




/* End of file proflle.php */
/* Location: ./application/controllers/Profile.php */
