<?php
require "db_conect.php";
session_start();

require "loginback.php";

function userDisplay($userId){
    $sql=sprintf('SELECT * FROM user_profile WHERE user_id="%d"',$userId);
    $temp=mysql_query($sql) or die(mysql_error());
    $userInfo=mysql_fetch_assoc($temp);
    return $userInfo;
}

function htmlSC($value){
    return htmlspecialchars($value,ENT_QUOTES,'UTF-8');
}

if (!empty($_POST)) {
    $insert_sql=sprintf('INSERT INTO tweet_table SET user_id="%d", tweet_msg="%s", tweet_created=NOW()',mysql_real_escape_string($_SESSION['id']),mysql_real_escape_string($_POST['message']));


    $temp=mysql_query($insert_sql) or die(mysql_error());
    //header('Location:mian.php');
}

//表示するページ数を求める
if (!empty($_REQUEST['page'])) {
    $page=$_REQUEST['page'];
}else{
    $page=1;
}
$cnt_sql ='SELECT COUNT(*) AS cnt FROM tweet_table';
$cnt_tmp=mysql_query($cnt_sql);
$tweet=mysql_fetch_assoc($cnt_tmp);
$maxpage=ceil($tweet['cnt']/6);
$page=min($page,$maxpage);

//表示し始める行数を求める
$start_row=($page-1)*6;


$sql=sprintf('SELECT up.user_name,up.user_pic,t.* FROM tweet_table t,user_profile up WHERE t.user_id=up.user_id ORDER BY t.tweet_created DESC LIMIT %d,6',$start_row);
$tweet_temp=mysql_query($sql) or die(mysql_error());


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
    </head>
    
    <body>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a href="index.php" class="brand">
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
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="plan.php">Plan</a></li>
                            <li><a href="do.php">Do</a></li>
                            <li><a href="check.php">Check</a></li>
                            <li><a href="action.php">Action</a></li>
                            <li><a href="search.php">Search</a></li>
                            <li><a href="logout.php">Logout</a></li>
                            
                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>

 <!-- Price section start -->
        <div id="price" class="section secondary-section">
            <div class="container">
                <div class="title">
                    <h1>CHECK</h1>
                    <p>検証を評価しよう！</p>
                </div>
<div class="price-table row-fluid">
            <?php $i=0; ?>
            <?php while($tweetInfo=mysql_fetch_assoc($tweet_temp)): ?>
            <?php $i++; ?>
                    <div class="span4 price-column">
                        <h3>仮説:<?php echo $tweetInfo['tweet_msg']; ?></h3>
                        <ul class="list">
                            <li class="price">$19,99</li>
                            <li><strong>Free</strong> Setup</li>
                            <li><strong>24/7</strong> Support</li>
                            <li><strong>5 GB</strong> File Storage</li>
                        </ul>
                    <form class="inline-form" method="post" action="">
                            <button id="subscribe" class="button button-sp" type="submit">いいね</button>
                            
                        </form>
                    </div>
                    <?php if($i%3==0){echo "<HR>";} ?>
                
            <?php endwhile; ?>
</div>
            <?php if($page>1):?>
                        <li><a href="do.php?page=<?php print($page-1); ?>">前のページへ</a></li>
                    <?php else: ?>
                        <li>前のページ</li>
                    <?php endif; ?>

                    <?php if($page<$maxpage): ?>
                        <li><a href="do.php?page=<?php print($page+1); ?>">次のページへ</a></li>
                    <?php else: ?>
                          <li>次のページ</li>
                    <?php endif; ?>


            </div>
        </div>
        <!-- Price section end -->

        
<div class="section secondary-section " id="portfolio">
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
        <!-- Contact section edn -->

</div>
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
