<?php

require_once 'utilities/tmhOAuthExamples/tmhOAuthExample.php';
require_once 'utilities/db_class.php';

$tmhOAuth = new tmhOAuthExample();

//TODO: write db function to make improv extension connection
//      get tweet data
function record_tweet ($length, $metrics) {
  $data = json_decode($data);
  $db = new Database;
  $db->make_improv_extension_connection();

  $tweet_insert =
    "INSERT INTO tweets(contents, twitter_created_at, account)
    VALUES ('$contents', '$created_at', '$handle');";

  $db->query($tweet_insert);
}

$code = $tmhOAuth->streaming_request(
  'POST',
  'https://stream.twitter.com/1.1/statuses/filter.json',
  array("follow"=>"289051336,2550724993"), //UCBClassesNYC and stephen_withav
  'record_tweet'
);

$tmhOAuth->render_response();
