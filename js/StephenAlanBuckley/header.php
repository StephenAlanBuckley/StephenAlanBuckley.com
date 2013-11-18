<?php

$styles_html = '';
$include_css_paths = explode(',', $css_paths);
if(isset($include_css_paths)){
	foreach($include_css_paths as $inclusion){
		$styles_html .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"$inclusion\" media=\"screen\">";
	}
}

$js_html = '';
$include_js_paths = explode(',', $js_paths);
if(isset($include_js_paths)){
	foreach($include_js_paths as $inclusion){
		$js_html .= "<script src='$inclusion'></script>"
	}
}

?>

<head>
 <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
	<?php echo $styles_html?>
	<?php echo $js_html?>
	<title>Stephen Alan Buckley</title>
	<script src="js/jquery.js"></script>
	<!DOCTYPE html>
</head>
<body>