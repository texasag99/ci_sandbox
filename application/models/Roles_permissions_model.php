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
//MODEL FUNCTIONS FOR THE ROLES TABLE
	
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
	
	public function get_role($id){
		$this->db->where('id', $id);
		$query = $this->db->get("roles");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
		
	}
	
		public function list_active_roles(){
		$this->db->where('status', 'ACTIVE');
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
			$this->unlink_all_permissions_to_role($id);
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
	
	
	public function list_role_permissions($id){
	    $this->db->select('*');
        $this->db->from('xref_roles_permissions');
        $this->db->where('role_id', $id);
        $this->db->join('roles', 'xref_roles_permissions.role_id = roles.id');
        $this->db->join('permissions', 'xref_roles_permissions.permission_id = permissions.id');
        $this->db->order_by('permissions.permission', 'desc');
        $query = $this->db->get();
        $data = array();
        foreach ($query->result() as $row) {
        $data[] = $row;
        }
        return $data;
	}
		
	public function link_role_permission($role_id, $permission_id){
		$data = array(			
		    'role_id'=>$role_id,
			'permission_id'=>$permission_id
		);
	    $this->db->insert("xref_roles_permissions", $data);
		if($this->db->affected_rows() > 0){
	         return true;
	         }else{
			 return false;         
	         }
	}
	
	public function unlink_role_permission($role_id, $permission_id){
	    if($this->db->delete('xref_roles_permissions', array('role_id' => $role_id, 'permission_id' => $permission_id))){
		    return true;
		}else{
			return false;
		}
	}

	public function unlink_all_permissions_to_role($role_id){
		$this->db->where('role_id', $role_id);
		if($this->db->delete('xref_roles_permissions')){
		    return true;
		}else{
			return false;
		}
	}
	
	 public function link_multiple_permissions_to_role ($role_id, $permissions){
	 	foreach ($permissions as $value){
	 		$this->link_role_permission($role_id, $value);
	 	}
	 	if($this->db->affected_rows() > 0) {
	 		return true;	 	
	 	}else{
	 	return false;
	 	}	 
	 }
	
	
//MODEL FUNCTIONS FOR THE PERMISSIONS TABLE
	
	public function permissions_record_count() {
		return $this->db->count_all("permissions");
	}
	
	public function get_all_permissions(){
		$query = $this->db->get("permissions");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
		
	}
	
	public function get_all_permissions_paginated($limit, $start){
		$this->db->limit($limit,$start);
		$query = $this->db->get("permissions");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function get_permission($id){
		$this->db->where('id', $id);
		$query = $this->db->get("permissions");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}

public function list_active_permissions(){
		$this->db->where('status', 'ACTIVE');
		$query = $this->db->get("permissions");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
		
	}	
	
	public function delete_permission($id){
		$this->db->where('id',$id);
		if($this->db->delete('permissions')){
			return true;
		}else{
			return false;
		}
	}
	
	public function add_permission($data){
		$date_data = array( 
			'created'=>date("Y-m-d H:i:s"),
			'last_updated'=>date("Y-m-d H:i:s")
		);
		$permissions_data = array_merge($data,$date_data);
		$this->db->insert("permissions", $permissions_data);
		if($this->db->affected_rows() > 0){
	         return true;
	         }else{
			 return false;         
	         }
		
	}
	
	public function update_permission($data, $id){
		$date_data = array( 
			'last_updated'=>date("Y-m-d H:i:s")
		);
		$permissions_data = array_merge($data,$date_data);
		$this->db->where('id', $id);
		$this->db->update('permissions', $permissions_data);
		if($this->db->affected_rows() > 0){
	         return true;
	         }else{
			 return false;         
	         }
		
	}
	
}