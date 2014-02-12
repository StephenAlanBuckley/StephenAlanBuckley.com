<?php

require_once "/utilities/session_functions.php";

if (!empty($_GET['function'])) {
  session_start();
  $function = $_GET['function'];

  switch($function) {
    case 'get_fan_red_user_info':
      print_r(json_encode(get_fan_red_user_info());
      break;
  }
}
?>

<?php

function get_fan_red_user_info() {
  if (empty($_SESSION['fan_red_initialized'])) {
    $user_info = get_user_info();
    if (empty($user_info) {
      return "Not logged in!";
    }
    initialize_fan_red_session_for_user($user_info['user_id']);
  }

  return $_SESSION['fan_red_user_info'];
}

function initialize_fan_red_session_for_user($id) {
  $find_leagues_sql = 
    "SELECT league_id, league_name
     FROM Fan_Red_league
     WHERE league_organizer_id = $id;";
  $find_teams_sql =
    "SELECT team_id, team_name
    FROM Fan_Red_team
    WHERE team_owner_id = $id;";

  $db = new Database;
  $leagues = $db->query($find_leagues_sql);
  $teams = $db->query($find_teams_sql);
  $fan_red_user_info = {
    "teams" => $teams,
    "leagues" => $leagues
  };

  $_SESSION['fan_red_user_info'] = $fan_red_user_info;
  $_SESSION['fan_red_initialized'] = true;
}

?>
