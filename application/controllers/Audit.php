<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
filename: Audit.php
Author: Bejan Nouri
Last update: 9-24-2015

Notes- 

This is the "Audit" controller which manages the reviewing of the user audit log and clearing of the table.

*/

class Audit extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->model('Config_model');
	$this->load->library('pagination');
	$this->load->model('Audit_model');	
}

public function index(){
	$this->show_audit_paginated(0,0,0);
}

private function has_permission_to_view(){
	$all_permissions = $this->session->userdata('permissions');
	$permission = array();
	foreach ($all_permissions as $value){
			$permission[]= $value->id;				
		}
	if( in_array(9080, $permission) ||in_array(9999, $permission)){
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
	if( in_array(9085, $permission) ||in_array(9999, $permission)){
    return true;
    	}else{
    	return false;
    	}
}

private function pagination_setup($type){
	$default_pagination= $this->Config_model->get_default_pagination();
	$pagination_config = array();
	$sort_by = ($this->uri->segment(3))? $this->uri->segment(3) : 0;	
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	$pagination_config["per_page"] = $per_page;			
	if ($type=='all'){
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;
	$pagination_config["base_url"] = base_url()."Audit/show_audit_paginated/".$sort_by."/0/".$per_page."/";
	$pagination_config["total_rows"] = $this->Audit_model->record_count();
	$pagination_config["uri_segment"] = 6;//this is where we determine which row start we are on, also referred to as the start page or record:	
	}elseif($type=='failed'){
	$per_page = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	$pagination_config["base_url"] = base_url()."Audit/show_failed_log_paginated/".$sort_by."/0/".$per_page."/";
	$pagination_config["total_rows"] = $this->Audit_model->failed_record_count();	
	$pagination_config["uri_segment"] = 6;//this is where we determine which row start we are on, also referred to as the start page or record:
	$pagination_config["per_page"] = $per_page;			
	}else{//searched audit_log
		$sort_by = ($this->uri->segment(4))? $this->uri->segment(4) : 0;	
		$per_page = ($this->uri->segment(6))? $this->uri->segment(6) : $default_pagination;	
		$pagination_config["base_url"] = base_url()."Audit/search_audit_paginated/".$type."/".$sort_by."/0/".$per_page."/";
		$pagination_config["total_rows"] = $this->Audit_model->search_log_record_count($type);		
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


public function show_audit_paginated($sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
		$create_pdf = 0;
		if($pagination_config==999999){
			$create_pdf = 1;	
			$pagination_config=0;	
		}
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup('all');
		}
		$start = ($this->uri->segment(6))? $this->uri->segment(6) : 0;	
		$data["results"] = $this->Audit_model->get_audit_paginated($pagination_config["per_page"], $start, $sort_by);	
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
	   $view_data['per_page'] = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;
	   $view_data['total_records'] = $pagination_config['total_rows'];
	   $view_data['controller'] = "show_audit_paginated";	
	   $view_data['sort_by'] = $this->uri->segment(3); 
		$view_data['title']="Audit Log";
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['page_header']= "Audit Log";
		$data= array_merge($view_data, $data);
		if ($create_pdf==1){//Print it as a PDF
		$audit = array('primary' => 'AUDT', 'secondary'=>'PDF', 'status'=>true,  'controller'=>'Audit', 'value'=>null,  'extra_1' =>'all audit log  paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->library('Pdf');
		$this->pdf->load_view('pdf_audit_view',$data);
		$this->pdf->set_paper(array(0,0,12*72,12*72), 'landscape');
		$this->pdf->render();
		$this->pdf->stream("Audit_report.pdf");
		}else{
		$audit = array('primary' => 'AUDT', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'Audit', 'value'=>null,  'extra_1' =>'all audit log entries paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_audit_view",$data);
		$this->load->view("footer",$data);	
	}
	}else{
		      redirect ('User/restricted');	
			}
	} 
	
public function show_failed_log_paginated($sort_by, $pagination_config){
	if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		$this->load->helper("url");
	   $create_pdf = 0;
		if($pagination_config==999999){
			$create_pdf = 1;	
			$pagination_config=0;	
		}
		if (empty($pagination_config) || $pagination_config==0){
			$pagination_config = $this->pagination_setup('failed');
		}
		$start = ($this->uri->segment(6))? $this->uri->segment(6) : 0;	
		$data["results"] = $this->Audit_model->get_failed_log_paginated($pagination_config["per_page"], $start, $sort_by);
		$data ["links"] = $this->pagination->create_links();
		$default_pagination= $this->Config_model->get_default_pagination();
	   $view_data['per_page'] = ($this->uri->segment(5))? $this->uri->segment(5) : $default_pagination;	
	   $view_data['total_records'] = $pagination_config['total_rows'];
	   $view_data['sort_by'] = $this->uri->segment(3); 
		$view_data['title']="Audit Log";
		$view_data['controller'] = "show_failed_log_paginated";	
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['page_header']= "Failed Audit Log Entries";
		$data= array_merge($view_data, $data);
		if ($create_pdf==1){//Print it as a PDF
		$audit = array('primary' => 'AUDT', 'secondary'=>'PDF', 'status'=>true,  'controller'=>'Audit', 'value'=>null,  'extra_1' =>'show failed audit log  paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->library('Pdf');
		$this->pdf->load_view('pdf_audit_view',$data);
		$this->pdf->set_paper(array(0,0,12*72,12*72), 'landscape');
		$this->pdf->render();
		$this->pdf->stream("Audit_report.pdf");
		}else{
		$audit = array('primary' => 'AUDT', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'Audit', 'value'=>null,  'extra_1' =>'failed audit log entries', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_audit_view",$data);
		$this->load->view("footer",$data);
		}				
	}else{
		      redirect ('User/restricted');	
			}
	}
	
public function  search_audit(){
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
		redirect('Audit/search_audit_paginated/'.$search_by.'/0/0/0/');
	}else{ //end of section for the forms valid 
	    $audit = array('primary' => 'AUDT', 'secondary'=>'SRCH', 'status'=>false,  'controller'=>'Audit', 'value'=>$audit_value,  'extra_1' =>'invalid search entry', 'extra_2'=>null, 'extra_3'=>null);
	 	 $this->Audit_model->log_entry($audit);
	    $this->index();
	}}else{//end of section for users properly logged in
		      redirect ('User/restricted');	
			}
	
}

public function search_audit_paginated($search_by,$sort_by, $pagination_config){
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
		$data["results"] = $this->Audit_model->search_audit_paginated($pagination_config["per_page"], $start, $sort_by, $search_by);
		$data ["links"] = $this->pagination->create_links();
		$search_by = str_replace('@', '-at-',$search_by);	 //this changes the @ symbol back to -at-
		$data['search_by']=$search_by;
		$default_pagination= $this->Config_model->get_default_pagination();
	   $view_data['per_page'] = ($this->uri->segment(6))? $this->uri->segment(6) : $default_pagination;	
	   $view_data['total_records'] = $pagination_config['total_rows'];
	   $view_data['sort_by'] = $this->uri->segment(4); 
		$view_data['title']="Audit Log";
		$view_data['controller'] = "search_audit_paginated/".$search_by;	
		$view_data['allow_edit'] = $this->has_permission_to_edit();
		$view_data['page_header']= "Audit Log Search Results";
		$data= array_merge($view_data, $data);
		if ($create_pdf==1){//Print it as a PDF
		$data["results"] = $this->Audit_model->search_audit_paginated($pagination_config["per_page"], $start, $sort_by, $search_by);
		$audit = array('primary' => 'AUDT', 'secondary'=>'PDF', 'status'=>true,  'controller'=>'Audit', 'value'=>null,  'extra_1' =>'all audit log  paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->library('Pdf');
		$this->pdf->load_view('pdf_audit_view',$data);
		$this->pdf->set_paper(array(0,0,12*72,12*72), 'landscape');
		$this->pdf->render();
		$this->pdf->stream("Audit_report.pdf");
		}else{
		$audit = array('primary' => 'AUDT', 'secondary'=>'SRCH', 'status'=>true,  'controller'=>'Audit', 'value'=>$search_by,  'extra_1' =>'search audit log paginated', 'extra_2'=>null, 'extra_3'=>null);
		$this->Audit_model->log_entry($audit);
		$this->load->view("header",$data);
		$this->load->view("navbar",$data);
		$this->load->view("show_audit_view",$data);
		$this->load->view("footer",$data);
		}
	}else{
		      redirect ('User/restricted');	
			}
	} 	

public function getAudit($id){ 
				if ($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
					$audit_data = $this->Audit_model->get_audit_record($id);						
					$view_data['title']="Audit Entry";
					$view_data['page_header']= "Audit Entry ".$id;
					$data= array_merge($view_data, $audit_data);
					$audit = array('primary' => 'AUDT', 'secondary'=>'VIEW', 'status'=>true,  'controller'=>'UserAdmin', 'value'=>$id,  'extra_1' =>'view audit entry', 'extra_2'=>null, 'extra_3'=>null);
					$this->Audit_model->log_entry($audit);
					$this->load->view('audit_record_view',$data);						
			}else{
		     			http_response_code(400);
						echo "There was a problem.";
						$audit = array('primary' => 'AUDT', 'secondary'=>'VIEW', 'status'=>false,  'controller'=>'UserAdmin', 'value'=>$id,  'extra_1' =>'view audit entry', 'extra_2'=>null, 'extra_3'=>null);
				   	$this->Audit_model->log_entry($audit);
			}
	}

public function export_log(){
	if($this->session->userdata('is_logged_in') && $this->has_permission_to_view()){
		if($filename = $this->Audit_model->export_log()){
				$audit = array('primary' => 'AUDT', 'secondary'=>'EXPT', 'status'=>true,  'controller'=>'Audit', 'value'=>"Cleared Log",  'extra_1' =>'successfully exported the audit log', 'extra_2'=>null, 'extra_3'=>null);
 				$this->Audit_model->log_entry($audit);
				redirect(APPPATH.'logs/'.$filename); 
			}else{
					$audit = array('primary' => 'AUDT', 'secondary'=>'EXPT', 'status'=>false,  'controller'=>'Audit', 'value'=>null,  'extra_1' =>'failed to export audit log', 'extra_2'=>null, 'extra_3'=>null);
 					$this->Audit_model->log_entry($audit);
					$message = "<div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Failed!</strong>Failed to export the audit log. Please contact the system administrator.</p></div>";
					$this->session->set_flashdata('message',$message);
			 		redirect('Audit');	
			}
			
		}else{
		      redirect ('User/restricted');	
		   }


}
public function truncate_log(){
		if($this->session->userdata('is_logged_in') && $this->has_permission_to_edit()){
			if($this->Audit_model->truncate_log()){
				$audit = array('primary' => 'AUDT', 'secondary'=>'TRUN', 'status'=>true,  'controller'=>'Audit', 'value'=>"Cleared Log",  'extra_1' =>'successfully truncated the audit log', 'extra_2'=>null, 'extra_3'=>null);
 				$this->Audit_model->log_entry($audit);
 				$message = "<div class='alert alert-success'  role='alert'><p><span class='glyphicon glyphicon-ok'></span> <strong>Success!</strong> The audit log was successfully cleared. </p></div>";
				$this->session->set_flashdata('message', $message);
				redirect('Audit'); 
				}else{
					$audit = array('primary' => 'AUDT', 'secondary'=>'TRUN', 'status'=>false,  'controller'=>'Audit', 'value'=>null,  'extra_1' =>'failed to truncate audit log', 'extra_2'=>null, 'extra_3'=>null);
 					$this->Audit_model->log_entry($audit);
					$message = "<div class='alert alert-warning'  role='alert'><p><span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Failed!</strong>Failed to clear the audit log. Please contact the system administrator.</p></div>";
					$this->session->set_flashdata('message',$message);
			 		redirect('Audit');		
					}
			}else{
		      redirect ('User/restricted');	
			}
	}

}
