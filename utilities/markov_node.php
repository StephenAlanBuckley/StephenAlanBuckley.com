<?php

class MarkovNode {

	public $my_string
	private $children; //These are the nodes that it will connect to! These should be 
	private $weights;  //The odds of going to a corresponding child- these should add up to 100%

	public function __construct($saying, $child_string, $weight_string){
		$this->$children = explode(',', $child_string);
		$this->$weights = explode(',', $weight_string);
		$this->$my_string = $saying;
	}

	public function get_random_child(){
		
	}
	
}

?>