<?php
$js_paths = array('../js/game.js');

require_once '../header.php';
?>
<div id="game_frame">
  <!--So the JS can append the canvas here-->
</div>
<script src="../js/game_canvas.js"></script>
<script src="../js/top_down_base_classes.js"></script>
<script src="../js/movement_controls.js"></script>
<script src="../js/monster_class.js"></script>
<script src="../js/game.js"></script>
<?
require_once '../footer.php';
?>
