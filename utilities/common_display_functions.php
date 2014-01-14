<?php

function make_a_panel($body, $header=null, $footer=null, $panel_type="primary") {
  $body = htmlentities($body);
  $header = htmlentities($header);
  $footer = htmlentities($footer);
  $panel_type = htmlentities($panel_type);

  $panel_html = "<div class='panel panel-$panel_type'>";

  if ($header !== null) {
    $panel_html .= "<div class='panel-heading'>
      <h3 class='panel-title'>$header</h3>
      </div>";
  }
  
  $panel_html.= "<div class='panel-body'>$body</div>";

  if ($footer !==null) {
    $panel_html .= "<div class='panel-footer'>$footer</div>";
  }

  $panel_html .= "</div>";
  return $panel_html;
}
?>
