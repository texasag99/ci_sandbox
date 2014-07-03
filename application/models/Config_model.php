<?php
/*
 * Filename : Config_model.php
 * Author : BEJAN NOURI
 * Date : 7-2-2014
 * Summary: Access data related to the application configuration table "config", this model is called by multiple controllers
 * */

class Config_model extends CI_Model {

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

public function set_from_namel($from_name)	{
		$data = array(
			'from_name'=>$from_name
		);
		if($this->db->update('config',$data)){
		return true;
		}else{
		return false;
		}
}


}
