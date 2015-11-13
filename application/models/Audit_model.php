<?php

/*
 * Filename : Config_model.php
 * Author : BEJAN NOURI
 * Date : 8-31-2015
 * Summary: Access data related to the application audit logging, this model is called by multiple controllers
 * */
 
 class Audit_model extends CI_Model {
 	
public function record_count() {
		return $this->db->count_all("audit");
	}
	
public function failed_record_count(){
	$this->db->where('status',0);
	return $this->db->count_all_results("audit");			
	}
	
public function search_log_record_count($search_by){
	$this->db->or_like('primary', $search_by);
   $this->db->or_like('secondary', $search_by );
   $this->db->or_like('user_email', $search_by );
   $this->db->or_where('ip_address', $search_by);
	return $this->db->count_all_results("audit");			
	}
	
public function sort_by($sort_by){
		switch($sort_by){
					case 1: return $this->db->order_by("primary","asc");
					case 2: return $this->db->order_by("primary","desc");
					case 3: return $this->db->order_by("secondary","asc");
					case 4: return $this->db->order_by("secondary","desc");
					case 5: return $this->db->order_by("user_email","asc");
					case 6: return $this->db->order_by("user_email","desc");
					case 7: return $this->db->order_by("ip_address","asc");
					case 8: return $this->db->order_by("ip_address","desc");
					case 9: return $this->db->order_by("status","asc");
					case 10: return $this->db->order_by("status","desc");
					case 11: return $this->db->order_by("datetime","asc");
					case 12: return $this->db->order_by("datetime","desc");
					case 13: return $this->db->order_by("session_id","asc");
					case 14: return $this->db->order_by("session_id","desc");
					case 15: return $this->db->order_by("uri","asc");
					case 16: return $this->db->order_by("uri","desc");
					case 17: return $this->db->order_by("value","asc");
					case 18: return $this->db->order_by("value","desc");
					default : return $this->db->order_by("datetime","desc");		
			}		
		}

public function log_entry($data){
	$data['datetime'] = date("Y-m-d H:i:s");
	$data['session_id'] = ($this->session->userdata('session_id'))? $this->session->userdata('session_id')  : 'unknown';	
	$data['ip_address'] = ($this->session->userdata('ip_address') )? $this->session->userdata('ip_address')  : (!empty($_SERVER['REMOTE_ADDR'])?  $_SERVER['REMOTE_ADDR']  :
						  (( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : "unknown" ));
	$data['user_email'] = ($this->session->userdata('email'))? $this->session->userdata('email')  : (($this->input->post('email'))? $this->input->post('email') : 'unknown');
	$data['uri'] = ($this->uri->uri_string())? $this->uri->uri_string() : 'unknown';
	$data['http_agent'] = $_SERVER['HTTP_USER_AGENT'];
	$host_data = json_encode(array(
						'HTTP_ACCEPT'=> (!empty($_SERVER['HTTP_ACCEPT']))? $_SERVER['HTTP_ACCEPT'] : "unknown",  
						'HTTP_ACCEPT_ENCODING'=>(!empty($_SERVER['HTTP_ACCEPT_ENCODING']))? $_SERVER['HTTP_ACCEPT_ENCODING'] : "unknown" ,
						'HTTP_ACCEPT_CHARSET'=> (!empty($_SERVER['HTTP_ACCEPT_CHARSET']))? $_SERVER['HTTP_ACCEPT_CHARSET'] : "unknown" ,  
						'HTTP_ACCEPT_LANGUAGE'=>(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : "unknown", 
						'HTTP_CONNECTION'=>(!empty($_SERVER['HTTP_CONNECTION']))? $_SERVER['HTTP_CONNECTION'] : "unknown", 
						'HTTP_HOST'=>(!empty($_SERVER['HTTP_HOST']))? $_SERVER['HTTP_HOST'] : "unknown", 
						'HTTP_REFERER'=>(!empty($_SERVER['HTTP_REFERER']))? $_SERVER['HTTP_REFERER'] : "unknown", 
						'REMOTE_HOST'=>(!empty($_SERVER['REMOTE_HOST']))? $_SERVER['REMOTE_HOST'] : "unknown", 
						'REMOTE_PORT'=>(!empty($_SERVER['REMOTE_PORT']))? $_SERVER['REMOTE_PORT'] : "unknown", 
						'REMOTE_USER'=>(!empty($_SERVER['REMOTE_USER']))? $_SERVER['REMOTE_USER'] : "unknown",
						));
	$data['http_host_data'] = $host_data;
	$data['environmentals'] = (!empty($_ENV))? json_encode($_ENV) : "empty";
	$this->db->insert('audit', $data);
         if($this->db->affected_rows() > 0){
	         return true;
	         }else{
				return false;         
	         }
}

public function get_audit_record($id){
     $this->db->where('id',$id);
 	  $query = $this->db->get('audit');
 if($query->num_rows() > 0){
 		 foreach($query->result() as $row){
       $audit_data['id'] = $row->id;
       $audit_data['datetime'] = $row->datetime;
       $audit_data['primary'] = $row->primary;
       $audit_data['secondary'] = $row->secondary;
       $audit_data['session_id'] = $row->session_id;
       $audit_data['user_email'] = $row->user_email;
       $audit_data['status'] = $row->status;
       $audit_data['uri'] = $row->uri;
       $audit_data['controller'] = $row->controller;
       $audit_data['value'] = $row->value;
		 $audit_data['ip_address'] = $row->ip_address;
		 $audit_data['http_agent'] = $row->http_agent; 	
	    $audit_data['http_host_data'] = $row->http_host_data;
		 $audit_data['environmentals'] = $row->environmentals;
		 $audit_data['extra_1'] = $row->extra_1; 	
	    $audit_data['extra_2'] = $row->extra_2; 	
	    $audit_data['extra_3'] = $row->extra_3;
 	}}else{
  		 return false;
 }
return $audit_data;		
}

public function get_audit_paginated($limit, $start, $sort_by){
		$this->sort_by($sort_by);		
		$this->db->limit($limit,$start);		
		$query = $this->db->get("audit");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}

public function get_failed_log_paginated($limit, $start, $sort_by){
		$this->sort_by($sort_by);		
		$this->db->limit($limit,$start);
		$this->db->where('status','0');
     $query = $this->db->get("audit");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}

public function  search_audit_paginated($limit, $start, $sort_by, $search_by){
		$this->sort_by($sort_by);		
		$this->db->limit($limit,$start);
		$search_by = trim($search_by);
      $this->db->or_like('primary', $search_by);
      $this->db->or_like('secondary', $search_by );
      $this->db->or_like('user_email', $search_by );      
   	$this->db->or_where('ip_address', $search_by);
      $query = $this->db->get("audit");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}
	
public function export_log(){
	$this->load->helper('file');
	$this->load->helper('download');
	$this->db->order_by("datetime","desc");	
	$query = $this->db->get('audit');
	$datestamp= date("Y-m-d-H:i:s");	
	$audit_file = "Audit file created on : ".$datestamp."\n";
	$audit_file .= "Date-time|ID|Pri|Sec|Email|IP_Address|Status|Session_ID|URI|Value|Controller|HTTP_Agent|HTTP_Host_Data|Environmentals|Extra_1|Extra_2|Extra_3\n";
	foreach($query->result() as $row){
 		$audit_file .= $row->datetime."|".$row->id."|".$row->primary."|".$row->secondary."|".$row->user_email."|".$row->ip_address."|".$row->status."|".$row->session_id."|".$row->uri."|";
 		$audit_file .= $row->value."|".$row->controller."|".$row->http_agent."|".$row->http_host_data."|".$row->environmentals."|".$row->extra_1."|".$row->extra_2."|".$row->extra_3."\n"; 
 	    }	
 	 $file_path = APPPATH."logs/audit-".$datestamp.".csv";
 	if(write_file($file_path, $audit_file)){ 
 	 $filename = "audit-".$datestamp.'.csv';
 	 $audit = array('primary' => 'AUDT', 'secondary'=>'EXPT', 'status'=>true,  'controller'=>'Audit', 'value'=>null,  'extra_1' =>'successfully exported the audit log', 'extra_2'=>null, 'extra_3'=>null);
 	 $this->log_entry($audit);		
 	 force_download($filename , $audit_file);
 	 return true;
 	 }else{
	 return false; 	 
 	 }
 }

public function truncate_log(){
	$this->load->helper('file');
	$this->db->order_by("datetime","desc");	
	$query = $this->db->get('audit');
	$datestamp= date("Y-m-d-H:i:s");	
	$audit_file = "Audit file created on : ".$datestamp."\n\n";
	foreach($query->result() as $row){
 		$audit_file .= $row->datetime."| ".$row->id."| ".$row->primary."| ".$row->secondary."| ".$row->user_email."| ".$row->ip_address."| ".$row->status."| ".$row->session_id."| ".$row->uri."\n";
 		$audit_file .= "            ".$row->value."| ".$row->controller."| ".$row->http_agent."| ".$row->http_host_data."| ".$row->environmentals."| ".$row->extra_1."| ".$row->extra_2."| ".$row->extra_3."\n"; 
 	    }
 	$file_path = APPPATH."logs/audit-".$datestamp.".csv";	
 	if(write_file($file_path, $audit_file)){ 
	if($this->db->empty_table('audit')){
		return true;
	}else{
		return false;		
		}}else{
		return false;			
			}
	}	



}