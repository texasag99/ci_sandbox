<?php  
/*
 * Filename : CALC.PHP
 * Author : BEJAN NOURI
 * Date : 12-06-2013
 * Summary: THIS FILE CREATED AS PART OF THE TUTORIAL DEMONSTRATION FOR 
 * 			LEARNING CODEIGNITER. 
 * 
 * */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calc extends CI_Controller {


	public function index()
	{
		$data['title'] = "Calculator";
		$data['page_header'] = "Welcome to the Calculator!";
		$data['page_content'] = "";
		$this->load->view("calc_view",$data);
	}
	
	public function add($val1, $val2)
	{
		$this->load->model("math");
		$addTotal = $this->math->add($val1, $val2);
		$data['title'] = "Calculator | Add";
		$data['page_header'] = "Adding!";
		$data['page_content'] = "<h2>The following two values were added: ".$val1." + ".$val2." = ".$addTotal."</h2>";
		$this->load->view("calc_view",$data);
	}

	public function subtract($val1, $val2)
	{
		$this->load->model("math");
		$subTotal = $this->math->subtract($val1, $val2);
		$data['title'] = "Calculator | Subtract";
		$data['page_header'] = "Subtracting!";
		$data['page_content'] = "<h2>The following two values were subtracted: ".$val1." - ".$val2." = ".$subTotal."</h2>";
		$this->load->view("calc_view",$data);
	}
	public function multiply($val1, $val2)
	{
		$this->load->model("math");
		$multiplyTotal = $this->math->multiply($val1, $val2);
		$data['title'] = "Calculator | Multiply";
		$data['page_header'] = "Multiplying!";
		$data['page_content'] ="<h2>The following two values were multiplied: ".$val1." * ".$val2." = ".$multiplyTotal."</h2>";
		$this->load->view("calc_view", $data);
	}
}
?>
