<?php

class Math extends CI_Model
	{
		public function add($val1, $val2)
		{
			return $val1 + $val2 ;
		}
		
		public function subtract($val1, $val2)
		{
			return $val1 - $val2 ;
		}
		
		public function multiply($val1, $val2)
		{
			return $val1 * $val2 ;
		}
		
		public function divide($val, $val2)
		{
			return $val1 / $val2 ;
		} 
	
}

?>
