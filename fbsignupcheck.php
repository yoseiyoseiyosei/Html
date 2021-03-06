<?php
require "db_conect.php";
session_start();

if (!empty($_POST)) {
    
        $sql=sprintf('INSERT INTO user_profile 
            SET user_fb_id=%d, user_name="%s", user_email="%s", user_password="%s", user_pic="%s" ,user_created="%s"',
            mysql_real_escape_string($_SESSION['user_fb_info']['id']),
            mysql_real_escape_string($_SESSION['kakunin']['name']),
            mysql_real_escape_string($_SESSION['kakunin']['email']),
            mysql_real_escape_string(sha1($_SESSION['kakunin']['password'])),
            mysql_real_escape_string($_SESSION['kakunin']['pic_name']),
            date('Y-m-d H:i:s')
            );

    
    mysql_query($sql) or die(mysql_error());

    unset($_SESSION['kakunin']);
    header('Location:fbthank.php');
}

function htmlSC($value){
  return htmlspecialchars($value,ENT_QUOTES,'UTF-8');
}
?>
<!DOCTYPE html>
<!--
 * A Design by GraphBerry
 * Author: GraphBerry
 * Author URL: http://graphberry.com
 * License: http://graphberry.com/pages/license
-->
<html lang="en">
    
    <head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pluton Theme by BraphBerry.com</title>
        <!-- Load Roboto font -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/pluton.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="css/animate.css" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57.png">
        <link rel="shortcut icon" href="images/ico/favicon.ico">
        <style>
        p{
            color: black;
        }
        </style>
    </head>
    
    <body>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a href="index.html" class="brand">
                        <img src="images/logo2.png" width="120" height="40" alt="Logo" />
                        <!-- This is website logo -->
                    </a>
                    <!-- Navigation button, visible on small resolution -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">
                            <li class="active"><a href="index.html">Home</a></li>
                            <li><a href="signup.php">SignUp</a></li>
                            <li><a href="login.php">Login</a></li>
                            
                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>

<div class="section secondary-section " id="portfolio">
    <div class="container">
                        <div class="row-fluid">
                            <div class="span contact-form centered">
                                <h3>登録画面</h3>

                                <form id="contact-form" action="" method="post" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <div class="controls">
                                            <p>名前</p>
                                            <p><?php echo htmlSC($_SESSION['kakunin']['name']); ?></p>
                                            
                                        </div>
                                    </div>
ß
                                    <div class="control-group">
                                        <div class="controls">
                                            <p>写真</p>
                                              <?php if($_SESSION['kakunin']['pic_name']!="noimage.jpg"): ?>
                                              <p><img src="profile_img/<?php echo htmlSC($_SESSION['kakunin']['pic_name']); ?>" alt=""></p>
                                              <?php else: ?>
                                              <p><img src="profile_img/noimage.jpg" alt=""></p>
                                              <?php endif; ?>

                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="controls">
                                             <input type="hidden" name="touroku" value="touroku">
                                            <button id="send-mail" class="message-btn">登録</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <p><a href="input_userinfo.php?action=rewrite">&laquo;&nbsp;書き直す</a></p>
                        </div>
        </div>
</div>


<div class="section primary-section">
                <div class="container">
                    <div class="span9 center contact-info">
                        <p class="info-mail">Murphys</p>
                    </div>
                    <div class="row-fluid centered">
                        <ul class="social">
                            <li>
                                <a href="">
                                    <span class="icon-facebook-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-twitter-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-linkedin-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-pinterest-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-dribbble-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-gplus-circled"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <!-- Contact section edn -->

        <!-- Footer section start -->
        <div class="footer">
            <p>&copy; 2013 All Rights Reserved</p>
        </div>
        <!-- Footer section end -->
        <!-- ScrollUp button start -->
        <div class="scrollup">
            <a href="#">
                <i class="icon-up-open"></i>
            </a>
        </div>
        <!-- ScrollUp button end -->
        <!-- Include javascript -->
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.mixitup.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="js/jquery.cslider.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="js/jquery.inview.js"></script>
        <!-- Load google maps api and call initializeMap function defined in app.js -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;callback=initializeMap"></script>
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>








