<?php
require 'header.php';
?>
<script type="text/javascript" src="js/hp_markov.js"></script>
<div><h2>Harry Potter <a href="https://en.wikipedia.org/wiki/Markov_chain" target="_blank">Markov Chains</a> </h2></div>
<br>Parts Wizard People Dear Reader:<input class="txtNumber" type="text" id="wpdr_parts">
<br>Parts Harry Potter and the Methods of Rationality:<input class="txtNumber" type="text" id="hpmor_parts">
<br>Parts Harry Potter and the Sorceror's Stone:<input class="txtNumber" type="text" id="hpass_parts">
<br>Number of Words:<input class="txtNumber" type="text" id="word_count">

<br>
<button type="button" id="madness">Enter the Madness</button>
<div id="myDiv"></div>
<?php
require 'footer.php';
?>