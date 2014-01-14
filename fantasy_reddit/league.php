<?php
$css_paths = "/css/fan_red_common.css";

require_once "../utilities/db_class.php";

$league_id = $_GET['league_id'];

$league_found = false;

if (!empty($league_id)) {
  $db = new Database;

  $league_id = $db->sanitize($league_id);

  $find_the_league = 
    "SELECT *
    FROM Fan_Red_league
    WHERE league_id = $league_id;";

  $league_info = $db->query($find_the_league);
  $league_info = $league_info[0];

  if (!empty($league_info)){
    $page_title = $league_info['league_name'];
    $league_found = true;
  } else {
    $page_title = "League Not Found!";
  }
} else {
  $page_title = "No League";
}

require_once "../header.php";

if ($league_found) {
  echo basic_league_info_html($league_info);
} else {
  echo "haha!";
}

?>

<?php

function basic_league_info_html($league_info) {
  $league_id = $league_info['league_id'];
  $league_name = $league_info['league_name'];
  $league_organizer_id = $league_info['league_organizer_id'];
  $league_total_games = $league_info['league_total_games'];
  $league_games = $league_info['league_games'];
  $league_next_game_day = new DateTime($league_info['league_next_game_day']);
  $league_next_game_day = $league_next_game_day->format('D M jS');

  $league_started = false; //Assume this until we know otherwise
  
  $db = new Database;
  
  $league_organizer_sql = 
    "SELECT user_name
    FROM user
    WHERE user_id = '$league_organizer_id';";

  $league_organizer_info = $db->query($league_organizer_sql);
  $league_organizer_name = $league_organizer_info[0]['user_name'];
  print_r($league_info);

  if ($league_info['league_started'] !== '0000-00-00 00:00:00') {
    $league_progress = "Not Yet Started";
  } else {
    $league_started = true;
    $league_progress = $league_games . "/ " . $league_total_games;
  }

  $blinfo_html = "
  <div id='league_$league_id' class='panel'>
    <div class='row'>
      <p id='name_$league_id' class='fan_red_banner col-md-10 col-md-offset-1'>$league_name</p>
    </div>
    <div class='row'>
      <p class='fan_red_text col-md-4 col-md-offset-2'>Organized By:</p> <p id='organizer_$league_id' class='text-right fan_red_text col-md-4 col-md-ofsset-2'>$league_organizer_name</p>
    </div>
    <div class='row'>
     <p class='fan_red_text col-md-4 col-md-offset-2'>League Progress:</p> <p id='progress_$league_id' class='text-right fan_red_text col-md-4 col-md-ofsset-2'>$league_progress</p>
    </div>";

  if ($league_started) {
    $blinfo_html .=
    "<div class='row'>
     <p class='fan_red_text col-md-4 col-md-offset-2'>Next Game Day:</p> <p id='game_day_$league_id' class='text-right fan_red_text col-md-4 col-md-ofsset-2'>$league_next_game_day</p>
    </div>";
  }


  $blinfo_html .= "</div>"; //Close up the panel last
  return $blinfo_html;
}

require_once "../footer.php";
?>
