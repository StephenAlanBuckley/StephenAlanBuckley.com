<?php

$css_paths = "/css/index.css";
require_once 'header.php';
?>

<div class="row">
  <img id="portrait" src="/images/head_icon.jpg" class="col-md-8 col-md-offset-4">
</div>
<div class="row triarchy">
  <a id="work" class="primary_link text-center col-md-2 col-md-offset-1" href="/work/">
    <p class="p_link_title">Work</p>
    <p class="p_link_description">Professional Shenanigans</p>
  </a>
  <a id="play" class="primary_link text-center col-md-2 col-md-offset-2" href="/play/">
    <p class="p_link_title">Play</p>
    <p class="p_link_description">Horse Around or See Silly Stuff</p>
  </a>
  <a id="think" class="primary_link text-center col-md-2 col-md-offset-2" href="/think/">
    <p class="p_link_title">Think</p>
    <p class="p_link_description">Flex That One Big Head Muscle</p>
  </a>
</div>

<?php
require_once 'footer.php';
?>

