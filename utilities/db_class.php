<?php

Class Database{
	public $server_ip, $username, $password, $db_name;

	public $connection;

	public function query($query_string){
		$query_result= $this->connection->query($query_string);
		$result_array = $this->result_set_to_array($query_result);
		return $result_array;
	}

	private function result_set_to_array($result_set){
    if(is_object($result_set)){
	    for ($new_array = array(); $tmp = $result_set->fetch_array(MYSQL_ASSOC);  ) $new_array[] = $tmp;
  	  return $new_array;
		}
  }

	public function make_connection(){
		$this->connection = new mysqli(
      $this.server_ip, 
      $this.username, 
      $this.password, 
      $this.db_name);
	}

	public function make_sab_basics_database_connection(){
    $this.server_ip = '205.178.146.105';
    $this.username = 'sabuckley';
    $this.password = 'SBuck1ey';
    $this.db_name = 'sab_basics';
    $this->make_connection();
	}
}

?>
