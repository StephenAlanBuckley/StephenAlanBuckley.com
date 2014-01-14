<?php

$page_title = "Fantasy Reddit League Creation";
$css_paths = "/css/fan_red_common.css";
$js_paths = "/js/fantasy_reddit/league_creation.js";

require_once "../header.php";
require_once "utilities/display_functions.php";

force_log_in();

?>
<div class="row">
  <p id="banner_league" class="col-md-11 fan_red_banner">Create a League</p>
</div>
<div class="row">
  <p class="col-md-6 fan_red_text">Give your league a name:</p>
  <input id="league_name_text" class="fan_red_input col-md-4 col-md-offset-1 fan_red_text" name="league_name" placeholder="The Goober Stompers" type="text">
</div>
<div class="row">
  <p class="col-md-6 fan_red_text">How often are games?</p>
  <input id="league_days_text" class="int_only fan_red_input col-md-4 col-md-offset-1 fan_red_text" name="league_days" placeholder="Every X Days" type="number">
</div>
<div class="row">
  <button id="create_the_league" type="button" class="btn fan_red_button col-md-5 col-md-offset-3"><div class="well-sm">Create My League</div></button>
</div>
<div id="league_creation_status" class="panel">
  <div class="panel-heading">
    <h3 id="status_header" class="panel-title fan_red_banner"></h3> 
  </div>
  <div class="panel-body">
    <p id="status_body" class="fan_red_text"></p>
  </div>
</div>
<?php

require_once "../footer.php";
?>
