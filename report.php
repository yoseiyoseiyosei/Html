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
選択された企画のidを取得してセッションに渡す

入力したものをpostで渡す：
do_text_x
do_pic_x
do_movie_x

自己評価：do_check
改善案：action_text


*/

//select文の関数を持ったphpファイル
require "selectsql.php";

$_SESSION['report']['plan_id']=$_REQUEST['plan_id'];


if (!empty($_POST)) {
    $form=postCheck($_POST);
    $error=errorCheck($form);
    if (!empty($error)) {
        header("Location:reportcheck.php");
    }

}

function postCheck($form){
    $form['do_text_0']=$_POST['do_text_0'];
    $form['action_text']=$_POST['action_text'];
    return $form;
}


function errorCheck($form){
    if($form['do_text_0']==""){
        $error['do_text_0']="blank";
    }
    if($form['action_text']==""){
        $error['action_text']="blank";
    }
    return $error;
}
//企画の情報を引き出す
$tbl_name="plan_tbl";
$tbl_id="plan_id";
$plan=tbl($tbl_name,$tbl_id,$_REQUEST['plan_id']);

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

        <style>



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


 		<form action ="reportcheck.php" method ="post" enctype="multipart/form-data">
 		

					<h4><b>PLAN:<?php echo $plan['plan_title']; ?></b></h4><br>
                    <?php if(!empty($error['do_text_0']) && $error['do_text_0']=="brank"){echo "テキストを記入してください";} ?>
					<ul id="report_list" style='list-style-type:none;'>
						<li>
    			            <div id="single-project">
                			    <div id="slidingDiv" class="row-fluid single-project">
                        			<div class="span4">
                                                <div class="uploadButton">
                                                    <p>写真を選択</p><br>
                                                <input type="file" onchange="uv.style.display='inline-block'; uv.value = this.value;" name="do_pic_0"/>
                                                <input type="text" id="uv" class="uploadValue" disabled />
                                                </div>
                                                
 												<div class="uploadButton">
                                                    <p>youtube動画のID</p><br>
                                                <input type="text" name="do_movie_0" />
                                                </div>
                       				</div>
                    			    <div class="span8">
                        			    <div class="project-description">
                                			<div class="project-title clearfix">
                                    			<h3>DO:ページ<?php echo "1"; ?></h3>
                                    
                                			</div>
                                			<div class="project-info">
                                    			<div>
                                        			<textarea name="do_text_0" class="reporttext" ></textarea>
                                    			</div>
                                    
                                			</div>
                            			</div>
                        			</div>
                    			</div>
                    		</div>

						</li>
					</ul>
					<input class="btn btn-default" type="button" value="ページの追加" id="btn_add2" />

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
                        <p>評価してください。</p>
                    </div>
                    <div class="span7">
                        
                            <label for="category" class="select-wrap entypo-down-open-mini">
                                <select name="do_check" id="category">
                                    <option value="5" selected>５</option>
                                    <option value="4">４</option>
                                    <option value="3">３</option>
                                    <option value="2">２</option>
                                    <option value="1">１</option>
                                    <option value="0">０</option>
                                </select>
                            </label>
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
                        <p>企画の改善を記入してください。</p>
                    </div>
                    <div class="span7">
                        <?php if (!empty($error['action_text']) && $error['action_text']=="blank"){echo "※改善点を記入してください";}?>
                            <input type="text" name="action_text" id="nlmail" class="span8" placeholder="改善案を記入してください" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter section end -->


        <button type= "submit" class="btn btn-primary btn-lg btn-block">入力を確認する</button>
		<input type="hidden" name="MAX_FILE_SIZE" value="65536">
		</form>
                
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