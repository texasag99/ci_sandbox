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
	

public function active_roles_record_count() {
	  $this->db->where('status','ACTIVE');
		return $this->db->count_all_results("roles");
	}
	
public function search_roles_record_count($search_by){
	$this->db->or_like('role', $search_by);
	return $this->db->count_all_results("roles");			
	}

public function roles_sort_by($sort_by){
		switch($sort_by){
					case 1: return $this->db->order_by("role","asc");
					case 2: return $this->db->order_by("role","desc");
					case 3: return $this->db->order_by("description","asc");
					case 4: return $this->db->order_by("description","desc");
					case 5: return $this->db->order_by("status","asc");
					case 6: return $this->db->order_by("status","desc");
					case 7: return $this->db->order_by("created","asc");
					case 8: return $this->db->order_by("created","desc");
					case 9: return $this->db->order_by("last_updated","asc");
					case 10: return $this->db->order_by("last_updated","desc");
					default : return NULL;			
			}		
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
	
	public function get_all_roles_paginated($limit, $start,$sort_by){
		$this->roles_sort_by($sort_by);
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
	
		public function get_active_roles_paginated($limit, $start,$sort_by){
		$this->roles_sort_by($sort_by);
		$this->db->limit($limit,$start);
		$this->db->where('status','ACTIVE');
		$query = $this->db->get("roles");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
	return false;	
	}
	
	public function  search_roles_paginated($limit, $start, $sort_by, $search_by){
		$this->roles_sort_by($sort_by);		
		$this->db->limit($limit,$start);
		$search_by = trim($search_by);
      $this->db->or_like('role', $search_by);
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
	
	
//MODEL FUNCTIONS FOR THE PERMISSIONS TABLE********************************************************/
	
	public function permissions_record_count() {
		return $this->db->count_all("permissions");
	}
	

public function active_permissions_record_count() {
	  $this->db->where('status','ACTIVE');
		return $this->db->count_all_results("permissions");
	}
	
public function search_permissions_record_count($search_by){
	$this->db->or_like('permission', $search_by);
	$this->db->or_like('category', $search_by);
	$this->db->or_where('id', $search_by);
	return $this->db->count_all_results("permissions");	
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

public function permissions_sort_by($sort_by){
		switch($sort_by){
					case 1: return $this->db->order_by("id","asc");
					case 2: return $this->db->order_by("id","desc");
					case 3: return $this->db->order_by("permission","asc");
					case 4: return $this->db->order_by("permission","desc");
					case 5: return $this->db->order_by("description","asc");
					case 6: return $this->db->order_by("description","desc");
					case 7: return $this->db->order_by("status","asc");
					case 8: return $this->db->order_by("status","desc");
					case 9: return $this->db->order_by("category","asc");
					case 10: return $this->db->order_by("category","desc");
					case 11: return $this->db->order_by("created","asc");
					case 12: return $this->db->order_by("created","desc");
					case 13: return $this->db->order_by("last_updated","asc");
					case 14: return $this->db->order_by("last_updated","desc");
					default : return NULL;			
			}		
		}


public function get_all_permissions_paginated($limit, $start,$sort_by){
	  $this->permissions_sort_by($sort_by);		
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
	
public function get_active_permissions_paginated($limit, $start,$sort_by){
	   $this->permissions_sort_by($sort_by);		
		$this->db->limit($limit,$start);
	   $this->db->where('status','ACTIVE');
		$query = $this->db->get("permissions");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
public function  search_permissions_paginated($limit, $start, $sort_by, $search_by){
		$this->permissions_sort_by($sort_by);		
		$this->db->limit($limit,$start);
		$search_by = trim($search_by);
		$this->db->or_like('permission', $search_by);
	   $this->db->or_like('category', $search_by);
	   $this->db->or_where('id', $search_by);
      $query = $this->db->get("permissions");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}		
	
public function get_permission_categories(){
		$this->db->select('DISTINCT(category)');
		$query = $this->db->get('permissions');
		if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
					}		
					return $data;				
			}else{
			return false;				
				}	
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
		$data['created'] =date("Y-m-d H:i:s");
		$data['last_updated']=date("Y-m-d H:i:s");
		$this->db->insert("permissions", $data);
		if($this->db->affected_rows() > 0){
	         return true;
	         }else{
			 return false;         
	         }
		
	}
	
	public function update_permission($data, $id){
		$data['last_updated'] = date("Y-m-d H:i:s");		
		$this->db->where('id', $id);
		$this->db->update('permissions', $data);
		if($this->db->affected_rows() > 0){
	         return true;
	         }else{
			 return false;         
	         }
		
	}
	
}