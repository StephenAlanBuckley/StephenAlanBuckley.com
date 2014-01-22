<?php
$js_paths ="/js/play/index.js,/css/play/index.css";
require_once '../header.php';
?>

<div class="wheel">
  <a href="../schedule.php">Comedy Schedule</a>
  <a href="hp_markov.php">Harry Potter Markov Chains</a>
</div>

<div class="row">
  <canvas id="ferris_canvas"></canvas>
</div>

<?php

require_once '../footer.php';
?>
