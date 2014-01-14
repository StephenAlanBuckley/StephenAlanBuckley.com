<?php

require_once "../../utilities/ajax_functions.php";

define("RedditDNE", "Redditor Does Not Exist");

if (!empty($_GET['function'])) {
  session_start();
  $function = $_GET['function'];

  switch($function) {
    case 'check_redditor_exists':
      $results = check_that_redditor_exists($_GET['redditor'], true);

      print_r(json_encode($results));
      break;

    case 'get_redditor_info':
      $results = get_redditor_info($_GET['redditor'], true);

      print_r(json_encode($results));
      break;

    case 'evaluate_redditor':
      $results = evaluate_redditor($_GET['redditor'], true);

      print_r(json_encode($results));
      break;
  }
}

function check_that_redditor_exists($reddit_name, $ajax = false) {
  $url = "http://www.reddit.com/api/username_available.json?user=$reddit_name";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL,$url);
  $result = curl_exec($ch);

  //If the username is available, then the redditor doesn't exist.
  //If it isn't available, it does exist!
  if ($result === "true") {
    $result = false;
  } else {
    $result = true;
  }
  if ($ajax) {
    return result_set($result, "The Result is whether or not it exists!");
  } else {
    return $result;
  }
}

function get_redditor_info($reddit_name, $ajax = false) {
  if (!check_that_redditor_exists($reddit_name)) {
    if ($ajax) {
      return result_set("false", RedditDNE);
    } else {
      return RedditDNE;
    }
  }
  $url = "http://www.reddit.com/user/$reddit_name/about.json?jsonp=";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL,$url);
  $result = curl_exec($ch);

  $result = json_decode($result, true);
  $result = $result['data']; //The reddit json comes with a type code and data- we don't care ahout the type code, obviously (it's t2 for users since you obviously do care if you've read this far my god!)
  
  if ($ajax) {
    return result_set("true", $result);
  } else {
    return $result;
  }
}

function evaluate_redditor($reddit_name, $ajax = false) {
  $redditor = get_redditor_info($reddit_name);

  if ($redditor === RedditDNE) {
    if ($ajax) {
      return result_set("false", RedditDNE);
    } else {
      return RedditDNE;
    }
  }
  
  $created = $redditor['created_utc'];
  $now = time(); 
  $seconds_per_day = 86400.00; //60 * 60 * 24 - no need to do multiplication every time!
  
  $days_alive = ($now - $created)/($seconds_per_day);
  
  $total_score = ($redditor['link_karma']) + $redditor['comment_karma'];

  $evaluation = $total_score/$days_alive;

  if ($ajax) {
    return result_set("true", $evaluation);
  } else {
    return $evaluation; 
  }
}
