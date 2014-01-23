<?php
$css_paths = "/css/play/common.css";
$js_paths ="/js/play/index.js";
require_once '../header.php';
?>

<div class="row">
  <div class="col-md-6 col-md-offset-6 text-center">
    <h1 class="play_font">Play</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-6">
    <h2 class="play_font">Playing games, having a laugh, and relaxing are important.
    Just like stretching after a workout, play can help your brain cool down after a lot of thinking or working.</h2>
  </div>
</div>
<div class="row">
  <div class="play_font nav nav-pills nav-stacked col-md-5 col-md-offset-7">
    <li><a href="../schedule.php">Comedy Schedule</a></li>
    <li><a href="hp_markov.php">Harry Potter Markov Chains</a></li>
  </div>
</div>

<?php
require_once '../footer.php';
?>
