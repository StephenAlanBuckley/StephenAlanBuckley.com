<?php 
require_once '../../header.php';
require_once '../db_class.php';

 if(!empty($_POST)) 
 { 
   $username = null;
   $password = null;
   $email = null;

   if(empty($_POST['username'])) 
   { 
       // Note that die() is generally a terrible way of handling user errors 
       // like this.  It is much better to display the error with the form 
       // and allow the user to correct their mistake.  However, that is an 
       // exercise for you to implement yourself. 
       die("Please enter a username."); 
   } else {
     $username = mysql_real_escape_string($_POST['username']);
   }
    
   if(empty($_POST['password'])) 
   { 
       die("Please enter a password."); 
   } else {
     $password = $_POST['password'];
   }
    
   // Make sure the user entered a valid E-Mail address 
   // filter_var is a useful PHP function for validating form input, see: 
   // http://us.php.net/manual/en/function.filter-var.php 
   // http://us.php.net/manual/en/filter.filters.php 
   if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
   { 
     $email = null;
   } else {
     $email = mysql_real_escape_string($_POST['email']);
   }
    
   // We will use this SQL query to see whether the username entered by the 
   // user is already in use.  A SELECT query is used to retrieve data from the database. 
   // :username is a special token, we will substitute a real value in its place when 
   // we execute the query. 
   $unique_username_sql = " 
       SELECT 1 
       FROM user 
       WHERE username = $username 
   "; 
    

   $db = new Database;
   $db->make_sab_basics_database_connection();
   
   $row = $db->query($unique_username_sql); 

   if($row) 
   { 
       die("This username is already in use"); 
   } 

   // A salt is randomly generated here to protect again brute force attacks // and rainbow table attacks.  The following statement generates a hex 
   // representation of an 8 byte salt.  Representing this in hex provides 
   // no additional security, but makes it easier for humans to read. 
   // For more information: 
   // http://en.wikipedia.org/wiki/Salt_%28cryptography%29 
   // http://en.wikipedia.org/wiki/Brute-force_attack 
   // http://en.wikipedia.org/wiki/Rainbow_table 
   $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 

    
    
   // This hashes the password with the salt so that it can be stored securely 
   // in your database.  The output of this next statement is a 64 byte hex 
   // string representing the 32 byte sha256 hash of the password.  The original 
   // password cannot be recovered from the hash.  For more information: 
   // http://en.wikipedia.org/wiki/Cryptographic_hash_function 
   $password = hash('sha256', $_POST['password'] . $salt); 
    
   // Next we hash the hash value 65536 more times.  The purpose of this is to 
   // protect against brute force attacks.  Now an attacker must compute the hash 65537 
   // times for each guess they make against a password, whereas if the password 
   // were hashed only once the attacker would have been able to make 65537 different  
   // guesses in the same amount of time instead of only one. 
   for($round = 0; $round < 65536; $round++) 
   { 
       $password = hash('sha256', $password . $salt); 
   } 
    
   $insert_query = " 
       INSERT INTO user ( 
           user_name, 
           user_password, 
           user_salt, 
           user_email 
       ) VALUES ( 
           '$username', 
           '$password', 
           '$salt', 
           '$email'
       ) 
   "; 

   $db->query($insert_query);
    
   // This redirects the user back to the login page after they register 
   //header("Location: login.php"); 
    
   // Calling die or exit after performing a redirect using the header function 
   // is critical.  The rest of your PHP script will continue to execute and 
   // will be sent to the user if you do not die or exit. 
   ///die("Redirecting to login.php"); 
 } 
  
?> 
<h1>Register</h1> 
<form action="register.php" method="post"> 
    Username:<br /> 
    <input type="text" name="username" value="" /> 
    <br /><br /> 
    E-Mail:<br /> 
    <input type="text" name="email" value="" /> 
    <br /><br /> 
    Password:<br /> 
    <input type="password" name="password" value="" /> 
    <br /><br /> 
    <input type="submit" value="Register" /> 
</form>

<?php
require_once '../../footer.php';
?>
