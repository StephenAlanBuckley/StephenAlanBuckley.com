<?php
$page_title = "Fantasy Reddit Team Creation";
$js_paths = "/js/fantasy_reddit/team_creation.js";
$css_paths = "/css/fan_red_common.css";

require_once "../header.php";
require_once "utilities/display_functions.php";
require_once "../utilities/common_display_functions.php";

force_log_in();

if (!empty($_SESSION['invited_to_league'])) {
  echo make_a_panel("You have to be invited to join a league before you make a team for one! Or you could strike out on your own and make your own league! Freaking do it!", "Little Bit awkward....", null, "warning");
  require_once "../footer.php";
  die();
}
?>

<div class="row">
  <p id="banner_league" class="col-md-10 col-md-offset-1 fan_red_banner">Name Your Team</p>
</div>
<div class="row">
  <input id="league_name_text" class="fan_red_input col-md-4 col-md-offset-4 fan_red_text" name="league_name" placeholder="Killer Trees" type="text">
</div>

<?php
echo reddit_users_html();
?>

<div class="row">
  <button type="button" class="btn fan_red_button col-md-5 col-md-offset-3"><div class="well-sm">Create My Team!</div></button>
</div>
<div id="team_creation_status" class="panel">
  <div class="panel-heading">
    <h3 id="status_header" class="panel-title"></h3> 
  </div>
  <div class="panel-body">
    <p id="status_body"></p>
  </div>
</div>

<?php

require_once "../footer.php";

function reddit_users_html() {
  $reddit_html =
  "<div class='row panel'>
     <p class='col-md-9 col-md-offset-1 fan_red_banner'>Choose Your Redditors</p>
     <button class='col-sm-2 btn secondary_fan_red_button fan_red_text'>
       <div id='help_button' class='well-sm'>Help!</div>
     </button>
   </div>
   <div id='explanation' class='row'>
     <p class='col-md-12 fan_red_text'>Go to <a href='http://www.reddit.com'>reddit</a> and find some users you think will be fitting for your team, put their username into a box, and press evaluate!
     </p>
     <p class='col-md-12 fan_red_text'>The evaluation you'll see should give you an approximation of their average daily points.</p>
     <p class='col-md-12 fan_red_text'>Your teams' total points cannot exceed 2000. So choose wisely!</p>
     <p class='col-md-12 fan_red_text'>Once you're ready, click the Create My Team! button. Obviously.</p>
   </div>
   <div class='row'>
     <p class='fan_red_text col-md-4 col-md-offset-1 text-center'>Redditor</p>
     <p class='fan_red_text col-md-3 col-md-offset-2 text-center'>Avg Karma/Day</p>
   </div>
    ";

  for ($i =0; $i < 11; $i++) {
    $reddit_html .= 
      "<div class='row input_redditor_row'>
         <input id='redditor_$i' class='enter_redditor_name fan_red_input col-md-4 col-md-offset-1 fan_red_text' name='user_$i' placeholder='way_fairer' type='text'>
         <button type='button' id='evaluate_$i' class='evaluate_redditor_button btn fan_red_button col-md-2 fan_red_text'><div class='well-sm'>Evaluate</div></button>
         <p id='redditor_status_$i' class='redditor_status col-md-3 fan_red_text text-center'></p>
       </div>";
  }

  $reddit_html .= 
    "<div class='row'>
       <p id='total_redditors' class='col-md-4 col-md-offset-1 fan_red_text text-center'>0/10</p>
       <button type='button' id='add_player' class='btn fan_red_button col-md-2'><div class='well-sm'>+++</div></button>
       <p id='total_karma' class='col-md-3 fan_red_text blue_text text-center'>0/2000</p>
     </div>";

  return $reddit_html;
}
?>
