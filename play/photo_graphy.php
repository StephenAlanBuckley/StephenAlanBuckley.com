<?php
$js_paths = "/js/highcharts/highcharts.js";
require_once '../header.php';
require_once '../utilities/db_class.php';

$get_pic_data_sql =
  "SELECT amount, date
  FROM stranger_pics";
$db = new Database();

$results = $db->query($get_pics_data_sql);


?>

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h1>Photo-Graphy</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h2>A vain page about how often people ask to take pictures with me!</h2>
  </div>
</div>
<div id="highcharts_container">
</div>

<?php

require_once "../footer.php";
?>
