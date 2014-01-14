<?php
$page_title = "Welcome to Fantasy Reddit!";
$css_paths = "/css/fan_red_index.css,/css/fan_red_common.css";
require_once "../header.php";

//So! This Page should:
//-introduce the concept
//-remind you to log in if you're not logged in
//-allow you to create a league of up to 10 friends! (at least 2 players).

?>

<div id="introduction" class="row">
  <p id="welcome_fan_red" class="col-md-11 col-md-offset-1 fan_red_banner">Welcome to Fantasy Reddit!</p>
  <p id="what_is_fan_red" class="fan_red_text col-md-8">Fantasy Reddit is like Fantasy Football or Fantasy Baseball,
      but instead of choosing players from the NFL or MLB, you choose users from <a href="http://www.reddit.com" target="_blank">reddit.com</a>!</p>
  <img class="col-md-3 img-rounded" src="../images/snoo.jpg">
  <p id="first_fan_red" class="fan_red_text">First you make a league and invite up to 9 of your friends via email!</p>
  <p id="second_fan_red" class="fan_red_text">Second you all go and find users you want on your team- up to 10 each!</p>
  <p id="third_fan_red" class="fan_red_text">Third you get paired up for 'game days.'</p>
  <p id="game_day_fan_red" class="fan_red_text">On game days, two teams will play eachother.  Every time a user on a team 
    gets an upvote, they contribute to their team's total. At the end of the day, the team with the most points wins!</p>
  <p id="winner_fan_red" class="fan_red_text">Whoever wins the most games when everyone has played each other wins the league!</p>
  <p id="get_started_fan_red" class="fan_red_text">To get started, make your own league, invite some friends, and start scoutin'!</p>
  </div>

</div>
<?php
require_once "../footer.php";
?>
