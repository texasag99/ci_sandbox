<?php
/*
 * Filename : getsetDB.php
 * Author : BEJAN NOURI
 * Date : 1-22-2013
 * Summary: THIS FILE CREATED AS PART OF THE TUTORIAL DEMONSTRATION FOR 
 * 			LEARNING CODEIGNITER. USED TO GET AND SET DB VALUES. 
 * 
 * */

class User_model extends CI_Model {

	public function can_log_in()	{
		
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('user');		
		if($query->num_rows() == 1){
			return true;
			}else{
			return false;
			}		
	}	
	
	public function register_new_user($data){
         $this->db->insert('temp_user', $data);
         if($query->num_rows() == 1){
	         return true;
	         }else{
				return false;         
	         }
	}




}
