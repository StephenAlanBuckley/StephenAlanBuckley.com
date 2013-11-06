<?php

global $css_paths, $js_paths, $page_title;

$styles_html = '';
if (!empty($css_paths)) {
	$include_css_paths = explode(',', $css_paths);
	if(isset($include_css_paths)){
		foreach($include_css_paths as $inclusion){
			$styles_html .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"$inclusion\" media=\"screen\">";
		}
	}
}

$js_html = '';
if (!empty($js_paths)) {
	$include_js_paths = explode(',', $js_paths);
	if(isset($include_js_paths)){
		foreach($include_js_paths as $inclusion){
			$js_html .= "<script src='". $inclusion . "'></script>";
		}
	}
}

?>

<head>
  <title><?=$page_title?></title>
  <!--Require in order of most to least general-->
  <!--Most General to Most Specific-->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<script src="js/jquery.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/sticky_footer.css">
	<?php echo $styles_html?>
	<?php echo $js_html?>
	<title>Stephen Alan Buckley</title>
	<!DOCTYPE html>
</head>
<body>
  <header class="page-header">
    <div class="container">
      <h1><a href="/">Stephen Alan Buckley</a></h1>
      <h2><?=crazy_subtitle()?></h2>
    </div>
  </header>
<div id="wrap" class="container">


<?php

//Fun Header Functions!
//Yeah. That's right. I put a moderately useless comment in this code. If you're wondering why, it's gonna boost future morale.
//Yeah!
//Times this has worked: 1

//This function makes a subtitle that goes in the header h2.
//I could definitely do a Markov Chain deal, or I can make a static list.
function crazy_subtitle() {
  $sayings = array(
    "this isn't pismo beach",
    "in the cyber-flesh",
    "if it ain't broke, i can fix that for you",
    "you may have seen me in movie",
    "lives directly underneath his hair",
    "professional toenail collector",
    "would you believe me if i said i was an interior decorator",
    "clearly this guy likes bootstrap",
    "got a nickel for every time someone said 'if i had a nickel for every time'",
    "bursting at the seams with tasteless rice",
    "invented chalk and encourages child graffitti",
    "master spellor",
    "\<a href=\"horriblevirus.com\"\>Awesome Hacker\</a\>",
    "first edition!",
    "doesn't understand how bears didn't become the dominant species",
    "afraid of horses",
    "and his ongoing hope to never again swim with beavers",
    "if you don't support my site i'll club this baby ceiling",
    "never met a pin he didn't luke",
    "you can google me at: google.com",
    "yes, it's real. yes, you can touch it.",
    "read your late night AIM conversations and judged you harshly",
    "fo real gurl fo real",
    "and the zoot-suit fandangos",
    "and the frothy milk",
    "pitying the fool since nineteen eighty-nine",
    "forgot to put a subtitle here",
    "big fan of small fans",
    "i'm from where you're from",
    "he really knows how to make little kids cry",
    "looks like someone with crumbly earwax",
    "like trying to shave a grenade covered in butter",
    "seriously a ninja cat in human form",
    "wants to do you on public access television",
    "golddiggers friendships",
    "nobel peace prize winner of chopping off eyes",
    "isn't mad he's just disappointed",
    "can't wait for adultish gambino",
    "makes plots with conspiracy theorists to fulfill a recursion fetish",
    "can hold a plate in each hand without constantly looking at the plates",
    "fights with both hands tied behind your back",
    "honorable to the point of shame",
    "doesn't tape before painting",
    "fills notebooks with drawings of other notebooks",
    "has two left feet if you're in the market for left feet",
    "isn't a sellout yet",
    "has been wrong twice- once he thought he was wrong but he wasn't",
    "could fill a bathtub with bad metaphors",
    "now in all uppercase",
    "please excuse the convenience",
    "gets monthly revelations about what that one lyric was",
    "has no problems making palindromes making problems no has Buckley Alan Stephen",
    "just wants to know whose dishes these are",
    "or as children call him, mister broccoli",
    "just knows he was meant to be a late-night watch-salesman",
    "gullible when it's helpful",
    "watched binary hercules go from zero to one",
    "played the bus in speed",
    "writes the dialogue for pixar shorts"
  );
  return $sayings[array_rand($sayings)];
}
