<?php
require_once 'header.php';
require_once 'utilities/db_class.php';

$videos = get_videos();
echo make_all_videos_html($videos);
?>

<?

function get_videos() {
  $sab_db = new Database();
  $sab_db->make_sab_basics_database_connection();
  $video_sql =
    "SELECT * FROM video
    ORDER BY video_id DESC
    LIMIT 0, 1000;";
  
  $videos = $sab_db->query($video_sql);
  return $videos;
}

function make_youtube_html($code) {
  $youtube_string = 
    "<iframe width='640' height='480' src='//www.youtube.com/embed/$code' frameborder='0' allowfullscreen></iframe>";
  return $youtube_string;
}

function make_vimeo_html($code) {
  $vimeo_string =
    "<iframe src='//player.vimeo.com/video/$code' width='500' height='281' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
  return $vimeo_string;
}

function make_all_videos_html($videos) {
  $videos_html = "<div class='videos'>";
  foreach($videos as $video) {
    $id = $video['video_id'];
    $title = $video['video_title'];
    $code = $video['video_code'];
    $player = $video['video_player'];

    $v_html = 
      "<div class='video panel panel-primary' id='$id'>
        <div class='title panel-heading'>
          <h3 class='panel-title'>$title</h3>
        </div>
        <div class='panel-body'>";

    if($player == "youtube") {
      $v_html .= make_youtube_html($code);
    } elseif ($player == "vimeo") {
      $v_html .= make_vimeo_html($code);
    }

    $v_html .= "</div> 
              </div>"; //closing the body, then the panel

    $videos_html .= $v_html;
  }
  $vidoes_html .= "</div>";
  return $videos_html;
}
?>
