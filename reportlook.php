<?php
require "db_conect.php";
session_start();

//ログイン状態でないとログイン画面に突き返す
require "loginback.php";

//select文の関数を持ったphpファイル
require "selectsql.php";

//いいねボタンの関数
require "like.php";

//リクエストがあった場合いいねを増やす
if (!empty($_REQUEST['like'])) {
    likeadd($_REQUEST['like'],"plan_table","plan_id","plan_like");
}

//企画の情報を引き出す
$tbl_name="plan_tbl";
$tbl_id="plan_id";
$planInfo=tbl($tbl_name,$tbl_id,$_REQUEST['planid']);

//ページをめくれるようにする
$tbl_name="plan_tbl";
$page_num=6;
require "pagescroll.php";
//新着順
//$plan_sql=sprintf('SELECT up.user_name,up.user_pic,pt.* FROM plan_tbl pt,user_profile up WHERE pt.user_id=up.user_id ORDER BY pt.plan_created DESC LIMIT %d,6',$start_row);
//$plan_temp=mysql_query($plan_sql) or die(mysql_error());
$plan_sql=sprintf('SELECT up.user_name,up.user_pic,pt.* FROM plan_tbl pt,user_profile up WHERE pt.user_id=up.user_id ORDER BY pt.plan_created DESC LIMIT %d,6',$start_row);
$plan_temp=mysql_query($plan_sql) or die(mysql_error());


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
                .scroll{
                    overflow:scroll;
                    height: 400px;
                }
        </style>
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





         <!-- Price section start -->
         <!-- do_idを -->
        <div id="price" class="section secondary-section">
            <div class="container">
                <div class="title">
                    <h1>検証一覧</h1>
                    <p>企画に対しての検証を見て＆評価しよう！</p>
                </div>
<div class="price-table row">
                    <div class="span12 price-column">
                        <h3>企画:<?php echo $planInfo['plan_title'];//$plan_info['plan_title']; ?></h3>
                        <div class="scroll">
                        <?php 
                        $do_sql=sprintf('SELECT dct.do_check,dct.do_like,rt.do_text,rt.do_pic,rt.do_movie,dct.do_id FROM do_check_tbl dct,report_tbl rt WHERE dct.do_id=rt.do_id AND report_order=1 AND dct.plan_id=%d ORDER BY dct.do_id DESC',$_REQUEST['planid']);
                        $do_temp=mysql_query($do_sql) or die(mysql_error());
                        ?>
                        <ul id="report_list" style='list-style-type:none;'>
                        <?php while($doInfo=mysql_fetch_assoc($do_temp)): ?>
                        <li>
                            <div id="single-project">
                                <div id="slidingDiv" class="row-fluid single-project">
                                    
                                        <div class="span6"> 
                                        <?php if($doInfo['do_pic']=="noimage.jpg" && $doInfo['do_movie']=="nomovie"): ?>
                                            <img src="report_img/<?php echo $doInfo['do_pic']; ?>" alt="">
                                        <?php else: ?>
                                                <?php if($doInfo['do_pic']=="noimage.jpg"): ?>                      
                                                <iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $report['do_movie']; ?>" frameborder="0" allowfullscreen></iframe>
                                                <?php endif; ?>
                                                <?php if($doInfo['do_movie']=="nomovie"): ?>
                                                <img src="report_img/<?php echo $doInfo['do_pic']; ?>" alt="">
                                                <?php endif; ?>
                                        <?php endif; ?>
                                    </div>                         
                                
                                    <div class="span6">
                                        <div class="project-description">
                                            <div class="project-title clearfix">
                                                <h3>企画<?php echo $planInfo['plan_title']; echo $doInfo['do_id']; ?></h3>
                                                <p>自己評価:</p><p>いいね数:</p><p><a href="do_detail.php?doid=<?php echo htmlSC($doInfo['do_id']); ?> ">検証詳細</a></p>
                                            </div>
                                            <div class="project-info">
                                                <div>
                                                    <p><?php echo $doInfo['do_text']; ?></p>
                                                </div>
                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                    <?php endwhile; ?>
                    </ul>
                    
                    </div>
                            <a href=""><button id="subscribe" class="button button-sp" type="submit">書き込む</button></a>
                            
                        
                    </div>
            
</div>
            <?php if($page>1):?>
                        <li><a href="do_check.php?page=<?php print($page-1); ?>">前のページへ</a></li>
                    <?php else: ?>
                        <li>前のページ</li>
                    <?php endif; ?>

                    <?php if($page<$maxpage): ?>
                        <li><a href="do_check.php?page=<?php print($page+1); ?>">次のページへ</a></li>
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