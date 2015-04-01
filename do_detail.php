<?php 
require "db_conect.php";
session_start();

//select文の関数を持ったphpファイル
require "selectsql.php";

//リクエストがあった場合いいねを増やす
if (!empty($_REQUEST['like'])) {
    likeadd($_REQUEST['like'],"do_check_tbl","do_id","do_like");
}

//改善案が書かれた時
if (!empty($_POST)) {
    $insert_sql=sprintf('INSERT INTO action_tbl SET user_id="%d", action_text="%s", plan_id=%d,action_created=NOW()',
        mysql_real_escape_string($_SESSION['id']),mysql_real_escape_string($_POST['action_text']),
        mysql_real_escape_string($_POST['plan_id']),date('Y-m-d H:i:s')
        );
    $temp=mysql_query($insert_sql) or die(mysql_error());
    //header('Location:mian.php');
}
if (!empty($_REQUEST['doid'])) {
    $_SESSION['do_id']=$_REQUEST['doid'];
    $doid=$_REQUEST['doid'];
}else{
    $doid=$_SESSION['do_id'];
}



//do_idからplanidとuseridを引き出してくる
$tbl_name="do_check_tbl";
$tbl_id="do_id";
$doInfo=tbl($tbl_name,$tbl_id,$doid);


//plan情報
$tbl_name="plan_tbl";
$tbl_id="plan_id";
$plan=tbl($tbl_name,$tbl_id,$doInfo['plan_id']);


//ユーザー情報
$tbl_name="user_profile";
$tbl_id="user_id";
$userInfo=tbl($tbl_name,$tbl_id,$doInfo['user_id']);

//レポート情報
$tbl_name="report_tbl";
$tbl_id="do_id";
$report_temp=tbl_temp($tbl_name,$tbl_id,$doid);

//改善情報
$tbl_name="action_tbl";
$tbl_id="do_id";
$action=tbl($tbl_name,$tbl_id,$doid);



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
        <link rel="stylesheet" type="text/css" href="css/button.css" />
        
        <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="css/animate.css" />
        
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
                <div class="row">
                        <div class="span4"></div>
                        <div class="span4"></div>
                        <div class="span4"><button id="subscribe" class="button button-my" onClick="introJs().start()">チュートリアルスタート</button></div>

                    </div>
                <div class="title">
                    <h1>検証記事</h1>
                    <p>企画に対しての検証を見てみよう！</p>
                </div>
                        
                        <div id="single-project">
                                <div id="slidingDiv" class="row-fluid single-project">
                                	<div class="span12">
                                        <div class="project-description">
                                            <div class="project-title clearfix">
                                                <h3>企画:<?php echo $plan['plan_title']; ?></h3>
                                            </div>
                                            <div class="project-info">
                                                <p>検証者:<?php echo $userInfo['user_name']; ?></p>
                                                    <p>いいね数:<?php echo $doInfo['do_like']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                    	
                    </div>
					</div>
                        
                        

                        
                        <?php 
                            while($reportInfo=mysql_fetch_assoc($report_temp)):
                        ?>
                        
                            <div id="single-project">
                                <div id="slidingDiv" class="row-fluid single-project">
                                    
                                        <div class="span6">

                                        <?php if($reportInfo['do_pic']=="noimage.jpg" && $reportInfo['do_movie']=="nomovie"): ?>
                                            <img src="report_img/<?php echo $reportInfo['do_pic']; ?>" alt="">
                                        <?php else: ?>
                                                <?php if($reportInfo['do_pic']=="noimage.jpg"): ?>                      
                                                <iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $reportInfo['do_movie']; ?>" frameborder="0" allowfullscreen></iframe>
                                                <?php endif; ?>
                                                <?php if($reportInfo['do_movie']=="nomovie"): ?>
                                                <img src="report_img/<?php echo $reportInfo['do_pic']; ?>" alt="">
                                                <?php endif; ?>
                                        <?php endif; ?>
                                    </div>                         
                                
                                    <div class="span6">
                                        <div class="project-description">
                                            <div class="project-title clearfix">
                                                <h3>ページ番号<?php echo $reportInfo['report_order']; ?></h3>
                                            </div>
                                            <div class="project-info">
                                                <div>
                                                    <p><?php echo $reportInfo['do_text']; ?></p>
                                                    <?php if ($userInfo['user_id']==$_SESSION['id']): ?>
                                                            <button id="subscribe" class="button button-sp"><a href="updateall.php?reportid=<?php echo $reportInfo['report_id']; ?>">編集</a></button>
                                                    <?php endif; ?>
                                                </div>
                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        
                    <?php endwhile; ?>
                    
                     <div id="single-project">
                                <div id="slidingDiv" class="row-fluid single-project">
                                    <div class="span12">
                                        <div class="project-description">
                                            <div class="project-title clearfix">
                                                <h3>自己評価</h3>
                                                
                                            </div>
                                            <div class="project-info">        
                                             <p><?php echo $doInfo['do_check']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                        
                    </div>
                    </div>
                    
                    <div id="single-project">
                                <div id="slidingDiv" class="row-fluid single-project">
                                	<div class="span12">
                                        <div class="project-description">
                                            <div class="project-title clearfix">
                                                <h3>改善点</h3>

                                            </div>
                                            <div class="project-info">
                                                
                                                    
                    	<p><?php echo $action['action_text']; ?></p>
                                                
                                    
                                            </div>
                                        </div>
                                    </div>
                    	
                    </div>
					</div>
                    
                    <div id="single-project">
                                <div id="slidingDiv" class="row-fluid single-project">
                                    <div class="span12">
                                        <div class="project-description">
                                            <div class="project-title clearfix">
                                                <div class="project-title clearfix">
                                                    <?php if ($userInfo['user_id']!=$_SESSION['id']): ?>
                                                        <h3>あなたの評価＆改善入力フォーム</h3>
                                                    <?php else: ?>
                                                        <h3>消去</h3>
                                                    <?php endif ?>

                                            </div>
                    <?php if ($userInfo['user_id']==$_SESSION['id']): ?>
                                    <button id="subscribe" class="button button-sp"><a href="">消去</a></button>
                    <?php else: ?>
                            <div class="loadButton span6">
                                <a href="do_detail.php?like=<?php echo htmlSC($doInfo['do_id']); ?>">いいね:<?php echo $doInfo['do_like']; ?></a>                            
                            </div>
                            <form class="inline-form" method="post" action="">
                            <textarea name="action_text" placeholder="改善案を書き込もう！" id="nlmail"></textarea>
                            <input type="hidden" value="<?php echo $planInfo['plan_id']; ?>" name="plan_id">
                            <button id="subscribe" class="button button-sp" type="submit">書き込む</button>      
                            </form>
                    <?php endif ?>
                    
                    
                
                       
			         </div></div></div></div></div>



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
