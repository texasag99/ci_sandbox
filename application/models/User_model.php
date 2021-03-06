<?php
/*
 * Filename : models/User_model.php
 * Author : BEJAN NOURI
 * Date : 7-2-2014
 * Summary: Access data related to the User controller and the Profile controller
 * */

class User_model extends CI_Model {
	
public function user_record_count() {
		return $this->db->count_all("user");
	}
	
public function active_user_record_count(){
	$this->db->where('status','ACTIVE');
	return $this->db->count_all_results("user");			
	}
	
public function search_user_record_count($search_by){
	$this->db->or_like('first', $search_by);
   $this->db->or_like('last', $search_by );
   $this->db->or_like('email', $search_by );
	return $this->db->count_all_results("user");			
	}
	
public function sort_by($sort_by){
		switch($sort_by){
					case 1: return $this->db->order_by("last","asc");
					case 2: return $this->db->order_by("last","desc");
					case 3: return $this->db->order_by("email","asc");
					case 4: return $this->db->order_by("email","desc");
					case 5: return $this->db->order_by("status","asc");
					case 6: return $this->db->order_by("status","desc");
					case 7: return $this->db->order_by("locked","asc");
					case 8: return $this->db->order_by("locked","desc");
					case 9: return $this->db->order_by("created","asc");
					case 10: return $this->db->order_by("created","desc");
					case 11: return $this->db->order_by("last_updated","asc");
					case 12: return $this->db->order_by("last_updated","desc");
					case 13: return $this->db->order_by("last_activity","asc");
					case 14: return $this->db->order_by("last_activity","desc");
					default : return NULL;			
			}		
		}
	
public function get_all_users(){
		$query = $this->db->get("user");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}

public function get_all_users_paginated($limit, $start, $sort_by){
		$this->sort_by($sort_by);		
		$this->db->limit($limit,$start);
		$query = $this->db->get("user");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}
	
public function get_all_active_users_paginated($limit, $start, $sort_by){
		$this->sort_by($sort_by);		
		$this->db->limit($limit,$start);
		$this->db->where('status','ACTIVE');
     $query = $this->db->get("user");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}
	
public function  search_users_paginated($limit, $start, $sort_by, $search_by){
		$this->sort_by($sort_by);		
		$this->db->limit($limit,$start);
		$search_by = trim($search_by);
      $this->db->or_like('first', $search_by);
      $this->db->or_like('last', $search_by );
      $this->db->or_like('email', $search_by );
      $query = $this->db->get("user");
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row){
					$data[] = $row;
			}
			return $data;
		}
		return false;	
	}	

public function delete_user($id){
		$this->db->where('id',$id);
		if($this->db->delete('user')){
			$this->unlink_all_roles_to_user($id);
		    return true;
		}else{
			return false;
		}
	}

public function can_log_in(){
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));		
		if($this->verify_password($password, $email)){
			return true;
			}else{
			return false;
			}		
}	//Verifies the user is allowed to login	

public function is_active(){
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('status','ACTIVE');
		$query = $this->db->get('user');		
		if($query->num_rows() == 1){
			return true;
			}else{
			return false;
			}		
	}	//Verifies the user account is active
	
public function is_unlocked(){
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('locked',0);
		$query = $this->db->get('user');		
		if($query->num_rows() == 1){
			return true;
			}else{
			return false;
			}		
	}	//Verifies the user account is not locked

public function verify_email($email){
		$this->db->where('email', $email);
		$query = $this->db->get('user');		
		if($query->num_rows() == 1){
			return true;
			}else{
			return false;
			}		
	} //Verifies the user account exists

public function update_last_activity(){
	$user_data = array (
	'last_activity'=>date("Y-m-d H:i:s")
	);
	$this->db->where('email', $this->input->post('email'));
	$this->db->update('user',$user_data);
	if($this->db->affected_rows() >0){
					return true;
				}else{
					return false;
				}
}
	
public function verify_password($password, $email){
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('user');		
		if($query->num_rows() == 1){
			$this->reset_retry_counter($email);			
			return true;			
			}else{
			if ($this->verify_email($email)){
				$this->increase_retry_counter($email);
				}else{
				return false;
				}
		   }		
	} //Verifies the password is correct
	
public function increase_retry_counter($email){ //increments the password retries
	$this->db->where('email',$email);
	$query = $this->db->get('user');
	foreach($query->result() as $row){
 		$user_data['retry_counter']= $row->retry_counter;
 	    }
  $retry_limit = $this->get_retry_limit();
  if ($retry_limit == NULL || $retry_limit == 0){ 
  		$retry_limit = 3; //default is 3 tries and your out
  		}else{ 
  		$retry_limit = $retry_limit; 
  		}
  $counter = $user_data['retry_counter'];
  if ($counter >= $retry_limit) {
  	$user_data= array('locked'=>1);
  	$this->db->where('email',$email);
  	$this->db->update('user',$user_data);
  	if($this->db->affected_rows() > 0){ 
  		return true; 
  		}else{ 
  		return false; 
  		}  
  }else{
   ++$counter;
   $user_data= array( 'retry_counter'=>$counter);
   $this->db->where('email',$email);
   $this->db->update('user',$user_data);
   if($this->db->affected_rows() > 0){
   	return true;
   	}else{
   	return false;
   	}
   }
} //For failed password attempts, mark the retry counter

public function reset_retry_counter($email){
	$user_data= array( 'retry_counter'=>0);
   $this->db->where('email',$email);
   $this->db->update('user',$user_data); 
} //For successful password validation, take the retry counter back to 0

public function get_retry_limit() {
	$query = $this->db->get('config');
 	foreach($query->result() as $row){
 		$retry_limit= $row->retry_limit;
 	    }
 	return $retry_limit;
	} //Pull the retry limit set in the config table	

public function update_password($password, $email){
$user_data = array (
		'password' => $password,
		'pwd_last_updated' =>date("Y-m-d H:i:s"),
		'last_updated'=>date("Y-m-d H:i:s")
);
$this->db->where('email',$email);
$this->db->update('user',$user_data);
if($this->db->affected_rows() >0){
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
								'pwd_last_updated'=>date("Y-m-d H:i:s"),
								'created'=>date("Y-m-d H:i:s"),
								'last_updated'=>date("Y-m-d H:i:s"),
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
	
public function create_new_user($user_data){
	  $add_data = array(
							  'created'=>date("Y-m-d H:i:s"),
								'last_updated'=>date("Y-m-d H:i:s"),
								'last_activity'=>date("Y-m-d H:i:s"),
								'locked' => 0	  
	  );	
	  $data =array_merge($user_data, $add_data);
	  $this->db->insert('user',$data);
	   if($this->db->affected_rows() > 0){
	         return true;
	         }else{
				return false;         
	         }
	}	
public function confirm_key($key, $return_values){
		$this->db->where('temp_key', $key);
		$query = $this->db->get('temp_user');		
		if($query->num_rows() == 1){
					if($return_values == true) {
						foreach($query->result() as $row){
						$temp_data{'email'}= $row->email;
						}
					   return $temp_data;
					}else{
						return true;
					}
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
								'last_activity'=>date("Y-m-d H:i:s"),
								'status' => 'ACTIVE'
								);				
	$this->db->where('email', $email);
	$this->db->update('user',$user_data);
	if($this->db->affected_rows() > 0){
	$this->db->delete('temp_user', array('temp_key' => $key));
	$user_data = $this->get_user_data($email);
	$id = $user_data['id'];
	$this->create_new_profile ($id);
	return true;	
	}else{
	return false;
	}
}

public function get_user_data($email){
 $this->db->where('email', $email);
 $query = $this->db->get('user');
 foreach($query->result() as $row){
 		$user_data['email']= $row->email;
 		$user_data['first']= $row->first;
 		$user_data['last']= $row->last;
 		$user_data['created']= $row->created;
 		$user_data['last_updated']= $row->last_updated; 
 		$user_data['last_activity']= $row->last_activity;
 		$user_data['pwd_last_updated']= $row->pwd_last_updated;
 		$user_data['id']= $row->id;
 }
 $id = $user_data['id'];
 $user_data['permissions'] = $this->get_user_permissions($id);
 $user_profile = $this->get_user_profile($id);
 $user_data['profile_pic'] = $user_profile['profile_pic'];
 return $user_data;
 }
 
 public function get_user($id){
 $this->db->where('id', $id);
 $query = $this->db->get('user');
 foreach($query->result() as $row){
 		$user_data['email']= $row->email;
 		$user_data['first']= $row->first;
 		$user_data['last']= $row->last;
 		$user_data['created']= $row->created;
 		$user_data['last_updated']= $row->last_updated;
 		$user_data['last_activity']= $row->last_activity; 
 		$user_data['pwd_last_updated']= $row->pwd_last_updated;
 		$user_data['status']= $row->status;
 		$user_data['id']= $row->id;
 }
 $user_data['permissions'] = $this->get_user_permissions($id);
 return $user_data;
 }
 
 public function get_user_profile($id){
 $this->db->where('user_id',$id);
 $query = $this->db->get('user_profile');
 if($query->num_rows() > 0){
 	foreach($query->result() as $row){
       $profile_data['address1'] = $row->address1;
       $profile_data['address2'] = $row->address2;
       $profile_data['city'] = $row->city;
       $profile_data['state'] = $row->state;
       $profile_data['company_name'] = $row->company_name;
       $profile_data['country'] = $row->country;
       $profile_data['profile_updated'] = $row->last_updated;
       $profile_data['email2'] = $row->email2;
       $profile_data['fax'] = $row->fax;
       $profile_data['profile_pic'] = $row->profile_pic;
       $profile_data['mobile'] = $row->mobile;
		 $profile_data['tel'] = $row->tel;
		 $profile_data['website'] = $row->website; 	
	    $profile_data['zip'] = $row->zip;
 	}}else{
  		 return false;
 }
return $profile_data;
}

public function update_user_data(){
			$user_update = array(
								'first'=>$this->input->post('first'),
								'last'=>$this->input->post('last'),
								'last_updated'=>date("Y-m-d H:i:s")
			);
			$user_data = $this->get_user_data($this->session->userdata('email'));
			$id = $user_data['id'];
			$this->db->where('id', $id);
         $this->db->update('user', $user_update);
         if($this->db->affected_rows() > 0){
	         return true;
	         }else{
				return false;         
	         }
	}

public function update_user_value($data, $id){
			$this->db->where('id', $id);
			$data['last_updated'] = date("Y-m-d H:i:s");
			$this->db->update('user', $data);
         if($this->db->affected_rows() > 0){
	         return true;
	         }else{
				return false;         
	         }
	}
	
public function create_new_profile($id){
		$profile_data = array(
		    'user_id'=>$id
		    );
		$this->db->insert('user_profile',$profile_data);	
		 if($this->db->affected_rows() > 0){
		  return true;
		  }else{
			return false;         
			}
	}

public function update_profile_pic($id, $data){
			$this->db->where('user_id', $id);
			$data['last_updated'] = date("Y-m-d H:i:s");
       	$this->db->update('user_profile', $data);
         if($this->db->affected_rows() > 0){
	         return true;
	         }else{
				return false;         
	         }
	}
	
public function update_user_profile($id){
			$profile_data = array(
								'address1'=>$this->input->post('address1'),
								'address2'=>$this->input->post('address2'),
								'city'=>$this->input->post('city'),
								'state'=>$this->input->post('state'),
								'zip'=>$this->input->post('zip'),
								'country'=>$this->input->post('country'),
								'email2'=>$this->input->post('email2'),
								'tel'=>$this->input->post('tel'),
								'mobile'=>$this->input->post('mobile'),
								'fax'=>$this->input->post('fax'),
								'company_name'=>$this->input->post('company_name'),
								'website'=>$this->input->post('website'),						
								'last_updated'=>date("Y-m-d H:i:s")
			);			
			$this->db->where('user_id', $id);
       	$this->db->update('user_profile', $profile_data);
         if($this->db->affected_rows() > 0){
	         return true;
	         }else{
				return false;         
	         }
	}
	
public function register_new_password($data){
         $this->db->insert('temp_user', $data);
         if($this->db->affected_rows() > 0){
	         return true;
	         }else{
				return false;         
	         }
	
	}
	
public function activate_new_password($key){
		$this->db->where('temp_key', $key);
	   $query = $this->db->get('temp_user');
		 foreach($query->result() as $row){
		 		$user_data['email']= $row->email;
		 		$user_data['password'] = $row->password;
		 }
		 if (empty($user_data['password'])){
					 $password = md5($this->input->post('password'));		 
					 }else{ 
					 $password = $user_data['password'];
					 }
		 $email = $user_data['email'];
		 if($this->update_password($password,$email)){
		 		$this->db->delete('temp_user', array('temp_key' => $key));
		 		return true;
		 }else{
				return false;		 
		 }	
	}
	
public function get_user_permissions($id){
	$this->db->select('permission_id');
	$this->db->from('xref_roles_permissions');
	$this->db->join('xref_user_roles','xref_user_roles.role_id = xref_roles_permissions.role_id','left');
	$this->db->join('roles','roles.id = xref_user_roles.role_id', 'left');
	$this->db->where ('roles.status','ACTIVE');
	$this->db->where('xref_user_roles.user_id', $id);
	$this->db->distinct();
  $query = $this->db->get();
  $permissions = array();
   foreach ($query->result() as $row){
   $permissions[] = $row;  
   }
  $active_permissions = $this->verify_active_permissions($permissions);
  	return $active_permissions;
}

public function verify_active_permissions($permissions){
$active_permissions = array();
foreach($permissions as $value){
$this->db->select('id');
$this->db->from('permissions');
$this->db->where('id',$value->permission_id);
$this->db->where('status', 'ACTIVE');
$query = $this->db->get();
foreach($query->result() as $row){
$active_permissions[] = $row;
}}	
	return $active_permissions; 

}
	
public function list_user_roles($id){
	    $this->db->select('*');
        $this->db->from('xref_user_roles');
        $this->db->where('user_id', $id);
        $this->db->join('user', 'xref_user_roles.user_id = user.id');
        $this->db->join('roles', 'xref_user_roles.role_id = roles.id');
        $this->db->order_by('roles.role', 'desc');
        $query = $this->db->get();
        $data = array();
        foreach ($query->result() as $row) {
        $data[] = $row;
        }
        return $data;
	}
		
public function link_user_roles($user_id, $role_id){
		$data = array(			
		   'user_id'=>$user_id,
			 'role_id'=>$role_id
		);
	  $this->db->insert("xref_user_roles", $data);
		if($this->db->affected_rows() > 0){
	         return true;
	         }else{
			 return false;         
	         }
	}
	
public function unlink_user_roles($user_id, $role_id){
	    if($this->db->delete('xref_user_roles', array('user_id' => $user_id, 'role_id' => $role_id))){
		    return true;
		}else{
			return false;
		}
	}

public function unlink_all_roles_to_user($user_id){
		$this->db->where('user_id', $user_id);
		if($this->db->delete('xref_user_roles')){
		    return true;
		}else{
			return false;
		}
	}
	
public function link_multiple_roles_to_user($user_id, $roles){
	 	foreach ($roles as $value){
	 		$this->link_user_roles($user_id, $value);
	 	}
	 	if($this->db->affected_rows() > 0) {
	 		return true;	 	
	 	}else{
	 	return false;
	 	}	 
	 }

}
