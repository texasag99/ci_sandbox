<?php
/*
 * Filename : Roles-permissions_model.php
 * Author : BEJAN NOURI
 * Date : 7-24-2014
 * Summary: Access data related to the Roles and Permissions controller 
 * */

class Roles_permissions_model extends CI_Model { 
 
	public function __construct(){
		parent::__construct();
	}
	
	public function roles_record_count() {
		return $this->db->count_all("roles");
	}
	
	public function get_all_roles(){
		$query = $this->db->get("roles");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}
	
	public function get_all_roles_paginated($limit, $start){
		$this->db->limit($limit,$start);
		$query = $this->db->get("roles");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}
	
	public function delete_role($id){
		$this->db->where('id',$id);
		if($this->db->delete('roles')){
			return true;
		}else{
			return false;
		}
	}
	
	public function add_role($data){
		$date_data = array( 
			'created'=>date("Y-m-d H:i:s"),
			'last_updated'=>date("Y-m-d H:i:s")
		);
		$role_data = array_merge($data,$date_data);
		$this->db->insert("roles", $role_data);
		if($this->db->affected_rows() > 0){
	         return true;
	         }else{
			 return false;         
	         }
	}
	
	public function update_role($data, $id){
		$date_data = array( 
			'last_updated'=>date("Y-m-d H:i:s")
		);
		$role_data = array_merge($data,$date_data);
		$this->db->where('id', $id);
		$this->db->update("roles", $role_data);
		if($this->db->affected_rows() > 0){
	         return true;
	         }else{
			 return false;         
	         }
	}
}