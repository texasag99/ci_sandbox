<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
filename: User.php
Author: Bejan Nouri
Last update: 7-12-2014

Notes- 

This is the "User" controller which manages everything related to user functionality including:
- login/logout
- change password
- set user session data
- initial user registration and setup
- forgot my password 
*/

class User extends CI_Controller {
	
public function __construct(){
	parent::__construct();
	$this->load->model('User_model');
	$this->load->model('Audit_model');
	$this->load->model('Config_model');	
}
	
private function allow_registration(){	
	$allow_registration = $this->Config_model->get_allow_registration();
	if  ($allow_registration == 1){
		return true; 
		}else{
		return false;
		}
}

public function index(){
		$this->login();
	}

public function login(){
		$data['title']='Login';
		$data['page_header']='Login';
		$data['allow_registration'] = $this->allow_registration();
		$audit = array('primary' => 'USER', 'secondary'=>'LOGV', 'status'=>true,  'controller'=>'User', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view('login_view',$data);
		$this->load->view("footer",$data);		
	}

public function logout(){	
	$audit = array('primary' => 'USER', 'secondary'=>'LOGO', 'status'=>true,  'controller'=>'User', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);
	$this->session->sess_destroy();
	redirect('User/login');
}

public function login_validation(){
	   $audit_value = json_encode(array('email'=>$this->input->post('email'), 'password'=>'*****'.substr($this->input->post('password'),2)));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');		
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');
		if($this->form_validation->run())	{			   
			   $user_data = $this->User_model->get_user_data($this->input->post('email'));			   
			   $permissions = $user_data['permissions'];
			   $profile_pic = $user_data['profile_pic'];
			   $pwd_last_updated = $user_data['pwd_last_updated'];
			   $name = $user_data['first'].' '.$user_data['last'];
			   if($this->pwd_needs_to_change($pwd_last_updated)){			   
			   $data = array(
						'email' => $this->input->post('email'),
						'is_logged_in' => 0,
						'requires_pwd_change' => 1,
						'name' => $name,
						'permissions' => $permissions,						
						'profile_pic' => $profile_pic			
				);
			  $this->session->set_userdata($data);
			  $this->change_password();
			   }else{	
			   $data = array(
						'email' => $this->input->post('email'),
						'is_logged_in' => 1,
						'requires_pwd_change' => 0,
						'name' => $name,
						'permissions' => $permissions,
						'profile_pic' => $profile_pic					
				);
			  $this->session->set_userdata($data);
			  $audit = array('primary' => 'USER', 'secondary'=>'LOGN', 'status'=>true,  'controller'=>'User', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
			  $this->Audit_model->log_entry($audit);
			  redirect('Profile');
		   }}else{		   	
		   	$audit = array('primary' => 'USER', 'secondary'=>'FAIL', 'status'=>false,  'controller'=>'User', 'value'=>$audit_value,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
				$this->Audit_model->log_entry($audit);
			   $this->login();					
		   }
	}

public function registration(){
	if($this->allow_registration()){
	$data['title']="Site Registration";
	$data['page_header']="Site Registration";
	$audit = array('primary' => 'USER', 'secondary'=>'REGV', 'status'=>true,  'controller'=>'User', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);
	$this->load->view("header",$data);
	$this->load->view("navbar",$data);
	$this->load->view('registration_view',$data);
	$this->load->view("footer",$data);
	}else{
		$audit = array('primary' => 'USER', 'secondary'=>'REGV', 'status'=>0,  'controller'=>'User', 'value'=>'registration closed',  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$message = "<div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> Open user registration is not available!</p></div>";
	   $this->session->set_flashdata('message',$message);
		redirect('User/login');		 		
	}
}

public function registration_validation(){
	if($this->allow_registration()){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first', 'First Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('last', 'Last Name', 'required|trim|xss_clean');			
			$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|is_unique[user.email]|is_unique[temp_user.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
			$this->form_validation->set_rules('confirm_password','Confirm Password', 'required|trim|matches[password]');
			$this->form_validation->set_message('is_unique',"The user email already exists.");
			if ($this->form_validation->run()){
					//create audit entry for registration attempt
					$audit_value = json_encode(array('first'=>$this->input->post('first'),'last'=>$this->input->post('last'),'email'=>$this->input->post('email'), 'password'=>'*****'.substr($this->input->post('password'),4)));
			   	$audit = array('primary' => 'USER', 'secondary'=>'REGR', 'status'=>true,  'controller'=>'User', 'value'=>$audit_value,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
					$this->Audit_model->log_entry($audit);
				
					    //generate a random key
						$key = md5(uniqid());
						   //add the user info to the db, build the email and send and email to the new user
						//$this->load->library('email');
						$this->Config_model->initialize_email_settings();
						$from_email = $this->Config_model->get_from_email();
						$from_name = $this->Config_model->get_from_name();
						$this->email->from($from_email, $from_name);
						$this->email->to($this->input->post('email'))	;
						$this->email->subject('Confirm your account!');
						$message = "<p>Thank you for signing up</p>";
						$message .= "<p><a href='".base_url()."User/confirm_registration/$key'>Click Here</a> to confirm your account.</p>";		    
						$this->email->message($message);						
						$data = array(
								'email'=>$this->input->post('email'),
								'temp_key'=>$key
						);
						if($this->User_model->register_new_user($data)){
							if ($this->email->send()){
									$message = "<div class='alert alert-info'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> A confirmation email has been sent to the new registered user.</p></div>";
		 							$this->session->set_flashdata('message',$message);
									 redirect('User/login');		 		
								}else{ 
									$error = "<p><span id='error'>The email failed to send..</span> <br><br>  Please contact the system administrator.";      
									$this->error_message($error);
								}	
						}else{
							$audit_value = json_encode(array('first'=>$this->input->post('first'),'last'=>$this->input->post('last'),'email'=>$this->input->post('email'), 'password'=>'*****'.substr($this->input->post('password'),4)));
				   		$audit = array('primary' => 'USER', 'secondary'=>'REGR', 'status'=>false,  'controller'=>'User', 'value'=>$audit_value,  'extra_1' =>'db_failure', 'extra_2'=>null, 'extra_3'=>null);
							$this->Audit_model->log_entry($audit);							
							$error = "<p><span id='error'>There is a problem inserting the new user information in the database. </span> <br><br>  Please contact the system administrator.";      
							$this->error_message($error);
						}	 
			   }else{ //Else if the form is not valid...they didn't enter a field properly or user already exists. Then reload the registration page with the errors.
			        //create audit entry for registration failure
						$audit_value = json_encode(array('first'=>$this->input->post('first'),'last'=>$this->input->post('last'),'email'=>$this->input->post('email'), 'password'=>'*****'.substr($this->input->post('password'),4)));
				   	$audit = array('primary' => 'USER', 'secondary'=>'REGR', 'status'=>false,  'controller'=>'User', 'value'=>$audit_value,  'extra_1' =>'not_valid', 'extra_2'=>null, 'extra_3'=>null);
						$this->Audit_model->log_entry($audit);
						$this->registration();
			}
			}else{
		 $message = "<div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> Open user registration is not available!</p></div>";
		 $this->session->set_flashdata('message',$message);
		  redirect('User/login');		 		
	}
}

public function confirm_registration($key){
if($this->allow_registration()){
	$return_values = false;
	if ($this->User_model->confirm_key($key, $return_values)){
		$return_values = true;
		$audit_value = json_encode($this->User_model->confirm_key($key, $return_values));		
		if ($this->User_model->activate_new_user($key)){
			$audit = array('primary' => 'USER', 'secondary'=>'CREA', 'status'=>true,  'controller'=>'User', 'value'=>$audit_value,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);
			$data['title']="User Activated!";
			$data['page_header']="You have successfully activated your account!"	;	
			$this->load->view("header",$data);
		   $this->load->view("navbar",$data);	
			$this->load->view('user_activated_view',$data);
			$this->load->view("footer",$data);				
		}else {
				$audit = array('primary' => 'USER', 'secondary'=>'CREA', 'status'=>false,  'controller'=>'User', 'value'=>$audit_value,  'extra_1' =>'db_error', 'extra_2'=>null, 'extra_3'=>null);
				$this->Audit_model->log_entry($audit);
			   $error = "<p><span id='error'>There is a problem with activating the new user. </span> Please contact the system administrator</p>";
				$this->error_message($error);
		}
	} else{
				$audit = array('primary' => 'USER', 'secondary'=>'BKEY', 'status'=>false,  'controller'=>'User', 'value'=>'{"bad_key"}:{"'.$key.'"}', 'extra_1' =>'bad_key_registration', 'extra_2'=>null, 'extra_3'=>null);
				$this->Audit_model->log_entry($audit);
	         $error = "<p><span id='error'>The activation key is not valid!</span> <br><br> Did you already activate the account?<br><br>
	         You are receiving this error because the registration key is no longer valid and may be because you already activated the account or 
	         the URL link has been altered in some way. Please contact a system administrator for further assistance.</p>";
				$this->error_message($error);
			} 
			}else{
		$message = "<div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> Open user registration is not available!</p></div>";
		$this->session->set_flashdata('message',$message);
		redirect('User/login');		 		
	}
}

public function validate_credentials(){
		  if ($this->User_model->can_log_in()){
		      if($this->User_model->is_active()){
		      	if($this->User_model->is_unlocked()){
		      		$this->User_model->update_last_activity();
		      		return true;
		      	}else{
		      		$this->form_validation->set_message('validate_credentials','User is locked.');
		      		$audit = array('primary' => 'USER', 'secondary'=>'LCKD', 'status'=>false,  'controller'=>'User', 'value'=>$this->input->post('email'),  'extra_1' =>'user_locked', 'extra_2'=>null, 'extra_3'=>null);
						$this->Audit_model->log_entry($audit);
		      		return false;
		      	}
		      }else{
		      	$this->form_validation->set_message('validate_credentials','User has not been activated.');
		      	$audit = array('primary' => 'USER', 'secondary'=>'INAC', 'status'=>false,  'controller'=>'User', 'value'=>$this->input->post('email'),  'extra_1' =>'user_inactive', 'extra_2'=>null, 'extra_3'=>null);
					$this->Audit_model->log_entry($audit);
		      	return false;
		      }
	     }else{
		     $this->form_validation->set_message('validate_credentials', 'Invalid email/password.');
			  return false;
	     }
 }
 
public function forgot_my_password(){
	$data['title']="Forgot My Password";
	$data['page_header']="Forgot My Password";
	$this->load->view("header",$data);
	$this->load->view("navbar",$data);
	$this->load->view('fmp_view',$data);
	$this->load->view("footer",$data);
}

public function fmp_email_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_verify_email');
		$this->form_validation->set_message('verify_email', 'This is not a valid email');		
		if($this->form_validation->run()){
					$audit = array('primary' => 'USER', 'secondary'=>'FMP', 'status'=>true,  'controller'=>'User', 'value'=>$this->input->post('email'),  'extra_1' =>'user fmp initiated', 'extra_2'=>null, 'extra_3'=>null);
					$this->Audit_model->log_entry($audit);
				//generate a random key
						$key = md5(uniqid());
						   //add the user info to the db, build the email and send and email to the new user
						//$this->load->library('email');
						$this->Config_model->initialize_email_settings();
						$from_email = $this->Config_model->get_from_email();
						$from_name = $this->Config_model->get_from_name();
						$this->email->from($from_email, $from_name);
						$email = $this->input->post('email');
						$this->email->to($email);
						$this->email->subject('Forgot My Password');
						$message = "<p>This email has been sent to reset your password</p>";
						$message .= "<p><a href='".base_url()."User/fmp_confirm/$key'>Click Here</a> to create a new password.</p>";		    
						$this->email->message($message);						
						$data = array(
								'email'=>$this->input->post('email'),
								'temp_key'=>$key
						);
						if($this->User_model->register_new_password($data) && $this->email->send()){
									 $message = "<div class='alert alert-info'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> An email has been sent to ".$email." in order to request this change!</p></div>";
					   			 $this->session->set_flashdata('message',$message);
					   			 redirect('User/login');
								}else{ 
								   $audit = array('primary' => 'USER', 'secondary'=>'FMP', 'status'=>false,  'controller'=>'User', 'value'=>$this->input->post('email'),  'extra_1' =>'user fmp email failed', 'extra_2'=>null, 'extra_3'=>null);
									$this->Audit_model->log_entry($audit);
									$message = "<div class='alert alert-danger'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> The email failed to send. Please notify the system administrator.</p></div>";
					   			$this->session->set_flashdata('message',$message);
					   			redirect('User/login');
								}	 
		   }else{
		   	$audit = array('primary' => 'USER', 'secondary'=>'FMP', 'status'=>false,  'controller'=>'User', 'value'=>$this->input->post('email'),  'extra_1' =>'user fmp invalid email', 'extra_2'=>null, 'extra_3'=>null);
				$this->Audit_model->log_entry($audit);
			   $this->forgot_my_password();					
		   }
}

public function verify_email(){
	$email= $this->input->post('email');
	if ($this->User_model->verify_email($email)){
				return true; 
				}else{
				return false;
				}

}

public function ajax_verify($type, $value){
	$type = strtolower(trim($type));
	$value = (trim($value));
	$output = ['exists' => false];
	if(in_array($type, ['email'])){
		switch($type){
			case 'email':
			    $value = str_replace("-","@", $value); //because the '@' cannot be passed in the URI, I am using the '-' symbol and replacing it here.
				 $check = $this->User_model->verify_email($value);
			    $output['exists'] = $check;
				echo json_encode($output);
			break;			
		}	
	}
}

public function fmp_confirm($key){
  $return_values = true;
  $temp_data = $this->User_model->confirm_key($key, $return_values);
	if (isset($temp_data) && $temp_data != false){
//need to put the information to remove the $key and then call the fmp_create_new_password view...
		$data['title'] = 'Enter new password';
		$data['page_header'] = 'Enter new password';
		$data['key'] = $key;
		$data['email'] = $temp_data ['email'];
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view('fmp_createpassword_view', $data);
		$this->load->view("footer",$data);		
	} else{
	$audit = array('primary' => 'USER', 'secondary'=>'BKEY', 'status'=>false,  'controller'=>'User', 'value' =>'{"bad_key"}:{"'.$key.'"}', 'extra_1'=>'bad key fmp', 'extra_2'=>null, 'extra_3'=>null );
	$this->Audit_model->log_entry($audit);
	$this->session->sess_destroy();
   $error = "<p><span id='error'>The activation key is not valid!</span> <br><br> Did you already activate the password?<br><br>
   You are receiving this error because the registration key is no longer valid and may be because you already activated the new password or 
   the URL link has been altered in some way. Please contact a system administrator for further assistance.</p>";
	$this->error_message($error);
	} 
}

public function fmp_password_validation(){
		   $audit_value = json_encode(array('key'=>$this->input->post('key'),'email'=>$this->input->post('email'), 'password'=>'*****'.substr($this->input->post('password'),2)));
			$key = $this->input->post('key');
			$this->load->library('form_validation');		
			$this->form_validation->set_rules('key', 'Key', 'required|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
			$this->form_validation->set_rules('confirm_password','Confirm Password', 'required|trim|matches[password]');
			if ($this->form_validation->run()){							
						$audit = array('primary' => 'USER', 'secondary'=>'FMPC', 'status'=>true,  'controller'=>'User', 'value'=>$audit_value,  'extra_1' =>'(fmp) password successfully changed', 'extra_2'=>null, 'extra_3'=>null);
						$this->Audit_model->log_entry($audit);
						//$this->load->library('email');
						$this->Config_model->initialize_email_settings();
						$from_email = $this->Config_model->get_from_email();
						$from_name = $this->Config_model->get_from_name();
						$this->email->from($from_email, $from_name);
						$this->email->to($this->input->post('email'))	;
						$this->email->subject('You Successfully Updated Your Password');
						$message = "<p>Thank you for changing your password.</p>";
						$message .= "<p>If you feel you have received this email in error, Please notify the system administrator.</p>";		    
						$this->email->message($message);						
						if($this->User_model->activate_new_password($key)){
							if ($this->email->send()){
								  $message = "<div class='alert alert-success'  role='alert'><p><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> The password has been successfully changed. Please log back in.</p></div>";
					           $this->session->set_flashdata('message',$message);
									redirect('User/login');
								}else{ 
								  $message = "<div class='alert alert-success'  role='alert'><p><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> The password has been successfully changed. Please log back in. <strong>Email notification failed to send.</strong></p></div>";
					           $this->session->set_flashdata('message',$message);
									redirect('User/login');
								}	
						}else{							
							$audit = array('primary' => 'USER', 'secondary'=>'FMP', 'status'=>false,  'controller'=>'User', 'value'=>$audit_value,  'extra_1' =>'database error', 'extra_2'=>null, 'extra_3'=>null);
							$this->Audit_model->log_entry($audit);
							$error = "<p>There is a problem inserting the new user information in the database. Please notify the system administrator.</p>";
							$this->error_message($error);
						}	 
			   }else{ //Else if the form is not valid...they didn't enter a field properly or user already exists. Then reload the  page with the errors.
						$audit = array('primary' => 'USER', 'secondary'=>'FMP', 'status'=>false,  'controller'=>'User', 'value'=>$audit_value,  'extra_1' =>'form validation error', 'extra_2'=>null, 'extra_3'=>null);
						$this->Audit_model->log_entry($audit);						
						$this->fmp_confirm($key);
			}

}
 
private function pwd_needs_to_change($pwd_last_updated){
	$days_allowed = $this->Config_model->get_reset_pwd_days();
	if ($days_allowed >0){
	$start_date = new DateTime($pwd_last_updated);	
	$finish_date = new DateTime('NOW');
	$days_elapsed = $start_date->diff($finish_date)->days;
	if ($days_elapsed >= $days_allowed){
	return true;		
		}else{
	return false;
	}}else{
  return false;	
	}
}
	 
public function change_password(){
				if ($this->session->userdata('is_logged_in') || $this->session->userdata('requires_pwd_change')){
					$email = $this->session->userdata('email');
					$user_data = $this->User_model->get_user_data($email);
					if($this->session->userdata('requires_pwd_change')){
					$view_data['required']="<div class='alert alert-warning' role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Password Expired!</strong> Your password has expired, please change your password.</p></div>";
					}
					$view_data['title']="Change My Password";
					$view_data['page_header']= "Change password for: <strong>".$user_data['first']." ".$user_data['last']."</strong>";
					$data= array_merge($view_data, $user_data);
					$this->load->view("header",$data);
					$this->load->view("navbar",$data);
					$this->load->view('password_change_view',$data);
					$this->load->view("footer",$data);	
			}else{
		      redirect ('User/restricted');	
			}
	}

public function password_validation(){
	$this->load->library('form_validation');
	$this->form_validation->set_rules('current_password','Current Password','required|trim|callback_verify_password');
	$this->form_validation->set_message('verify_password',"You must enter your current password correctly.");
	$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|callback_no_match_password');
	$this->form_validation->set_message('no_match_password',"Your new password cannot be the same as your last one.");
	$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[password]');
	if($this->form_validation->run()){
				
		    //generate a random key
				$key = md5(uniqid());
				//add the user info to the db, build the email and send and email to the new user
				//$this->load->library('email');
				$this->Config_model->initialize_email_settings();
				$from_email = $this->Config_model->get_from_email();
				$from_name = $this->Config_model->get_from_name();
				$this->email->from($from_email, $from_name);
				$email = $this->session->userdata('email');
				$this->email->to($email);
				$this->email->subject('Confirm your new password!');
				$message = "<p>Thank you for changing your password.</p>";
				$message .= "<p><a href='".base_url()."User/confirm_password/$key'>Click Here</a> to confirm your new password.</p>";		    
				$this->email->message($message);						
				$data = array(
								'email'=>$this->session->userdata('email'),
								'password'=>md5($this->input->post('password')),
								'temp_key'=>$key
						);
				if($this->User_model->register_new_password($data) && $this->email->send()){	
						$audit = array('primary' => 'USER', 'secondary'=>'PWCH', 'status'=>true,  'controller'=>'User', 'value'=>null,  'extra_1' =>'succesful password change', 'extra_2'=>null, 'extra_3'=>null);
						$this->Audit_model->log_entry($audit);		   
					   $message = "<div class='alert alert-info'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> The user's password is pending update. An email has been sent to ".$email." in order to confirm this change!</p></div>";
					   $this->session->set_flashdata('message',$message);
					   redirect('User/login');
					}else{
						$audit = array('primary' => 'USER', 'secondary'=>'PWCH', 'status'=>false,  'controller'=>'User', 'value'=>null,  'extra_1' =>'password change failure', 'extra_2'=>null, 'extra_3'=>null);
						$this->Audit_model->log_entry($audit);
						$this->error_message('<p><span id="error">There was a problem updating your password. </span> Please contact the system administrator.</p>');
					}
		}else{
			$audit = array('primary' => 'USER', 'secondary'=>'PWCH', 'status'=>false,  'controller'=>'User', 'value'=>null,  'extra_1' =>'form validation error', 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);
		   $this->change_password();
		}
}

public function no_match_password(){
	 if($this->input->post('current_password') != $this->input->post('password')){
	 	return true;
	 	}else{
	 	return false;
	 	}
	}

public function verify_password(){
	$password = md5($this->input->post('current_password'));
	$email = $this->session->userdata('email');
	if ($this->User_model->verify_password($password, $email)){
				return true; 
				}else{
				return false;
				}
}

public function confirm_password($key){
	$return_values = false;
	if ($this->User_model->confirm_key($key, $return_values)){
		if ($this->User_model->activate_new_password($key)){
			$audit = array('primary' => 'USER', 'secondary'=>'PWCH', 'status'=>true,  'controller'=>'User', 'value'=>null,  'extra_1' =>'successful password change', 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);
			if($this->session->userdata('is_logged_in')) {$this->session->sess_destroy();}
			$message = "<div class='alert alert-success' role='alert'><p><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> You have successfully updated your password. Please login again.</p></div>";
			$this->session->set_flashdata('message',$message);	
			redirect('User/login');		
		}else {
			$audit = array('primary' => 'USER', 'secondary'=>'PWCH', 'status'=>false,  'controller'=>'User', 'value'=>null,  'extra_1' =>'password change failure', 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);
			$this->session->sess_destroy();
			$error = "<p><span id='error'>There is a problem with activating the new password. </span> Please contact the system administrator.</p>";
			$this->error_message($error);
		}
	} else{
	$audit = array('primary' => 'USER', 'secondary'=>'BKEY', 'status'=>true,  'controller'=>'User', 'value' =>'{"bad_key"}:{"'.$key.'"}', 'extra_1'=>'bad key password change', 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);
	$this->session->sess_destroy();
   $error = "<p><span id='error'>The activation key is not valid!</span> <br><br> Did you already activate the password?<br><br>
   You are receiving this error because the registration key is no longer valid and may be because you already activated the new password or 
   the URL link has been altered in some way. Please contact a system administrator for further assistance.</p>";
	$this->error_message($error);
	} 
}
 
 public function restricted(){
		  $audit = array('primary' => 'USER', 'secondary'=>'REST', 'status'=>false,  'controller'=>'User', 'value' =>null, 'extra_1'=>'user attempted to access a restricted area', 'extra_2'=>null, 'extra_3'=>null);
		  $this->Audit_model->log_entry($audit);
		  $this->session->sess_destroy();//if the user attempts to access a restricted area...destroy the session
	     $data['title']="There is a problem!";
	     $data['page_header']="There is a problem!";
	     $data['error_message']="<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign'></span><strong>Restricted!</strong> You have attempted to access an area that is restricted.</div>";
			$this->load->view("header",$data);
		  $this->load->view("navbar",$data);	
			$this->load->view('There_is_a_problem_view',$data);
			$this->load->view("footer",$data);
		  
	}

}
/* End of file user.php */
/* Location: ./application/controllers/user.php */
