<?php 
$db = "b31_c577";
mysql_connect("localhost","$db","$db") or die(mysql_error());
mysql_select_db('b31_c577');
mysql_query('SET NAMES UTF8');
session_start();

if (!empty($_GET['search_word'])) {
    $sql="SELECT * FROM user_profile WHERE user_name LIKE '%{$_GET['search_word']}%'";
    $temp=mysql_query($sql) or die(mysql_error());  
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
                            <li><a href="do_check.php">DoCheck</a></li>
                            <li><a href="action.php">Action</a></li>
                            <li><a href="mypage.php">Mypage</a></li>
                            <li><a href="search.php">Search</a></li>
                            <li><a href="logout.php">Logout</a></li>
                            
                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>


        <!-- Newsletter section start -->
        <div class="section secondary-section " id="portfolio">
            <div class="container">
                <div class="sub-section">
                    <div class="title clearfix">
                        <div class="pull-left">
                            <h3>友達を探す</h3>
                        </div>
                    </div>
                </div>
                
                <div class="row-fluid">
                    <div class="span5">
                        <p>早速探してみよう</p>
                    </div>
                    <div class="span7">
                        <form method="get" class="inline-form" action="">
                        <input type="text" name="search_word" placeholder="友達の名前を入力" id="nlmail" />
                        <input type="submit" value=" " id="subscribe" class="button button-sp"　/>
                       <button id="subscribe" class="button button-sp" type="submit">探す</button>                         
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter section end -->
        <!-- Client section start -->
        <div id="clients">
            <div class="section primary-section">
                <div class="triangle"></div>
                <div class="container">
                    <div class="title">
                        <h1>友達は発見できたかな？</h1>
                    </div>

                    <div class="row">
                        <?php if(!empty($_GET['search_word'])): ?>
                        <?php while($friend=mysql_fetch_assoc($temp)): ?>
                        <div class="span4">
                            <div class="testimonial">
                                <div class="whopic">
                                    <div class="arrow"></div>
                                    <img src="profile_img/<?php echo htmlSC($friend['user_pic']); ?>" class="centered" alt="client 1">
                                    <strong><?php echo $friend['user_name']; ?>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        <?php if(empty($temp)): ?>
                            <p>そんな友達いません</p>
                        <?php endif; ?>

                    <?php else: ?>
                    <p>入力してください</p>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>
        
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

