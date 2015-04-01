<?php 
require "db_conect.php";
session_start();

//ログイン状態でないとログイン画面に突き返す
require "loginback.php";

//select文の関数を持ったphpファイル
require "selectsql.php";


if (!empty($_REQUEST['planid'])) {
    $tbl_name="plan_tbl";
    $tbl_id="plan_id";
    $select_id=$_REQUEST['planid'];
    $_SESSION['planid']=$select_id;
    $planInfo=tbl($tbl_name,$tbl_id,$select_id);
}

if (!empty($_REQUEST['actionid'])) {
    $tbl_name="action_tbl";
    $tbl_id="action_id";
    $select_id=$_REQUEST['actionid'];
    $_SESSION['actionid']=$select_id;
    $actionInfo=tbl($tbl_name,$tbl_id,$select_id);
}

if (!empty($_REQUEST['reportid'])) {
    $tbl_name="report_tbl";
    $tbl_id="report_id";
    $select_id=$_REQUEST['reportid'];
    $_SESSION['reportid']=$select_id;
    $reportInfo=tbl($tbl_name,$tbl_id,$select_id);
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
        <link rel="stylesheet" type="text/css" href="css/button.css" />
        
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

<div class="section secondary-section " id="portfolio">
    <div class="container">
                        <div class="row-fluid">
                            <div class="span contact-form centered">
                                <?php if (!empty($_SESSION['planid'])): ?>
                                <h3>planの変更</h3>
                                <form action="updatethank.php" method="post">
                                    <textarea name="plan_title" cols="30" rows="10" ><?php echo $planInfo['plan_title']; ?></textarea>
                                    <input type="submit" >
                                </form>    
                                <?php endif ?>
                                
                                <?php if (!empty($_SESSION['actionid'])): ?>
                                    <h3>actionの変更</h3>
                                        <form action="updatethank.php" method="post">
                                            <textarea name="action_text" cols="30" rows="10" ><?php echo $actionInfo['action_text']; ?></textarea>
                                        <input type="submit" >
                                        </form>    
                                <?php endif ?>

                                <?php if (!empty($_SESSION['reportid'])): ?>
                                    <h3>検証の変更</h3>
                                        <form action="updatethank.php" method="post">
                                        
                                                <div id="single-project">
                                                    <div id="slidingDiv" class="row-fluid single-project">
                                                        <div class="span4">
                                                                    <div class="uploadButton">
                                                                        <p>写真を変更</p><br>
                                                                    <input type="file" onchange="uv.style.display='inline-block'; uv.value = this.value;" name="do_pic"/>
                                                                    <input type="text" id="uv" class="uploadValue" disabled />
                                                                    </div>
                                                                    
                                                                    <div class="uploadButton">
                                                                        <p>youtube動画のIDの変更</p><br>
                                                                    <input type="text" name="do_movie" />
                                                                    </div>
                                                        </div>
                                                        <div class="span8">
                                                            <div class="project-description">
                                                                <div class="project-title clearfix">
                                                                    <h3>DO:ページ<?php echo $reportInfo['report_order']; ?></h3>
                                                        
                                                                </div>
                                                                <div class="project-info">
                                                                    <div>
                                                                        <textarea name="do_text" class="report_text" ><?php echo $reportInfo['do_text']; ?></textarea>
                                                                    </div>
                                                        
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            <input type="submit" >
                                        </form>    
                                <?php endif ?>

                            </div>
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








