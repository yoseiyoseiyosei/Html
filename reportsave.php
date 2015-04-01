<?php 
require "db_conect.php";
session_start();

//select文の関数を持ったphpファイル
require "selectsql.php";

/*
if (empty($_SESSION['user_id'])) {
    header("Location:index.html");
}
*/

/*

/*
セッションに格納されたuser_idを取得する
セッションに企画のidを取得してくる

do_check_tblにぶちこむ
user_id
plan_id
do_created

report_tblに打ち込む
do_id
do_check
user_id
report_order
do_text_x
do_pic_x
do_movie_x


action_tblにk打ち込む
action_text
plan_id
user_id

*/




//企画の情報を引き出す
$tbl_name="plan_tbl";
$tbl_id="plan_id";
$plan=tbl($tbl_name,$tbl_id,$_SESSION['report']['plan_id']);


//if (!empty($_SESSION['id'])) {
    var_dump($_SESSION['report']['plan_id']);
    var_dump($_SESSION['report']['do_check']);
    var_dump($_SESSION['report']['action_text']);
    var_dump($_SESSION['report']['do_text_0']);
    var_dump($_SESSION['report']['do_text_1']);
    var_dump($_SESSION['report']['do_pic_0']);
    var_dump($_SESSION['report']['do_pic_1']);
    var_dump($_SESSION['report']['do_movie_0']);
    var_dump($_SESSION['report']['do_movie_1']);


    //do_checkにぶちこう
    $docheck_sql=sprintf('INSERT INTO do_check_tbl SET plan_id=%d,user_id=%d,do_check=%d,do_created="%s"',
                mysql_real_escape_string($_SESSION['report']['plan_id']),
                mysql_real_escape_string($_SESSION['id']),
                mysql_real_escape_string($_SESSION['report']['do_check']),
                date('Y-m-d H:i:s')
        );
    mysql_query($docheck_sql) or die(mysql_error());

    //たった今入れたdoのidを取得する
    //最新のdoidを取得してくる
    $doid_sql=sprintf('SELECT * FROM do_check_tbl WHERE plan_id=%d AND user_id=%d ORDER BY do_id DESC',
                mysql_real_escape_string($_SESSION['report']['plan_id']),
                mysql_real_escape_string($_SESSION['id'])
        );
    $record=mysql_query($doid_sql) or die(mysql_error());
    $doid=mysql_fetch_assoc($record);

    //report_tblにぶち込む
    $pagecount=$_SESSION['count'];
    for ($i=0; $i < $pagecount; $i++) { 
        $do_text="do_text_".$i;
        $do_pic="do_pic_".$i;
        $do_movie="do_movie_".$i;
        echo $i;
        $report_sql=sprintf('INSERT INTO report_tbl SET do_text="%s", do_pic="%s", do_movie="%s", do_id=%d, report_order=%d',
            mysql_real_escape_string($_SESSION['report'][$do_text]),
            mysql_real_escape_string($_SESSION['report'][$do_pic]),
            mysql_real_escape_string($_SESSION['report'][$do_movie]),
            mysql_real_escape_string($doid['do_id']),
            mysql_real_escape_string($i+1)
            );
        mysql_query($report_sql) or die(mysql_error());
    }
    

    //action_tblにぶち込む    
    $action_sql=sprintf('INSERT INTO action_tbl SET action_text="%s", plan_id=%d,do_id=%d, user_id=%d ',
        mysql_real_escape_string($_SESSION['report']['action_text']),
        mysql_real_escape_string($_SESSION['report']['plan_id']),
        mysql_real_escape_string($doid['do_id']),
        mysql_real_escape_string($_SESSION['id'])
        );
    mysql_query($action_sql) or die(mysql_error());


    unset($_SESSION['report']);

//}else{
    //header("Location:index.html");
//}

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
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/pluton.css" />
        
        <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="css/animate.css" />

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
                        
                    </a>
                   
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">
                            <li class="active"><a href="index.html">Home</a></li>
                            <li><a href="plan.php">Plan</a></li>
                            <li><a href="do_check.php">DoCheck</a></li>
                            <li><a href="action.php">Action</a></li>
                            
                            <li><a href="mypage.php">Mypage</a></li>
                            <li><a href="search.php">Search</a></li>
                            <li><a href="logout.php">Logout</a></li>
                            
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>


<div class="section secondary-section " id="portfolio">
    <div class="container">
                        <div class="row-fluid">
                            <div class="span contact-form centered">
                                <h3>投稿完了です</h3>
                                <p><a href="mypage.php">Mypageへ</a></p>
                                <p><a href="index.php">Homeへ</a></p>
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








