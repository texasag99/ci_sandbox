<?php
/*
 * Filename : Config_model.php
 * Author : BEJAN NOURI
 * Date : 7-2-2014
 * Summary: Access data related to the application configuration table "config", this model is called by multiple controllers
 * */

class Load_settings_model extends CI_Model {
	
public function __construct(){
	parent::__construct();
	$this->load_email_settings();
	}


