<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
filename: Profile.php
Author: Bejan Nouri
Last update: 8-1-2014

Notes- 

This is the "Profile" controller which manages everything related to profile functionality including:


*/

class Profile extends CI_Controller {
	
public function __construct(){
	parent::__construct();
	$this->load->model('User_model');
	$this->load->model('Roles_permissions_model');
	$this->load->model('Config_model');
	$this->load->model('Audit_model');	
}

public function index(){
		$this-> view_profile();
	}

public function view_profile(){
				if ($this->session->userdata('is_logged_in')){
					$email = $this->session->userdata('email');
					$user_data = $this->User_model->get_user_data($email);
					$id = $user_data['id'];
					$row = $user_data['permissions'];
					$permission = array();
					foreach($row as $value){
						 $permission[] =$this->Roles_permissions_model->get_permission($value->id);						
						}
					$view_data['permission'] = $permission;
					$profile_data = $this->User_model->get_user_profile($id);					
					$view_data['title']="User Profile";
					$view_data['page_header']= "User Profile for: <strong>".$user_data['first']." ".$user_data['last']."</strong>";
					$data= array_merge($view_data, $user_data, $profile_data);
					$audit = array('primary' => 'PROF', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'Profile', 'value'=>$id,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	 	         $this->Audit_model->log_entry($audit);
	 	         /*$this->load->library('Pdf');
					$this->pdf->load_view('profile_view',$data);
					$this->pdf->render();
					$this->pdf->stream("profile.pdf");*/	 	         
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
					$audit = array('primary' => 'PROF', 'secondary'=>'UPDV', 'status'=>true,  'controller'=>'Profile', 'value'=>$id,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	 	         $this->Audit_model->log_entry($audit);
					$this->load->view("header",$data);
					$this->load->view("navbar",$data);
					$this->load->view('edit_profile_view',$data);
					$this->load->view("footer",$data);	
			}else{
		      redirect ('User/restricted');	
			}
	} 	
public function profile_validation(){
			$audit_value = json_encode($this->input->post());
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first', 'First Name', 'required|trim');
			$this->form_validation->set_rules('last', 'Last Name', 'required|trim');	
			$this->form_validation->set_rules('zip', 'Zip Code', 'trim|min_length[5]|max_length[10]|xss_clean');
			if ($this->form_validation->run()){
					    $user_data = $this->User_model->get_user_data($this->session->userdata('email'));
						 $id = $user_data['id'];
					    if (($this->User_model->update_user_data())&&($this->User_model->update_user_profile($id))){
					    	$audit = array('primary' => 'PROF', 'secondary'=>'UPDT', 'status'=>true,  'controller'=>'Profile', 'value'=>$audit_value,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	 	               $this->Audit_model->log_entry($audit);
					      $message = "<div class='alert alert-success' role='alert'><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> Profile successfully updated.</div>";
							$this->session->set_flashdata('message',$message);
					     redirect('Profile');
					     }else{
					     $audit = array('primary' => 'PROF', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Profile', 'value'=>$audit_value,  'extra_1' =>'error in updating the profile', 'extra_2'=>null, 'extra_3'=>null);
	 	              $this->Audit_model->log_entry($audit);
					     $error = 'There was an error in loading the user data';
					     $this->error_message($error);
					     }  
			 }else{ //Else if the form is not valid...they didn't enter a field properly or user already exists. Then reload the registration page with the errors.
						$audit = array('primary' => 'PROF', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'Profile', 'value'=>$audit_value,  'extra_1' =>'form validation error', 'extra_2'=>null, 'extra_3'=>null);
	 	            $this->Audit_model->log_entry($audit);
						$this->edit_profile();
			}
}
 
 }




/* End of file proflle.php */
/* Location: ./application/controllers/Profile.php */
