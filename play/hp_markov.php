<?php
$css_paths = "/css/play/common.css,/css/play/hp_markov.css";
$js_paths = "/js/hp_markov.js";
require '../header.php';
?>
<div id="play_dimmer">
  <div class="row play_font">
    <div class="col-md-9 text-center">
      <h1> Harry Potter <a href="https://en.wikipedia.org/wiki/Markov_chain" target="_blank">Markov Chains</a> </h1>
    </div>
  </div>

  <div class="row play_detail_font">
    <div class="col-md-9 col-md-offset-1">
      <p>Harry Potter! A magical world full of centaurs and wizards and all of the other things that JK Rowling put into that series.
      Everyone seems to enjoy Harry Potter, except the ending. Wouldn't it be nice if Harry Potter went on a little longer? But in a
      largely nonsensical fashion?</p>
      <p>Of course it would! And now you can keep generating new, total nonsense stories which use the characters and words you loved
      in the book series.</p>
      <p>Also included, the first few chapters of "Harry Potter and the Methods of Rationality" and the entire transcript of 
      "Wizard People, Dear Reader." This way you can mix up your favorite HP stylings into a potion of strange wordplay.</p>
      <p>So, to get started type some numbers into those "Parts" Boxes. The higher the number, the more likely you are to get
      words from that story. If you don't include a number, that story will be omitted.</p>
      <p>Then enter how many words you want generated and Enter the Madness!</p>
    </div>
  </div>

  <div class="row play_font">
    <div class="col-md-9">
      <p>Parts Wizard People Dear Reader:</p>
    </div>
    <div class="form-group col-md-2">
      <input class="form-control txtNumber" type="text" id="wpdr_parts">
    </div>
  </div>


  <div class="row play_font">
    <div class="col-md-9">
      <p>Parts Harry Potter and the Methods of Rationality:</p>
    </div>
    <div class="form-group col-md-2">
      <input class="form-control txtNumber" type="text" id="hpmor_parts">
    </div>
  </div>

  <div class="row play_font">
    <div class="col-md-9">
      <p>Parts Harry Potter and the Sorceror's Stone:</p>
    </div>
    <div class="form-group col-md-2">
      <input class="form-control txtNumber" type="text" id="hpass_parts">
    </div>
  </div>
  <div class="row play_font">
    <div class="col-md-9">
      <p>Number of Words:</p>
    </div>
    <div class="form-group col-md-2">
      <input class="form-control txtNumber" type="text" id="word_count">
    </div>
  </div>

  <div class="row play_font">
    <div class="col-md-10 col-md-offset-2">
      <button type="button" id="madness">Enter the Madness</button>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
    <p id="markov_text"></p>
    </div>
  </div>
</div>
<?php
require '../footer.php';
?>
