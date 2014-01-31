<?php

require_once "../../utilities/db_class.php";
require_once "../../utilities/ajax_functions.php";

if (!empty($_GET['function'])) {
  session_start();
  $function = $_GET['function'];

  switch($function) {
    case 'create_league':
      $results = create_new_league($_GET['id'], $_GET['name'], $_GET['days']);
      print_r(json_encode($results));
      break;
    case 'add_team_to_league':
      print_r(json_encode($results)):
      $results = add_team_to_league($_GET['league_id'], $_GET['user_id'], $_GET['invite_id'], $_GET['team_name'], $_GET['team_users']) {
      breakl
    //put functions here when I have them
    //don't forget break; between cases!
  }
}

?>

<?php

function create_new_league($organizer_id, $league_name, $days) {
  $db = new Database;
  $db->make_sab_basics_database_connection();
  
  $organizer_id = $db->sanitize($organizer_id);
  $league_name = $db->sanitize($league_name);
  $days = $db->sanitize($days);

  $create_league_sql =
  "INSERT INTO Fan_Red_league (league_name, league_organizer_id, league_game_every_blank_days)
  VALUES ('$league_name', '$organizer_id', '$days');";
  
  $db->query($create_league_sql);
  
  $league_id = $db->get_insert_id();

  $error = $db->get_error();

  if ($error) {
    $db->end_connection();
    return result_set("false", $error); 
  }
  $db->end_connection();
  return result_set("true", "$league_id");
}

function add_team_to_league($league_id, $team_user_id, $invite_id, $team_name, $team_users) {
  $league_info_results = get_league_info($league_id);
  if ($league_info_results["Result"] !== "true") {
    return $league_info_results;
  }

  $league_info = $league_info_results["Message"];

  if (count($league_info['league_users']) > 9) {
    return result_set("false", "There are already 10 participants in this league. :( Sorry!");
  }

  $potential_inviters = explode(',', $league_info['league_users']);
  $potential_inviters[] = $league_info['league_organizer_id'];

  if (!in_array($invite_id, $potential_inviters)) {
    return result_set("false", "The invitation isn't from a user in this league!");
  }

  $db = new Database;
  $league_id = $db->sanitize($league_id);
  $team_user_id = $db->sanitize($team_user_id);
  $team_name = $db->sanitize($team_name);
  $team_users = $db->sanitize($team_users);

  $team_creation_sql =
  "INSERT INTO Fan_Red_team (team_league_id, team_owner_id, team_usernames, team_name)
  VALUES ('$league_id', '$team_user_id', '$team_users', '$team_name');";
  
  $db->query($team_creation_sql);

  $error = $db->get_error();

  if (!empty($error)) {
    return result_set("false", $error);
  }

  $team_id = $db->get_insert_id();
  
  //We need to be conscious of the fact that this is a comma-delmited string
  if (!empty($league_info['league_users'])) {
    $team_user_string = "," . $team_user_id;
  } else {
    $team_user_string = $team_user_id;
  }

  if (!empty($league_info['league_teams'])) {
    $team_id_string = "," . $team_id;
  } else {
    $team_id_string = $team_id;
  }


  $add_team_to_league_sql = 
  "UPDATE Fan_Red_league
  SET league_users concat(league_users, '$team_user_string'),
  league_teams concat(league_teams, '$team_id_string')
  WHERE league_id = $league_id;";

  $db->query($add_team_to_league_sql);

  $error = $db->get_error();

  if (!empty($error)) {
    //We kinda have a problem here since they're already registered with the team...
    return result_set("false", $error);
  }
  return result_set("true", "Successfully added the team to the league!");
}

function get_league_info($league_id) {
  $db = new Database;
  $league_id = $db->sanitize($league_id);
  $league_info_sql =
    "SELECT *
    FROM Fan_Red_league
    WHERE league_id = $league_id;";
  $league_info = $db->query($league_info_sql);

  $error = $db->get_error();
  if (!empty($error)) {
    $db->end_connection();
    return result_set("false", $error);
  }

  $db->end_connection();
  return result_set("true", $league_info[0]);
}
