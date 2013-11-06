<?php

$css_paths = "/css/index.css";
require_once 'header.php';
?>

<div class="container center">
  <ul id="left-panel" class="panel nav nav-pills nav-stacked">
    <li><a id="blog" class="primary_link" href="blog.php">Blog</a></li>
    <li><a id="games" class="primary_link" href="games.php">Games</a></li>
    <li><a id="links" class="primary_link" href="links.php">Links</a>
  </ul>
  <img id="portrait" src="/images/head_icon.jpg">
  <ul id="right-panel" class="panel nav nav-pills nav-stacked">
    <li><a id="videos" class="primary_link" href="videos.php">Videos</a></li>
    <li><a id="schedule" class="primary_link" href="schedule.php">Schedule</a></li>
    <li><a id="scripts" class="primary_link" href="scripts.php">Scripts</a></li>
  </ul>
</div>

<?php
require_once 'footer.php';

?>

