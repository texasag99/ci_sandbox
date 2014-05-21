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
	
	
public function is_active()	{
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', md5($this->input->post('password')));
		$this->db->where('status','ACTIVE');
		$query = $this->db->get('user');		
		if($query->num_rows() == 1){
			return true;
			}else{
			return false;
			}		
	}	

public function is_unlocked()	{
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', md5($this->input->post('password')));
		$this->db->where('locked',0);
		$query = $this->db->get('user');		
		if($query->num_rows() == 1){
			return true;
			}else{
			return false;
			}		
	}	
	
public function register_new_user($data){
			$user_data = array(
								'first'=>$this->input->post('first'),
								'last'=>$this->input->post('last'),
								'email'=>$this->input->post('email'),
								'password'=>md5($this->input->post('password')),
								'created'=>date("Y-m-d H:i:s"),
								'status' => 'PENDING',
								'locked' => 0
			);
         $this->db->insert('temp_user', $data);
         $this->db->insert('user',$user_data);
         if($this->db->affected_rows() > 0){
	         return true;
	         }else{
				return false;         
	         }
	}

public function confirm_key($key){
		$this->db->where('temp_key', $key);
		$query = $this->db->get('temp_user');		
		if($query->num_rows() == 1){
			return true;
			}else{
			return false;
			}	
}

public function activate_new_user($key){
	$this->db->where('temp_key',$key);
	$query = $this->db->get('temp_user');
	foreach($query->result() as $row)
	{
		$email = $row->email;
	}
   $user_data = array(
								'last_updated'=>date("Y-m-d H:i:s"),
								'status' => 'ACTIVE'
								);
	$this->db->where('email', $email);
	$this->db->update('user',$user_data);
	if($this->db->affected_rows() > 0){
	return true;
	}else{
	return false;
	}
}




}
