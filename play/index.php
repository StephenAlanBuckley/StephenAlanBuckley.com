<?php

$css_paths = "/css/play/common.css,/css/play/index.css";
$js_paths ="/js/play/index.js";
require_once '../header.php';
?>

<script type="text/javascript" src="http://jqueryrotate.googlecode.com/svn/trunk/jQueryRotate.js"></script> <!--Should make this local!--!>

<div class="row">
  <div class="col-md-6 col-md-3-offset">
    <div class="seesaw_wrapper"> 
        <div class="bar">
            <h1  class="play_font" id="play_page_title">Play</h1>
            <div class="box" id="left_box"></div>
            <div class="box" id="right_box"></div>
        </div>
    </div>      
  </div>
</div>
<div class="row">
  <div class="col-md-6"> 
    <h2 class="play_font">Playing games, having a laugh, and relaxing are important.
    Just like stretching after a workout, play can help your brain cool down after a lot of thinking or working.</h2>
  </div>
</div>
<div class="row">
  <div class="play_font nav nav-pills nav-stacked col-md-5 col-md-offset-7">
    <li><a href="../schedule.php">Comedy Schedule</a></li>
    <li><a href="https://twitter.com/HaptyFriday">Follow My Silly Tweets</a></li>
    <li><a href="http://instagram.com/HaptyFriday">Pictures of Me With Strangers</a></li>
    <li><a href="http://www.customink.com/accounts/8727628-1e38f">T-Shirt Designs!</a></li>
    <li><a href="hp_markov.php">Harry Potter Markov Chains</a></li>
  </div>
</div>

<?php
require_once '../footer.php';
?>
