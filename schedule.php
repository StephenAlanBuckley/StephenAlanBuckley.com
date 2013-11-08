<?php
require_once 'header.php';
require_once '/utilities/db_class.php';

$all_shows = get_shows_from_db();
echo make_all_shows_html($all_shows);
?>

<?php

function get_shows_from_db() {
  $sab_basic_db = new Database();
  $sab_basic_db->make_sab_basics_database_connection();
  $sql = 
    "SELECT * FROM 'show'
    WHERE show_time >= now()
    ORDER BY show_time ASC;";
  $all_shows = $sab_basic_db->query($sql);
  return $all_shows;
}

/*
 * Makes the appropriate div containing an unordered list of information about the passed show
 *
 * @param array $show_array the array containing info from the MySQL DB about shows.
 * 
 * @return a div with class "show_listing" containing an ul with li's corresponding to the MySQL DB
 */
function make_show_html($show_array) {
  $show_title = $show_array['show_title'];
  $show_time = $show_array['show_time'];
  $show_desc = $show_array['show_desc'];
  $show_location = $show_array['show_location'];
  $show_price = $show_array['show_price'];
  $show_link = !empty($show_array['show_link']) ? $show_array['show_link'] : '';

  if (!empty($show_link)) {
    $show_title = "<a href='$show_link'>$show_title</a>";
  }
  $html = "<div class=\"show_listing\">
             <ul>
              <li class=\"show_title\">$show_title</li>
              <li class=\"show_time\">$show_time</li>
              <li class=\"show_desc\">$show_desc</li>
              <li class=\"show_location\">$show_location</li>
              <li class=\"show_price\">$show_price</li>
             </ul>
           </div>";
  return $html;
}

function make_all_shows_html($all_shows) {
  $html = "<div class='all_shows'>";
  if (!empty($all_shows)) {
    foreach($all_shows as $show) {
      $html .= make_show_html($show);
    }
  }
  $html .= "</div>";
  return $html;
}
