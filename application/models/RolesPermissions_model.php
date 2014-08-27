<?php
/*
 * Filename : User_model.php
 * Author : BEJAN NOURI
 * Date : 7-24-2014
 * Summary: Access data related to the Roles and Permissions controller 
 * */

class RolesPermissions_model extends CI_Model { 
 
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
       $profile_data['mobile'] = $row->mobile;
		 $profile_data['tel'] = $row->tel;
		 $profile_data['website'] = $row->website; 	
	    $profile_data['zip'] = $row->zip;
 	}}else{
  		 return false;
 }
return $profile_data;
}