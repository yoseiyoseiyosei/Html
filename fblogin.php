<?php
require "db_conect.php";
session_start();

require '../src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '334993866548043',
  'secret' => '9a185006487e4f063059f26f2aa32859',
));

// Get User ID
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me/');
    
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}


?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <?php 
    $sql=sprintf('SELECT * FROM user_profile where user_fb_id="%d"',$user_profile['id']); 
    $record=mysql_query($sql) or die(mysql_error());
    $user_info=mysql_fetch_assoc($record);
    ?>

    <?php if (empty($user_info['user_fb_id'])){
            $_SESSION['user_fb_info']=$user_profile;
           
            header("Location:../keijiban/PDCA/Html/fbsignup.php");
          }else{
            $_SESSION['user_fb_info']=$user_info;
            header("Location:../keijiban/PDCA/Html/index.php");
          }
  ?>

  </body>
</html>