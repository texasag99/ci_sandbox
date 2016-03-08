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
	$this->load->model('Audit_model');
	
}

public function index(){
		$this-> show_all_active_users_paginated(0, 0, 0);
	}



/*************HAS PERMISSIONS*********************/
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

/********************PAGINATION SETUP*********************************/
private function pagination_setup($type){
	$default_pagination= $this->Config_model->get_default_pagination();
	$pagination_config = array();
	$sort_by = ($this->uri->segment(3))? $this->uri->segment(3) : 0;	
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	$pagination_config["per_page"] = $per_page;			
	if ($type=='all_users'){
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;
	$pagination_config["base_url"] = base_url()."UserAdmin/show_all_users_paginated/".$sort_by."/0/".$per_page."/";
	$pagination_config["total_rows"] = $this->User_model->user_record_count();
	$pagination_config["uri_segment"] = 6;//this is where we determine which row start we are on, also referred to as the start page or record:
	$pagination_config["per_page"] = $per_page;	
	}elseif($type=='active_users'){
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	$pagination_config["base_url"] = base_url()."UserAdmin/show_all_active_users_paginated/".$sort_by."/0/".$per_page."/";
	$pagination_config["total_rows"] = $this->User_model->active_user_record_count();	
	$pagination_config["uri_segment"] = 6;//this is where we determine which row start we are on, also referred to as the start page or record:
$pagination_config["per_page"] = $per_page;	
	}else{//searched users
		$sort_by = ($this->uri->segment(4))? $this->uri->segment(4) : 0;	
		$per_page = ($this->uri->segment(6))? $this->uri->segment(6) : $default_pagination;	
		$pagination_config["base_url"] = base_url()."UserAdmin/search_users_paginated/".$type."/".$sort_by."/0/".$per_page."/";
		$pagination_config["total_rows"] = $this->User_model->search_user_record_count($type);		
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

/*********************SHOW ALL USERS************************************/
public function show_all_users_paginated($sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		$create_pdf = 0;
		if($pagination_config==999999){
			$create_pdf = 1;	
			$pagination_config=0;	
		}
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup('all_users');
		}
		$start = ($this->uri->segment(6))? $this->uri->segment(6) : 0;	
		$data["results"] = $this->User_model->get_all_users_paginated($pagination_config["per_page"], $start, $sort_by);
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
	   $view_data['per_page'] = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	   $view_data['total_records'] = $pagination_config['total_rows'];
	   $view_data['sort_by'] = $this->uri->segment(3); 
		$view_data['title']="Users";
		$view_data['controller']="show_all_users_paginated";
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['page_header']= "All Users";
		$data= array_merge($view_data, $data);
		if ($create_pdf==1){//Print it as a PDF
		$audit = array('primary' => 'USRA', 'secondary'=>'PDF', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>null,  'extra_1' =>'all users paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->library('Pdf');
		$this->pdf->load_view('pdf_user_view',$data);
		$this->pdf->render();
		$this->pdf->stream("User_report.pdf");
		}else{
		$audit = array('primary' => 'USRA', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>null,  'extra_1' =>'all users paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_users_view",$data);
		$this->load->view("footer",$data);
		$this->benchmark->mark('code_end');	
		}			
	}else{
		      redirect ('User/restricted');	
			}
	} 
	
	
public function show_all_active_users_paginated($sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		$create_pdf = 0;
		if($pagination_config==999999){
			$create_pdf = 1;	
			$pagination_config=0;	
		}
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup('active_users');
		}
		$start = ($this->uri->segment(6))? $this->uri->segment(6) : 0;	
		$data["results"] = $this->User_model->get_all_active_users_paginated($pagination_config["per_page"], $start, $sort_by);
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
	   $view_data['per_page'] = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;
	   $view_data['total_records'] = $pagination_config['total_rows'];	
	   $view_data['sort_by'] = $this->uri->segment(3); 
		$view_data['title']="Users";
		$view_data['controller']="show_all_active_users_paginated";
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['page_header']= "All Users";
		$data= array_merge($view_data, $data);
		if ($create_pdf==1){//Print it as a PDF
		$audit = array('primary' => 'USRA', 'secondary'=>'PDF', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>null,  'extra_1' =>'all users paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->library('Pdf');
		$this->pdf->load_view('pdf_user_view',$data);
		$this->pdf->render();
		$this->pdf->stream("User_report.pdf");
		}else{
		$audit = array('primary' => 'USRA', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>null,  'extra_1' =>'all active users paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_users_view",$data);
		$this->load->view("footer",$data);
		}			
	}else{
		      redirect ('User/restricted');	
			}
	}
	
public function search_users(){
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
		redirect('UserAdmin/search_users_paginated/'.$search_by.'/0/0/0/');
	}else{ //end of section for the forms valid 
	    $audit = array('primary' => 'USRA', 'secondary'=>'SRCH', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>'invalid search entry', 'extra_2'=>null, 'extra_3'=>null);
	 	 $this->Audit_model->log_entry($audit);
	    $this->index();
	}}else{//end of section for users properly logged in
		      redirect ('User/restricted');	
			}
	
}


public function search_users_paginated($search_by,$sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		$create_pdf = 0;
		if($pagination_config==999999){
			$create_pdf = 1;	
			$pagination_config=0;	
		}
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup($search_by);
		}
		$start = ($this->uri->segment(7))? $this->uri->segment(7) : 0;	
		$search_by = str_replace('-at-', '@',$search_by);	//this handles the @ symbol when it is passed in the url.
		$data["results"] = $this->User_model->search_users_paginated($pagination_config["per_page"], $start, $sort_by, $search_by);
		$data ["links"] = $this->pagination->create_links();
		$search_by = str_replace('@', '-at-',$search_by);	 //this changes the @ symbol back to -at-
		$data['search_by']=$search_by;
		$default_pagination= $this->Config_model->get_default_pagination();
	   $view_data['per_page'] = ($this->uri->segment(6))? $this->uri->segment(6) : $default_pagination;	
	   $view_data['total_records'] = $pagination_config['total_rows'];
	   $view_data['sort_by'] = $this->uri->segment(4); 
		$view_data['title']="Users";
		$view_data['allow_add'] = $this->has_permission_to_add();
		$view_data['allow_delete'] = $this->has_permission_to_delete();
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['page_header']= "All Users";
		$view_data['controller']="search_users_paginated/".$search_by;
		$data= array_merge($view_data, $data);
		if ($create_pdf==1){//Print it as a PDF
		$audit = array('primary' => 'USRA', 'secondary'=>'PDF', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>null,  'extra_1' =>'all users paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->library('Pdf');
		$this->pdf->load_view('pdf_user_view',$data);
		$this->pdf->render();
		$this->pdf->stream("User_report.pdf");
		}else{
		$audit = array('primary' => 'USRA', 'secondary'=>'SRCH', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$search_by,  'extra_1' =>'search users paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_users_view",$data);
		$this->load->view("footer",$data);
		$this->benchmark->mark('code_end');	
	}	
	}else{
		      redirect ('User/restricted');	
			}
	} 	
	
public function build_pdf_html($results){
	$html = "<div class ='body'><h1>Users</h1><p>This report was created on <strong>".date("Y-m-d H:i:s")."</strong></p>";
	$html .= "<table><thead><td class='user_column'>Name</td><td class='user_email_column'>Email</td><td class='user_status_column'>Status</td><td class='user_locked_column'>Locked</td>";
	$html .="<td class='user_created_column'>Created On</td><td class='user_updated_column'>Last Updated</td><td class='user_updated_column'>Last Activity</td></thead><tbody>";
  foreach ($results as $data){
	if ($data->locked == 0){
		   $locked = "No";
		}else{
			$locked = "Yes";
			}
		$html .= "<tr><td class='user_column'> ".$data->first." ".$data->last." </td>";
		$html .= "<td class='user_email_column'> ".$data->email." </td>";
		$html .= "<td class='user_status_column'> ".$data->status." </td>";
		$html .= "<td class='user_locked_column'> ".$locked." </td>";
		$html .= "<td class='user_created_column'> ".date('m-d-Y', strtotime($data->created))." </td>";
		$html .= "<td class='user_updated_column'> ".date('m-d-Y', strtotime($data->last_updated))." </td>";
		$html .= "<td class='user_updated_column'> ".date('m-d-Y', strtotime($data->last_activity))." </td></tr>";
}	
	$html .= "</tbody></table></div>";
	return $html;
}
	
		
/********AJAX retrieve of the profile data for each user to view in the show all.***************************/
public function getProfile($id){ 
				if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
					$user_data = $this->User_model->get_user($id);		
					$get_permissions = $user_data['permissions'];
					foreach($get_permissions as $value){
						 $permission[] =$this->Roles_permissions_model->get_permission($value->id);						
						}
					$view_data['permission'] = $permission;
					$profile_data = $this->User_model->get_user_profile($id);					
					$view_data['title']="User Profile";
					$view_data['page_header']= "User Profile for: <strong>".$user_data['first']." ".$user_data['last']."</strong>";
					$data= array_merge($view_data, $user_data, $profile_data);
					$audit = array('primary' => 'USRA', 'secondary'=>'PROV', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$id,  'extra_1' =>'view user profile', 'extra_2'=>null, 'extra_3'=>null);
					$this->Audit_model->log_entry($audit);
					$this->load->view('profile_view',$data);						
			}else{
		     			http_response_code(400);
						echo "There was a problem.";
						$audit = array('primary' => 'USRA', 'secondary'=>'PROV', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$id,  'extra_1' =>'failed to view user profile', 'extra_2'=>null, 'extra_3'=>null);
						$this->Audit_model->log_entry($audit);
			}
	}

/*********************ADD, DELETE & UPDATE A USER RECORD************************************/							
public function delete($id){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_delete()){
		if ($this->User_model->delete_user($id)){
			$message = "<div class='alert alert-info'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Deleted!</strong> The user was deleted from the system.</p></div>";
			$this->session->set_flashdata('message',$message);
			$audit = array('primary' => 'USRA', 'secondary'=>'DEL', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$id,  'extra_1' =>'delete user', 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);
			redirect('UserAdmin');
			}else{
			$audit = array('primary' => 'USRA', 'secondary'=>'DEL', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$id,  'extra_1' =>'failed to delete user', 'extra_2'=>null, 'extra_3'=>null);
			$this->Audit_model->log_entry($audit);
			$error = "Unable to delete the user. Either it doesn't exist or there is something wrong with the database.";
			$this->error_message($error);
			}					
		}else{
		redirect ('User/restricted');	
		}
}

public function add(){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_add()){
	$audit = array('primary' => 'USRA', 'secondary'=>'ADDV', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>null,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);	
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

protected function send_user_email($email, $subject, $message){
						$this->Config_model->initialize_email_settings();
						$from_email = $this->Config_model->get_from_email();
						$from_name = $this->Config_model->get_from_name();
						$this->email->from($from_email, $from_name);
						$this->email->to($email);
						$this->email->subject($subject);						
						$this->email->message($message);	
						if($this->email->send()){							   
								$audit = array('primary' => 'USRA', 'secondary'=>'SEND', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$email,  'extra_1' =>$subject, 'extra_2'=>$message, 'extra_3'=>'successfully sent a user an email from the user admin page');
 								$this->Audit_model->log_entry($audit);
								return true;
								}else{
								$audit = array('primary' => 'USRA', 'secondary'=>'SEND', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$email,  'extra_1' =>$subject, 'extra_2'=>$message, 'extra_3'=>'failed to send a user an email from the user admin page');
 								$this->Audit_model->log_entry($audit);
								return false;
								}
}

public function add_validation(){
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_add()){
	$audit_value = json_encode($this->input->post());
	$this->load->library('form_validation');
	$this->form_validation->set_rules('first', 'First Name', 'required|trim|xss_clean');
	$this->form_validation->set_rules('last', 'Last Name', 'required|trim|xss_clean');			
	$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|is_unique[user.email]|is_unique[temp_user.email]');
	$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
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
			$audit = array('primary' => 'USRA', 'secondary'=>'ADD', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			$user = $this->User_model->get_user_data($user_data['email']);
			$id = $user['id'];
			if($this->User_model->create_new_profile($id)){
				if($this->User_model->update_user_profile($id)){
				$audit = array('primary' => 'USRA', 'secondary'=>'ADD', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$this->input->post('email'),  'extra_1' =>'created a new user profile', 'extra_2'=>null, 'extra_3'=>null);
 				$this->Audit_model->log_entry($audit); 
				$email_message = "<p>Hello ".$user['first'].", </p><p>An account has been created for you on the ".APPLICATION_TITLE."web application. Please <a href='".base_url()."/User/login'> click here </a> to login for the first time. It is recommended that you change your password by clicking 'Edit Profiles' and 'Change My Password', after you login for the first time. Thank you. </p>";
				$email_message .="<p>The password for your new account is: <strong>".$this->input->post('password')."</strong></p>"; 
				$subject = "A new account has been created for you.";
				$email = $user['mail'];				 
				 if($this->send_user_email($email, $subject, $email_message)){ $email_sent_msg= 'was succesfully sent';  }else{ $email_sent_msg = 'failed to be sent';}
				 $message = "<div class='alert alert-success'  role='alert'><p><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> The new user was successfully added to the system. An email $email_sent_msg to the new user.</p></div>";
				 $this->session->set_flashdata('message', $message);
				  redirect('UserAdmin');
				}else{
					$audit = array('primary' => 'USRA', 'secondary'=>'ADD', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$this->input->post('email'),  'extra_1' =>'failed to add new user profile data', 'extra_2'=>null, 'extra_3'=>null);
 					$this->Audit_model->log_entry($audit); 					
					$message = "<div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Notice!</strong>The new user and profile were created, but failed to add profile data.</p></div>";
					$this->session->set_flashdata('message',$message);
					redirect('UserAdmin');
					}
				}else{
					$audit = array('primary' => 'USRA', 'secondary'=>'ADD', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$this->input->post('email'),  'extra_1' =>'failed to create a new user profile', 'extra_2'=>null, 'extra_3'=>null);
 					$this->Audit_model->log_entry($audit); 
					$message = "<div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Notice!</strong>The new user was created, but failed to create a new user profile.</p></div>";
					$this->session->set_flashdata('message',$message);
					redirect('UserAdmin');
					}
			}else{ 
			$audit = array('primary' => 'USRA', 'secondary'=>'ADD', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>'failed to create a new user', 'extra_2'=>null, 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			$message = "<div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Failed!</strong>Failed to create the new user.</p></div>";
			$this->session->set_flashdata('message',$message);
			 redirect('UserAdmin/add');			
			}	
	}else{
	$audit = array('primary' => 'USRA', 'secondary'=>'ADD', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>'validation failure for a new user', 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);
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
	$audit = array('primary' => 'USRA', 'secondary'=>'UPDV', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$id,  'extra_1' =>null, 'extra_2'=>null, 'extra_3'=>null);
	$this->Audit_model->log_entry($audit);
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
	$audit_value = json_encode($this->input->post());
	$id = $this->input->post('id');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('first', 'First Name', 'required|trim|xss_clean');
	$this->form_validation->set_rules('last', 'Last Name', 'required|trim|xss_clean');			
   if($this->need_to_validate_email($id)){ //if the email in the post is the same one, then we don't need to validate it.
	$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|is_unique[user.email]|is_unique[temp_user.email]');
    }
  $pw=$this->input->post('password'); 
  	if(isset($pw) && !empty($pw)){//if nothing was entered into the password field then we don't need to worry about it.
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
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
			$user_data['pwd_last_updated'] = date("Y-m-d H:i:s");
			}
	   if($this->User_model->update_user_value($user_data, $id)){
	   	if($this->User_model->update_user_profile($id)){ 
		  $roles = $this->input->post('roles');
	    if(isset($roles) && !empty($roles)){
	    if($this->User_model->unlink_all_roles_to_user($id) && $this->User_model->link_multiple_roles_to_user($id, $roles)){
			$audit = array('primary' => 'USRA', 'secondary'=>'UPDT', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>'successfully updated user data', 'extra_2'=>null, 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
		  $message = "<div class='alert alert-success'  role='alert'><p><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> The user was successfully updated in the system.</p></div>";
			$this->session->set_flashdata('message',$message);
			 redirect('UserAdmin'); //SUCCESS 
				}else{
					$audit = array('primary' => 'USRA', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>'failed to link roles to user.', 'extra_2'=>null, 'extra_3'=>null);
 			      $this->Audit_model->log_entry($audit);
					$message = "<div id='message'><div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Notice!</strong>Failed to link roles to user.</p></div></div>";
					echo $message;
					$this->update($id);
					}				
				}else{
					$audit = array('primary' => 'USRA', 'secondary'=>'UPDT', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>'successfully updated user data', 'extra_2'=>null, 'extra_3'=>null);
 					$this->Audit_model->log_entry($audit);
					$message = "<div class='alert alert-success'  role='alert'><p><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> The user was successfully updated in the system.</p></div>";
					$this->session->set_flashdata('message',$message);
			 		redirect('UserAdmin'); //SUCCESS BUT NO ROLES WERE LINKED 
					}
				}else{
					$audit = array('primary' => 'USRA', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>'failed to update user profile data', 'extra_2'=>null, 'extra_3'=>null);
 			      $this->Audit_model->log_entry($audit);
					$message = "<div id='message'><div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Notice!</strong>Failed to update profile data.</p></div></div>";
					echo $message;
					$this->update($id);
				}}else{
					$audit = array('primary' => 'USRA', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>'failed to update user data.', 'extra_2'=>null, 'extra_3'=>null);
 			      $this->Audit_model->log_entry($audit);
					$message = "<div id='message'><div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Notice!</strong>Failed to update the user data.</p></div></div>";
					echo $message;
					$this->update($id);
					}
			}else{
			$audit = array('primary' => 'USRA', 'secondary'=>'UPDU', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>'update forms validation error.', 'extra_2'=>null, 'extra_3'=>null);
 		   $this->Audit_model->log_entry($audit);
			$this->update($id);
	}	 
}else{
		redirect ('User/restricted');	
		}
}

public function postValue($id, $column){	//FOR INLINE EDITS UPDATES
if ($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
	$audit_value = json_encode($this->input->post());	
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
			$audit = array('primary' => 'USRA', 'secondary'=>'UPDT', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>null, 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			http_response_code(200);
		}else{
			$audit = array('primary' => 'USRA', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>'database update error', 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);
			http_response_code(400);
			echo "The database didn't update";
		}}else{
		$audit = array('primary' => 'USRA', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>'form validation error', 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		http_response_code(400);
		 echo strip_tags(validation_errors());
	}}else{
			$audit = array('primary' => 'USRA', 'secondary'=>'UPDT', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$audit_value,  'extra_1' =>$column, 'extra_2'=>'timeout error', 'extra_3'=>null);
 			$this->Audit_model->log_entry($audit);	
			http_response_code(400);
	   	echo "The session timed out";
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