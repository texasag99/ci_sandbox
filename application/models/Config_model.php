<?php
/*
 * Filename : Config_model.php
 * Author : BEJAN NOURI
 * Date : 7-2-2014
 * Summary: Access data related to the application configuration table "config", this model is called by multiple controllers
 * */

class Config_model extends CI_Model {


public function get_all_settings(){
		$query = $this->db->get("config");
		if ($query->num_rows() > 0) {
				 foreach($query->result() as $row){
				 		$data['from_email']= $row->from_email;
				 		$data['from_name']= $row->from_name;
				 		$data['retry_limit']= $row->retry_limit;
				 		$data['default_pagination']= $row->default_pagination;
				 		$data['reset_pwd_days']= $row->reset_pwd_days;
				 		$data['allow_registration']= $row->allow_registration;
				 		}
			return $data;
		}
		return false;	
	}

public function restore_default_settings(){
		$data = array(
			'from_email'=>null,
			'from_name'=>'Webmaster',
			'retry_limit'=>5,
			'default_pagination'=>10,
			'reset_pwd_days'=>30,
			'allow_registration'=>0			
		);		
		$this->db->update('config', $data);
         if($this->db->affected_rows() > 0){
	         return true;
	         }else{
				return false;         
	         }
	}


public function update_config($id,$data)	{
	  $this->db->where ('Id',$id);
	  $this->db->update('config', $data);
         if($this->db->affected_rows() > 0){
	         return true;
	         }else{
				return false;         
	         }
}

public function get_from_email()	{
$query = $this->db->get('config');
 foreach($query->result() as $row){
 		$from_email= $row->from_email;
 	 }
 return $from_email;
	}	
	
public function set_from_email($from_email)	{
		$data = array(
			'from_email'=>$from_email
		);
		if($this->db->update('config',$data)){
		return true;
		}else{
		return false;
		}
}
	
public function get_from_name()	{
$query = $this->db->get('config');
 foreach($query->result() as $row){
 		$from_name= $row->from_name;
 	 }
 return $from_name;
	}	

public function set_from_name($from_name)	{
		$data = array(
			'from_name'=>$from_name
		);
		if($this->db->update('config',$data)){
		return true;
		}else{
		return false;
		}
   }
	
public function get_default_pagination(){
		$query = $this->db->get('config');
	     foreach($query->result() as $row){
 		 $default_pagination= $row->default_pagination;
		 }
		 return $default_pagination;
		 }
	
public function set_default_pagination($default_pagination)	{
		$data = array(
			'default_pagination'=>$default_pagination
		);
		if($this->db->update('config',$data)){
		return true;
		}else{
		return false;
		}
   }


public function get_reset_pwd_days(){
		$query = $this->db->get('config');
	    foreach($query->result() as $row){
 		 $reset_pwd_days= $row->reset_pwd_days;
		 }
		 return  $reset_pwd_days;
		 }
	
public function set_reset_pwd_days($reset_pwd_days)	{
		$data = array(
			'reset_pwd_days'=>$reset_pwd_days
		);
		if($this->db->update('config',$data)){
		return true;
		}else{
		return false;
		}
   }
   
 public function get_allow_registration(){
		$query = $this->db->get('config');
	    foreach($query->result() as $row){
	    $allow_registration= $row->allow_registration;
		 }
		 return  $allow_registration;
		 }
	
public function set_allow_registration($allow_registration)	{
		$data = array(
			'allow_registration'=>$allow_registration
		);
		if($this->db->update('config',$data)){
		return true;
		}else{
		return false;
		}
   }     
   
   
   
   
   
}
