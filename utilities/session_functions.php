<?php

if (!empty($_GET['function'])) {
  session_start();
  $function = $_GET['function'];

  switch($function) {
    case 'get_user_info':
      print_r(json_encode(get_user_info()));
      break;
  }
}
?>

<?php

function get_user_info() {
  return $_SESSION['user_info'];
}

?>
