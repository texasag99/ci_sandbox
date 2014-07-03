<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Profile extends CI_Controller {


public function index(){
		$this-> view_profile();
	}

public function view_profile(){
				if ($this->session->userdata('is_logged_in')){
					$this->load->model('User_model');
					$user_data = $this->User_model->get_user_data();
					$id = $user_data['id'];
					$user_profile = $this->User_model->get_user_profile($id);					
					$this->User_model->get_user_data($user_data);
					$view_data['title']="User Profile";
					$view_data['page_header']= "User Profile for: <strong>".$user_data['first']." ".$user_data['last']."</strong>";
					$data= array_merge($view_data, $user_data, $user_profile);
					$this->load->view('profile_view',$data);	
			}else{
		      redirect ('User/restricted');	
			}
	} 
	
public function edit_profile(){
				if ($this->session->userdata('is_logged_in')){
					$this->load->model('User_model');
					$user_data = $this->User_model->get_user_data();
					$id = $user_data['id'];
					$user_profile = $this->User_model->get_user_profile($id);					
					$this->User_model->get_user_data($user_data);
					$view_data['title']="Edit My Profile";
					$view_data['page_header']= "User Profile for: <strong>".$user_data['first']." ".$user_data['last']."</strong>";
					$data= array_merge($view_data, $user_data, $user_profile);
					$this->load->view('edit_profile_view',$data);	
			}else{
		      redirect ('User/restricted');	
			}
	} 
	
	
	public function profile_validation(){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first', 'First Name', 'required|trim');
			$this->form_validation->set_rules('last', 'Last Name', 'required|trim');			
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]|is_unique[temp_user.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');
			$this->form_validation->set_rules('confirm_password','Confirm Password', 'required|trim|matches[password]');
			$this->form_validation->set_message('is_unique',"The user email already exists.");
			if ($this->form_validation->run()){
					    
//I NEED TO WORK ON THIS!!!!!!!!!!!!!!!!!!!!!!!!
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!111


			   }else{ //Else if the form is not valid...they didn't enter a field properly or user already exists. Then reload the registration page with the errors.
						
						$this->edit_profile();
			}
}
 
 public function error_message($error){
         $data['title']="There is a problem!";
	      $data['page_header']="<span id='error'>There is a problem!</span>";
	      $data['error_message']= $error;
			$this->load->view('There_is_a_problem_view',$data); 
 }



}
/* End of file user.php */
/* Location: ./application/controllers/Profile.php */
