<?php

require_once "db_class.php";
require_once "ajax_functions.php";

if (!empty($_GET['function'])) {
  session_start();
  $function = $_GET['function'];

  switch($function) {
    case 'register':
      $validation_attempt = validate_input(array("username", "password"));
      
      if ($validation_attempt["Result"] == "false") {
        print_r(json_encode($validation_attempt));
        break;
      }
      $email = !empty($_GET['email']) ? $_GET['email'] : '';

      $register_attempt = register_new_account($_GET['username'], $_GET['password'], $email);
      print_r(json_encode($register_attempt));
      break;


    case 'login':
      $validation_attempt = validate_input(array("username", "password"));

      if ($validation_attempt["Result"] == "false") {
        print_r(json_encode($validation_attempt));
        break;
      }

      $login_attempt = login($_GET['username'], $_GET['password']);
      print_r(json_encode($login_attempt));
      break;


    case 'logout':
      print_r(json_encode(logout()));
      break;


    case 'change_password':
      $validation_attempt = validate_input(array("new_password", "old_password"));

      if ($validation_attempt["Result"] == "false") {
        print_r(json_encode($validation_attempt));
        break;
      }

      $change_attempt = change_password($_GET['new_password'], $_GET['old_password']);
      print_r(json_encode($change_attempt));
      break;
  }
}
?>

<?php
//Functions

/*
 * registers a new account with the given username, password, and email.
 *
 * returns an array with a ["Result"] and a ["Message"]
 * if Result is true then it succeeded, if false then it failed.
 */
function register_new_account($username, $password, $email) {
  $db = new Database;
  $db->make_sab_basics_database_connection();
  
  $username = $db->sanitize($username);
  $unique_username_sql = " 
      SELECT 1 
      FROM user 
      WHERE username = $username 
  "; 

  $row = $db->query($unique_username_sql); 

  if($row) 
  {
    return result_set("false", "Username already in use");
  } 

  $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
  
  $password = hash_password($password, $salt);
   
  $email = $db->sanitize($email);
  $insert_query =  
      "INSERT INTO user (user_name, user_password, user_salt, user_email) VALUES('$username', '$password', '$salt', '$email');"; 

  $db->query($insert_query);

  $error = $db->get_error();

  if ($error) {
    $db->end_connection();
    return result_set("false", $error); 
  }
  $db->end_connection();
  return result_set("true", "username successfully registered");
}

function login($username, $password) {
  $db = new Database;
  $db->make_sab_basics_database_connection();

  $username = $db->sanitize($username);
  $get_user_info_sql =
    "SELECt * 
    FROM user
    WHERE user_name = '$username';";

  $user_info = $db->query($get_user_info_sql);

  if(!empty($user_info)) {
    $user_info = $user_info[0]; //we do this so that we're dealing with the first returned result, which should be the only result!
    $salt = $user_info['user_salt'];

    
    $password = hash_password($password, $salt);

    if($password == $user_info['user_password']) {
      $_SESSION['user_info'] =  array(
       "user_name" => $username,
       "user_id" => $user_info['user_id'],
       "user_email" => $user_info['user_email']);
      
      $log_login_sql =
        "UPDATE user SET user_last_login = NOW()
        WHERE user_name = '$username';";
      $db->query($log_login_sql);
      return result_set("true", "Successfully logged in.");
    }
    else {
      return result_set("false", "Incorrect password");
    }
  }
  else {
    return result_set("false", "No user with that name.");
  }
}

function change_password($new_password, $old_password) {
  if (!empty($_SESSION['user_info']) && $_SESSION['user_info']['user_id'] > 0) {
    $db = new Database;
    $db->make_sab_basics_database_connection();
    
    $user_id = $_SESSION['user_info']['user_id'];
    $get_user_info_sql =
      "SELECT *
      FROM user
      WHERE user_id = $user_id;";

    $user_info = $db->query($get_user_info_sql);

    if (empty($user_info)) {
      return result_set("false", "Current user ID not found in DB.");
    }
    $user_info = $user_info[0]; //So that we're dealing with the first returned result of the query

    $old_pass_hash = hash_password($old_password, $user_info['user_salt']);
    
    print_r($user_info);
    print_r("<br>");
    print_r($old_pass_hash);
    print_r("<br>");
    print_r($user_info['user_password']);
    print_r("<br>");
    if ($old_pass_hash == $user_info['user_password']) {
      $new_pass_hash = hash_password($new_password, $user_info['user_salt']);
      $update_password_sql =
        "UPDATE user
        SET user_password = '$new_pass_hash'
        WHERE user_id = $user_id;";

      $db->query($update_password_sql);
      if ($db->get_error()) {
        print_r($db->get_error());
        $db->end_connection();
        return result_set("false", "updating the password failed.");
      }
      return result_set("true", "password updated!");
    } else {
      return result_set("false", "entered an incorrect old password!");
    }
  }
}

function logout(){
  unset($_SESSION['user_info']);
  return result_set("true", "logged out successfully");
}
    
function hash_password($password, $salt) {
  $password = hash('sha256', $password . $salt);
  for($round = 0; $round < 65536; $round++) { 
      $password = hash('sha256', $password . $salt); 
  } 
  return $password;
}

/*
 * validates the GET paramters that are listed in $input_keys
 * input_keys is an array of strings which will be used as GET parameters
 *
 * returns a result set with Result and Message like register_new_account
 */
function validate_input($input_keys) {
  foreach($input_keys as $key) {
    if (!empty($_GET[$key])) {
      if (strlen($_GET[$key]) < 5) {
        return result_set("false", "$key is too short- must be at least 5 characters");
      }
    } else {
      return result_set("false", "$key is not set");
    }
  }
  return result_set("true", "all inputs validataed");
}
?>
