<?php


Class Database{
	public $server_ip, $username, $password, $db_name;

	public $connection;

  function __construct() {
    $this->make_sab_basics_database_connection();
  }

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
      $this->server_ip,
      $this->username,
      $this->password,
      $this->db_name);
	}

	public function make_sab_basics_database_connection(){
      require "/home/stephena/db_access.inc.php";
      $this->server_ip = 'localhost';
      $this->username = 'stephena';
      $this->password = $sab_basics_password;
      $this->db_name = 'stephena_sab_basics';
      $this->make_connection();
	}

	public function make_informery_connection(){
      require "/home/stephena/db_access.inc.php";
      $this->server_ip = 'localhost';
      $this->username = 'stephena';
      $this->password = $sab_basics_password;
      $this->db_name = 'stephena_informery';
      $this->make_connection();
	}

	public function make_sab_basics_database_connection(){
      require "/home/stephena/db_access.inc.php";
      $this->server_ip = 'localhost';
      $this->username = 'stephena';
      $this->password = $sab_basics_password;
      $this->db_name = 'stephena_improv_extension';
      $this->make_connection();
	}

  public function end_connection() {
    $this->connection->close();
  }

  public function get_error() {
    return $this->connection->error;
  }

  public function sanitize($string) {
    return $this->connection->real_escape_string($string);
  }

  public function get_insert_id() {
    return $this->connection->insert_id;
  }
}

?>
