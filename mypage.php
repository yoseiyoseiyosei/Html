<?php
require "db_conect.php";
session_start();

//ログイン状態でないとログイン画面に突き返す
require "loginback.php";

//select文の関数を持ったphpファイル
require "selectsql.php";

//いいねボタンの関数
require "like.php";

//delete
require "deletesql.php";

//planのdelete
if (!empty($_REQUEST['planid'])) {
    $tbl_name="plan_tbl";
    $tbl_id="plan_id";
    $delete_id=$_REQUEST['planid'];
    
    delete($tbl_name,$tbl_id,$delete_id);
}

//doのdelete
if (!empty($_REQUEST['doid'])) {
    $tbl_name="do_check_tbl";
    $tbl_id="do_id";
    $delete_id=$_REQUEST['doid'];
    
    delete($tbl_name,$tbl_id,$delete_id);
    $tbl_name="report_tbl";
    $tbl_id="do_id";
    $delete_id=$_REQUEST['doid'];
    
    delete($tbl_name,$tbl_id,$delete_id);
}

//actionのdelete
if (!empty($_REQUEST['actionid'])) {
    $tbl_name="action_tbl";
    $tbl_id="action_id";
    $delete_id=$_REQUEST['actionid'];
    
    delete($tbl_name,$tbl_id,$delete_id);
}


//リクエストがあった場合いいねを増やす
if (!empty($_REQUEST['like'])) {
    likeadd($_REQUEST['like'],"plan_tbl","plan_id","plan_like");
}



//ページをめくれるようにする
$tbl_name="plan_tbl";
$page_num=6;
require "pagescroll.php";
//新着順
//$sql=sprintf('SELECT up.user_name,up.user_pic,pt.* FROM plan_tbl pt,user_profile up WHERE pt.user_id=up.user_id ORDER BY pt.plan_created DESC LIMIT %d,6',$start_row);
//$plan_temp=mysql_query($sql) or die(mysql_error());

//ユーザー情報
$tbl_name="user_profile";
$tbl_id="user_id";
$user=tbl($tbl_name,$tbl_id,$_SESSION['id']);

//do_idからplanidとuseridを引き出してくる
$tbl_name="do_check_tbl";
$tbl_id="user_id";
$docheck=tbl($tbl_name,$tbl_id,$_SESSION['id']);

//plan情報
$tbl_name="plan_tbl";
$tbl_id="user_id";
$plan_temp=tbl_temp($tbl_name,$tbl_id,$_SESSION['id']);

//レポート情報
$tbl_name="report_tbl";
$tbl_id="do_id";
$report_temp=tbl_temp($tbl_name,$tbl_id,$docheck['do_id']);

//改善情報
$tbl_name="action_tbl";
$tbl_id="user_id";
$action_temp=tbl_temp($tbl_name,$tbl_id,$_SESSION['id']);

//やってみたい情報を引き出す
$tbl_name="try_tbl";
$tbl_id="user_id";
$try_temp=tbl_temp($tbl_name,$tbl_id,$_SESSION['id']);



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
        <link rel="stylesheet" type="text/css" href="css/myselfstyle.css" />
        <link rel="stylesheet" type="text/css" href="css/button.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="css/animate.css" />
        <link rel="stylesheet" href="css/introjs.css" type="text/css">
        <script src="js/intro.js"></script>
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

         <!-- About us section start -->
        <div class="section primary-section" id="about">
            
            <div class="container">
                <div class="title">
                    <h1>MYPAGE</h1>
                    <p>自分のレベルや今まで投稿したものを確認できます。</p>
                </div>
                <div class="about-text centered">
                    <h1>MY LEVEL</h1>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <ul class="skills">
                            <li>
                                <span class="bar" data-width="80%"></span>
                                <h3>企画レベル</h3>
                            </li>
                            <li>
                                <span class="bar" data-width="95%"></span>
                                <h3>検証レベル</h3>
                            </li>
                            <li>
                                <span class="bar" data-width="68%"></span>
                                <h3>評論レベル</h3>
                            </li>
                            <li>
                                <span class="bar" data-width="70%"></span>
                                <h3>改善レベル</h3>
                            </li>
                        </ul>
                    </div>
                    <div class="span6">
                        <div class="highlighted-box center">
                            <h1>PROFILE</h1>
                            <img src="" alt="">
                            <p>NAME:</p>
                            <p>企画数:検証数:</p>
                            <p>自己評価平均:改善数:</p>
                            
                            <button class="button button-sp"><a href="">プロフィール編集</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About us section end -->


        <!-- Newsletter section start -->
        <div class="section secondary-section " id="portfolio">
            <div class="triangle"></div>
            <div class="container">
                <div class="sub-section">
                    <div class="title clearfix">
                        <div class="container">
                            <div class="row">
                        <div class="span4"></div>
                        <div class="span4"></div>
                        <div class="span4"><button id="subscribe" class="button button-my" onClick="introJs().start()">チュートリアルスタート</button></div>

                    </div>
                    <div class="title">
                        <h1>やってみたい企画！</h1>
                    </div>
                    <div class="row">
                    <?php while($tryInfo=mysql_fetch_assoc($try_temp)):
                        //plan情報
                        $tbl_name="plan_tbl";
                        $tbl_id="plan_id";
                        $planInfo=tbl($tbl_name,$tbl_id,$tryInfo['plan_id']);
                        $tbl_name="user_profile";
                        $tbl_id="user_id";
                        $userInfo=tbl($tbl_name,$tbl_id,$planInfo['user_id']);

                     ?>
                        <div class="span4">
                            <div class="mytestimonial">
                                <p><?php echo $planInfo['plan_title']; ?></p>
                                <div class="myarrow"></div>
                                <div class="mywhopic">
                                    <div class="profilebox">
                                    <img src="profile_img/<?php echo htmlSC($userInfo['user_pic']); ?>" class="centered" alt="client 1"><br>
                                    name:<br> 
                                    <?php echo $userInfo['user_name']; ?>
                                    </div>
                                    <div class="loadButton"><a href="plan.php?like=<?php echo htmlSC($planInfo['plan_id']); ?>">いいね:<?php echo $planInfo['plan_like']; ?></a></div>
                                    <div class="loadButton"><a href="reportlook.php?planid=<?php echo htmlSC($planInfo['plan_id']); ?>">検証をみる　&gt;</a></div>
                                    <div class="loadButton" data-intro="ここから検証記事を書こう！" data-step="1"><a href="report.php?plan_id=<?php echo htmlSC($planInfo['plan_id']); ?>">やってみる！</a></div>

                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    
                    </div>
                    
                </div>
                    
                </div>
                    </div>
                    <div class="row">
                    <div class="span4"></div>
                <div class="span4">  
                    <?php if($page>1):?>
                    <button id="subscribe" class="button button-sp"><a href="mypage.php?page=<?php print($page-1); ?>">前のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp">前のページ</button>
                    <?php endif; ?>

                    <?php if($page<$maxpage): ?>
                        <button id="subscribe" class="button button-sp"><a href="mypage.php?page=<?php print($page+1); ?>">次のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp">次のページ</button>
                    <?php endif; ?>
                </div>
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
                        <h1>My企画！</h1>
                    </div>

                    <div class="row">

                    <?php while($planInfo=mysql_fetch_assoc($plan_temp)):
                        $tbl_name="user_profile";
                        $tbl_id="user_id";
                        $userInfo=tbl($tbl_name,$tbl_id,$planInfo['user_id']);
                    ?>
                        <div class="span4">
                            <div class="testimonial">
                                <p><?php echo $planInfo['plan_title']; ?></p>
                                <div class="arrow"></div>
                                <div class="whopic">
                                    <div class="profilebox">
                                    <img src="profile_img/<?php echo htmlSC($userInfo['user_pic']); ?>" class="centered" alt="client 1"><br>
                                    name:<br> 
                                    <?php echo $userInfo['user_name']; ?>
                                    </div>
                                    <div class="loadButton"><a href="plan.php?like=<?php echo htmlSC($planInfo['plan_id']); ?>">いいね:<?php echo $planInfo['plan_like']; ?></a></div>
                                    <div class="loadButton"><a href="reportlook.php?planid=<?php echo htmlSC($planInfo['plan_id']); ?>">検証をみる　&gt;</a></div>
                                    <div class="loadButton"><a href="report.php?plan_id=<?php echo htmlSC($tryInfo['plan_id']); ?>">やってみる！</a></div>
                                    <?php if ($userInfo['user_id']==$_SESSION['id']): ?>
                                    <br><button id="subscribe" class="button button-sp"><a href="">編集</a></button>　<button id="subscribe" class="button button-sp"><a href="mypage.php?planid=<?php echo htmlSC($planInfo['plan_id']); ?>">消去</a></button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    
                    </div>

                    <div class="row">
                    <div class="span4"></div>
                <div class="span4">  
                    <?php if($page>1):?>
                    <button id="subscribe" class="button button-sp"><a href="mypage.php?page=<?php print($page-1); ?>">前のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp">前のページ</button>
                    <?php endif; ?>

                    <?php if($page<$maxpage): ?>
                        <button id="subscribe" class="button button-sp"><a href="mypage.php?page=<?php print($page+1); ?>">次のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp">次のページ</button>
                    <?php endif; ?>
                </div>
                </div>
                    
                </div>
            </div>
        </div>


 <!-- Price section start -->
<div id="price" class="section secondary-section">
            <div class="container">
                <div class="title">
                    <h1>My検証記事</h1>
                    <p>自分が投稿した記事の一覧</p>
                </div>
                    <?php
                    //plan情報
                        $tbl_name="plan_tbl";
                        $tbl_id="user_id";
                        $plan_temp=tbl_temp($tbl_name,$tbl_id,$_SESSION['id']);
                        while($planInfo=mysql_fetch_assoc($plan_temp)):
                        $do_sql=sprintf('SELECT dct.do_check,dct.do_like,rt.do_text,rt.do_pic,rt.do_movie,dct.do_id FROM do_check_tbl dct,report_tbl rt WHERE dct.do_id=rt.do_id AND report_order=1 AND dct.plan_id=%d ORDER BY dct.do_id DESC',$planInfo['plan_id']);
                        $do_temp=mysql_query($do_sql) or die(mysql_error());
                        ?>
                        <ul id="report_list" style='list-style-type:none;'>
                        <?php while($doInfo=mysql_fetch_assoc($do_temp)): ?>
                        <li>
                            <div id="single-project">
                                <div id="slidingDiv" class="row-fluid single-project">
                                    
                                        <div class="span4"> 
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
                                
                                    <div class="span8">
                                        <div class="project-description">
                                            <div class="project-title clearfix">
                                                <h3>企画:<?php echo $planInfo['plan_title']; ?></h3>
                                            </div>
                                            <div class="project-info">
                                                    <p><?php echo $doInfo['do_text']; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>

                        </li>
                        <?php if ($userInfo['user_id']==$_SESSION['id']): ?>
                                    <br><button id="subscribe" class="button button-sp"><a href="mypage.php?doid=<?php echo htmlSC($doInfo['do_id']); ?>" >消去</a></button>
                                    <?php endif ?>
                    <?php endwhile; ?>
                    </ul>
                    <?php endwhile; ?>

            <div class="row">
                    <div class="span4"></div>
                <div class="span4">  
                    <?php if($page>1):?>
                    <button id="subscribe" class="button button-sp"><a href="mypage.php?page=<?php print($page-1); ?>">前のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp">前のページ</button>
                    <?php endif; ?>

                    <?php if($page<$maxpage): ?>
                        <button id="subscribe" class="button button-sp"><a href="mypage.php?page=<?php print($page+1); ?>">次のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp">次のページ</button>
                    <?php endif; ?>
                </div>
                </div>


            </div>
</div>
<!-- Price section end -->

 <!-- Price section start -->
        <div id="clients">
            <div class="section primary-section">
                <div class="triangle"></div>
            <div class="container">
                <div class="title">
                    <h1>My改善案</h1>
                    <p>自分が投稿した改善案一覧！</p>
                </div>
            <div class="price-table row-fluid">
                <div class="span12 price-column">
                        <ul class="list">
                            <?php while($actionInfo=mysql_fetch_assoc($action_temp)):
                            //plan情報
                            $tbl_name="plan_tbl";
                            $tbl_id="plan_id";
                            $planInfo=tbl($tbl_name,$tbl_id,$actionInfo['plan_id']);
                            ?>
                            <li>
                                <?php echo $planInfo['plan_title']; ?>:<?php echo $actionInfo['action_text']; ?>
                                <?php if ($userInfo['user_id']==$_SESSION['id']): ?>
                                    <br><button id="subscribe" class="button button-sp"><a href="">編集</a></button>　<button id="subscribe" class="button button-sp"><a href="mypage.php?actionid=<?php echo htmlSC($actionInfo['action_id']); ?>">消去</a></button>
                                    <?php endif ?>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                </div>
            </div>
            <div class="row">
                    <div class="span4"></div>
                <div class="span4">  
                    <?php if($page>1):?>
                    <button id="subscribe" class="button button-sp"><a href="mypage.php?page=<?php print($page-1); ?>">前のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp">前のページ</button>
                    <?php endif; ?>

                    <?php if($page<$maxpage): ?>
                        <button id="subscribe" class="button button-sp"><a href="mypage.php?page=<?php print($page+1); ?>">次のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp">次のページ</button>
                    <?php endif; ?>
                </div>
                </div>


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