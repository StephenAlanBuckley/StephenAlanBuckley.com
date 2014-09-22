<?php                                                                                                                                                                                                                                                                           
 
require_once '/utilities/tmhOAuthExamples/tmhOAuthExample.php';
$tmhOAuth = new tmhOAuthExample();
 
function record_tweet($data, $length, $metrics) {
  $data = json_decode($data);
  //make a db, put this on SAB.com, move secrets into a secrets file, and then test writing
  //some kinda relevant information to the db
  //
  //whoa, this is possible! and kinda fun!
  //
  //Also, look at render_response and ask for time in epoch not in text
}
 
$code = $tmhOAuth->streaming_request(
  'POST',
  'https://stream.twitter.com/1.1/statuses/filter.json',
  array("follow"=>"289051336,2550724993"), //UCBClassesNYC and stephen_withav
  'record_tweet'
);
 
$tmhOAuth->render_response();
