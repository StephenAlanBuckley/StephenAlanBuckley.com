<?php
require_once 'header.php';
session_set_cookie_params(0, '/', '.stephenalanbuckley.com'); 

if (!is_writable(session_save_path())) {
    echo 'Session path "'.session_save_path().'" is not writable for PHP!'; 
} else {
    echo 'Session path "'.session_save_path().'" is totally freaking writable for PHP!'; 
}

print_r($_SESSION);

require_once 'footer.php'
?>
