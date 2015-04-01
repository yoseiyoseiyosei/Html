<?php
require "db_conect.php";
session_start();

require "loginback.php";

//select文の関数を持ったphpファイル
require "selectsql.php";

//delete
require "deletesql.php";

//insert文
require "insertsql.php";

//actionのdelete
if (!empty($_REQUEST['actionid'])) {
    $tbl_name="action_tbl";
    $tbl_id="action_id";
    $delete_id=$_REQUEST['actionid'];
    delete($tbl_name,$tbl_id,$delete_id);
}

//改善案が書かれた時
if (!empty($_POST)) {
    $uerid=$_SESSION['id']; 
    $text=$_POST['action_text'];
    $planid=$_POST['plan_id'];
    $date=date('Y-m-d H:i:s');
    insertaction($uerid,$text,$planid,$date);
}


//企画の情報を引き出す
$tbl_name="plan_tbl";
$plan_temp=tblall($tbl_name);

//ページをめくれるようにする
$tbl_name="action_tbl";
$page_num=6;
require "pagescroll.php";

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
        <link rel="stylesheet" href="css/introjs.css" type="text/css">
        <script src="js/intro.js"></script>
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
        <div id="price" class="section secondary-section">
            <div class="container">
                <div class="row">
                    <div class="span4"></div>
                    <div class="span4"></div>
                    <div class="span4"><button id="subscribe" class="button button-my" onClick="introJs().start()">チュートリアルスタート</button></div>

                </div>
                <div class="title">
                    <h1>Action</h1>
                    <p>企画に対しての改善案を出そう！<p>
                </div>

            <?php $i=0; ?>
            <?php while($planInfo=mysql_fetch_assoc($plan_temp)): ?>
            <?php if ($i%3==0): ?>
                            <div class="price-table row-fluid" >
                        <?php endif ?>
            
            <?php //企画の情報を引き出す
                            $tbl_name="action_tbl";
                            $tbl_id="plan_id";
                            $action_temp=tbl_temp($tbl_name,$tbl_id,$planInfo['plan_id']);
                            $tbl_name="user_profile";
                            $tbl_id="user_id";
                            $userInfo=tbl($tbl_name,$tbl_id,$planInfo['user_id']);
                            

            ?>
                    <div class="span4 price-column" data-intro="１つの企画に対して改善案を見れます" data-step="1">
                        <div data-intro="企画" data-step="2"><h3>企画:<?php echo $planInfo['plan_title']; ?></h3></div>
                        
                        <ul class="list" data-intro="改善案" data-step="3">
                        <?php while($actionInfo=mysql_fetch_assoc($action_temp)):
                                $useractionInfo=tbl($tbl_name,$tbl_id,$actionInfo['user_id']);
                        ?>
                            <li><strong><?php echo $useractionInfo['user_name']; ?></strong><?php echo $actionInfo['action_text']; ?>
                            <?php if ($userInfo['user_id']==$_SESSION['id']): ?>
                                <br><button id="subscribe" class="button button-sp"><a href="updateall.php?actionid=<?php echo $actionInfo['action_id']; ?>">編集</a></button>　<button id="subscribe" class="button button-sp"><a href="action.php?actionid=<?php echo htmlSC($actionInfo['action_id']); ?>">消去</a></button>
                            <?php endif ?>
                            </li>
                        <?php endwhile; ?>
                        </ul>
                    <div data-intro="企画に対して改善案を書き込もう" data-step="4">
                    <form class="inline-form" method="post" action="">
                      <textarea name="action_text" placeholder="改善案を書き込もう！" id="nlmail"></textarea>
                      <input type="hidden" value="<?php echo $planInfo['plan_id']; ?>" name="plan_id">
                            <button id="subscribe" class="button button-sp" type="submit">書き込む</button>
                            
                            
                    </form>
                    </div>
                    </div>
                    <?php 
                        $i++;
                        if ( $i!=0 && $i%3==0): ?>
                            </div>
                        <?php endif ?>

                        <?php if(empty($planInfo) && $i%3!=0): ?>
                            <?php echo "</div>"; ?>
                        <?php endif; ?>
                
            <?php endwhile; ?>

            


            </div>

            <div class="row">
                    <div class="span4"></div>
                <div class="span4">  
                    <?php if($page>1):?>
                    <button id="subscribe" class="button button-sp"><a href="action.php?page=<?php print($page-1); ?>">前のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp"><a href="">前のページ</a></button>
                    <?php endif; ?>

                    <?php if($page<$maxpage): ?>
                        <button id="subscribe" class="button button-sp"><a href="action.php?page=<?php print($page+1); ?>">次のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp"><a href="">次のページ</a></button>
                    <?php endif; ?>
                </div>
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
