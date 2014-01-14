<?php

/* Since this function includes a relative path to the footer.php file
 * it can only be used in the fantasy_reddit directory! That's the only place
 * where the footer require will compile.
 *
 * One solution to this is to pass in the path to the footer but that seems
 * potentially insecure and definitely inelegant.  I'd rather find a solid
 * way of building absolute paths on this ridiculous server.
 */
function force_log_in() {
  if (empty($_SESSION['user_info'])) {
    $login_html =
      "<div class='panel panel-warning' id='please_login'>
         <div class='panel-heading'>
          <h3 class='panel-title'>Oh No!</h3>
         </div>
         <div class='panel-body'>
           <p>You have to register and login to a StephenAlanBuckley.com account to get involved in Fantasy Reddit!</p>
           <p>The buttons are right at the top of the page! You totally can do this!</p>
           <p>Then you can have fun with friends all over the internet and be like</p>
           <p>'Whoa what a great site to have an account on and so free!'</p>
           <p>And your friends will love you and that'll be just the best!</p>
         </div>
       </div>";
    echo $login_html;
    require_once "../footer.php";
    die();
  }
}

?>
