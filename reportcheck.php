<?php 
require "db_conect.php";
session_start();
/*
if (empty($_SESSION['user_id'])) {
    header("Location:index.html");
}
*/

/*
セッションに格納されたuser_idを取得する
セッションに企画のidを取得してくる

$_SESSION['report']['']
入力したものをセッションに渡す：
do_text_x
do_pic_x
do_movie_x

$_SESSION['report']['']
自己評価：do_check
改善案：action_text


*/
//select文の関数を持ったphpファイル
require "selectsql.php";
    
    $a=0;
    foreach ($_FILES as $key => $value) {
        $do_pic="do_pic_".$a;
        switch ($key) {
            case $do_pic:
                if(!empty($value)){
                    $form[$do_pic]=$value['name'];
                    $_SESSION['report'][$do_pic]=$value['name'];
                    $dir='/usr/local/www/a1.zeroprm.com/htdocs/b31_c577/keijiban/PDCA/Html/report_img/';
                    $file=$dir.basename($value['name']);
                        //保存する
                        if(move_uploaded_file($value['tmp_name'],$file)){
                            //保存されました
                        }
                    
                }else{
                    $form[$do_pic]="noimage.jpg";
                    $_SESSION['report'][$do_pic]="noimage.jpg";
                    
                }
                $a++;
                break;
            default:
            
                break;
        }
        
    }

        

    $i=0;$j=0;
    foreach ($_POST as $key => $value) {
        $do_text="do_text_".$i;
        $do_movie="do_movie_".$j;
        switch ($key) {
            case $do_text:
                $form[$do_text]=$value;
                $_SESSION['report'][$do_text]=$value;
                
                $i++;
                break;
            case $do_movie:
                if(!empty($value)){
                    $form[$do_movie]=$value;
                    $_SESSION['report'][$do_movie]=$value;
                    
                }else{
                    $form[$do_movie]="nomovie";
                    $_SESSION['report'][$do_movie]="nomovie";
                    
                }
                $j++;
                break;
            case 'do_check':
                $form['do_check']=$value;
                $_SESSION['report']['do_check']=$value;
                
                break;
            case 'action_text':
                $form['action_text']=$value;
                $_SESSION['report']['action_text']=$value;
                
                
                break;
            default:
                
                break;
        }
    }
    $_SESSION['count']=$i;
        
            
  //企画の情報を引き出す
$tbl_name="plan_tbl";
$tbl_id="plan_id";
$plan=tbl($tbl_name,$tbl_id,$_SESSION['report']['plan_id']);
    

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
        <link rel="stylesheet" type="text/css" href="css/button.css" />
        
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
                            <li class="active"><a href="index.html">Home</a></li>
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

        <!-- Portfolio section start -->
    <div class="section secondary-section " id="portfolio">
        <div class="triangle"></div>
        <div class="container">


 		
					<h4><b>PLAN:<?php echo $plan['plan_title']; ?></b></h4><br>
            
					<ul id="report_list">
                    <?php
                        $i=$_SESSION['count'];
                    for($count=0;$count<$i;$count++): 
                    ?>
                    <?php 
                        $do_text="do_text_".$count;
                        $do_pic="do_pic_".$count;
                        $do_movie="do_movie_".$count;
                    ?>
						<li>			
    			            <div id="single-project">
                			    <div id="slidingDiv" class="row-fluid single-project">
                        			<div class="span6"> 
                                        <?php if(!empty($form[$do_pic])): ?>
                                            <img  src="report_img/<?php echo $form[$do_pic]; ?>" alt="">
                                        <?php else: ?>
                                                                                                                
                                            <iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $form[$do_movie]; //ZMdkZeCzj44?>" frameborder="0" allowfullscreen></iframe>
                                        <?php endif; ?>
                       				</div>
                    			    <div class="span6">
                        			    <div class="project-description">
                                			<div class="project-title clearfix">
                                    			<h3>DO:ページ<?php echo $i; ?></h3>
                                    
                                			</div>
                                			<div class="project-info">
                                    			<div>
                                        			<p> <?php echo $form[$do_text]; ?> </p>
                                    			</div>
                                    
                                			</div>
                            			</div>
                        			</div>
                    			</div>
                    		</div>
						</li>
                    <?php endfor; ?>

					</ul>
                    
				
			

			<!-- Newsletter section start -->
        <div class="section third-section">
            <div class="container newsletter">
                <div class="sub-section">
                    <div class="title clearfix">
                        <div class="pull-left">
                            <h3>CHECK</h3>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span5">
                        
                    </div>
                    <div class="span7">
                            <p> <?php echo $form['do_check']; ?> </p>
                    </div>
                </div>
                <div class="sub-section">
                    <div class="title clearfix">
                        <div class="pull-left">
                            <h3>ACTION</h3>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span5">
                        
                    </div>
                    <div class="span7">
                            <p> <?php echo $form['action_text']; ?> </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter section end -->
        
        <a href="reportsave.php?save=check">OK</a>
        
                
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
        <script src="http://code.jquery.com/jquery.min.js"></script>
	<script src="script.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
    </body>
</html>