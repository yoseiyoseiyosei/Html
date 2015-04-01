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
    likeadd($_REQUEST['like'],"plan_tbl","plan_id","plan_like");
}

//MYpageに企画を保存
if (!empty($_REQUEST['try'])) {
    $try_sql=sprintf('INSERT INTO try_tbl SET user_id=%d, plan_id=%d',$_SESSION['id'],$_REQUEST['try']); 
    mysql_query($try_sql) or die(mysql_error());
}

//メッセージをDBに格納
if (!empty($_POST['title'])) {
    $insert_sql=sprintf('INSERT INTO plan_tbl SET user_id="%d", plan_title="%s", plan_created=NOW()',mysql_real_escape_string($_SESSION['id']),mysql_real_escape_string($_POST['title']));
    $temp=mysql_query($insert_sql) or die(mysql_error());

}

//ページをめくれるようにする
$tbl_name="plan_tbl";
$page_num=6;
require "pagescroll.php";
//新着順
$sql=sprintf('SELECT up.user_name,up.user_pic,pt.* FROM plan_tbl pt,user_profile up WHERE pt.user_id=up.user_id ORDER BY pt.plan_created DESC LIMIT %d,6',$start_row);
$plan_temp=mysql_query($sql) or die(mysql_error());




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
        <link rel="stylesheet" type="text/css" href="css/jquery.mycslider.css" />
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
        <style>
        p{
            color: black;
        }
        </style>

        <!-- modal.cssの読み込み -->
        <link rel="stylesheet" href="css/modal.css"/>
        <!-- jQueryライブラリの読み込み -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <!-- modal.jsの読み込み -->
        <script src="js/modal.js"></script>

<SCRIPT LANGUAGE="JavaScript">
Img=new Array();
Img[1]="images/test1.gif";
Img[2]="images/test2.gif";
Img[3]="images/test3.gif";
Img[4]="images/test4.gif";
Img[5]="images/test5.gif";
cnt=1;
function NextIMG(flag){
if(flag=='next'){
cnt++;
document.MyIMG.src=Img[cnt];
document.FI.TI.value=''+cnt+'/5';
if(cnt>5){
document.MyIMG.src=Img[1];
document.FI.TI.value='1/5';
cnt=1;
}
}else if(flag=='back'){
if(cnt>1){
cnt--;
document.MyIMG.src=Img[cnt];
document.FI.TI.value=''+cnt+'/5';
}
}else if(flag=='top'){
document.MyIMG.src=Img[1];
document.FI.TI.value='1/5';
cnt=1;
}
}

</SCRIPT>

    <!-- スらいだー -->
    <link href="bootstrap3/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/get-shit-done.css" rel="stylesheet" />  
    <link href="assets/css/demo.css" rel="stylesheet" /> 
    
    <!--     Font Awesome     -->
    <link href="bootstrap3/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>

    <!-- スらいだー -->
    <script src="jquery/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
    <!--
    <script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>
    -->
    <script src="assets/js/custom.js"></script>

<script type="text/javascript">
         
    $('.btn-tooltip').tooltip();
    $('.label-tooltip').tooltip();
    $('.pick-class-label').click(function(){
        var new_class = $(this).attr('new-class');  
        var old_class = $('#display-buttons').attr('data-class');
        var display_div = $('#display-buttons');
        if(display_div.length) {
        var display_buttons = display_div.find('.btn');
        display_buttons.removeClass(old_class);
        display_buttons.addClass(new_class);
        display_div.attr('data-class', new_class);
        }
    });
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 75, 300 ],
    });
    $( "#slider-default" ).slider({
            value: 70,
            orientation: "horizontal",
            range: "min",
            animate: true
    });
    $('.carousel').carousel({
      interval: 4000
    });
      
    
</script>



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




<div class='blurred-container'>
     <a href="http://creative-tim.com">
         <div class="logo-container">
            <div class="logo">
                <img src="assets/img/new_logo.png">
            </div>
            <div class="brand">
                Creative Tim
            </div>
        </div>
    </a>
    <div class="motto">
        <div>Get</div>
        <div class="border no-right-border">Sh</div><div class="border">it</div>
        <div>Done</div>
    </div>
  <div class="img-src" style="background-image: url('assets/img/cover_4.jpg')"></div>
  <div class='img-src blur' style="background-image: url('assets/img/cover_4_blur.jpg')"></div>
</div>

        


        <!-- Newsletter section start -->
<div class="section secondary-section " id="portfolio">

<div class="container container newsletter">

<div id="modal-content">
    <!-- モーダルウィンドウのコンテンツ開始 -->
<div align="center">
<img name="MyIMG" src="images/test1.gif" border="0" width="200" height="150">
<br><br>
<FORM name="FI">
<INPUT type="text" name="TI" size="5" value="1/10" style="text-align:center">
<br><br>
<INPUT type="button" value="BACK" onClick="NextIMG('back')">
<INPUT type="button" value="TOP" onClick="NextIMG('top')"> 
<INPUT type="button" value="NEXT" onClick="NextIMG('next')"> 
</FORM>
</div>

<form action="">
    <input type="text">
    <input type="text">
</form>

    <p><a id="modal-close" class="button-link">閉じる</a></p>
    <!-- モーダルウィンドウのコンテンツ終了 -->

</div>
<div class="row">
    <div class="span4"></div>
    <div class="span4"></div>
    <div class="span4"><button id="subscribe" class="button button-my" onClick="introJs().start()">チュートリアルスタート</button></div>

</div>

                            <div class="title">                      
                            <h1>PLAN</h1>
                            </div>




                <div class="row-fluid">
                    <div class="span5">
                        <p>企画を書き込んでみよう！<br>ex)<br>虹色のオムライスを作ってみよう！</p>
                        
                    </div>
                    <div class="span7" data-intro="ここに自分が思いついた企画を書き込んでいこう！" data-step="1">
                        <form class="inline-form" method="post" action="">
                           <textarea name="title" placeholder="書き込もう" id="nlmail" cols="100" row="6" class="span8"></textarea>
                            <button id="subscribe" class="button button-my" type="submit">書き込む</button>
                            <p><a id="modal-open" class="button-link">クリックするとモーダルウィンドウを開きます。</a></p>
                            <?php if(empty($_POST['title'])): ?>
                            <p>※内容を入力してください</p>
                        <?php endif; ?>
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
                <div class="container" data-intro="みんなが書いた企画を見てみよう！" data-step="2">
                    <div class="title">
                        <h1>みんなの企画を見てみよう！</h1>
                    </div>

                    
                    <?php 
                    $i=0; 
                    while($planInfo=mysql_fetch_assoc($plan_temp)): 
                            $tbl_name="user_profile";
                            $tbl_id="user_id";
                            $userInfo=tbl($tbl_name,$tbl_id,$planInfo['user_id']);

                    ?>
                    <?php if ($i%3==0): ?>
                            <div class="row" >
                        <?php endif ?>
                        <div class="span4">
                            <div class="testimonial">
                                <div data-intro="みんなが書いた企画" data-step="3">
                                <h3><?php echo $planInfo['plan_title']; ?></h3>
                                </div>
                                <div class="arrow"></div>
                                <div class="whopic">
                                    <div class="profilebox" data-intro="企画投稿者" data-step="4">
                                    <img src="profile_img/<?php echo htmlSC($planInfo['user_pic']); ?>" class="centered" alt="client 1"><br>
                                    name:<br> 
                                    <?php echo $planInfo['user_name']; ?>
                                    </div>
                                    <div class="loadButton" data-intro="企画に「いいね」しよう" data-step="5"><a href="plan.php?like=<?php echo htmlSC($planInfo['plan_id']); ?>">いいね:<?php echo $planInfo['plan_like']; ?></a></div>
                                    <div class="loadButton" data-intro="企画の検証記事一覧を見てみよう" data-step="6"><a href="reportlook.php?planid=<?php echo htmlSC($planInfo['plan_id']); ?>">検証をみる　&gt;</a></div>
                                    <div class="loadButton" data-intro="やってみたい企画をMypageに保存" data-step="7"><a href="plan.php?try=<?php echo htmlSC($planInfo['plan_id']); ?>">Mypageへ保存</a></div>
                                    <?php if ($userInfo['user_id']==$_SESSION['id']): ?>
                                    <br><button id="subscribe" class="button button-sp"><a href="">編集</a></button>　<button id="subscribe" class="button button-sp"><a href="">消去</a></button>
                                    <?php endif ?>
                                </div>
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

                    <?php 
                    
                    endwhile; ?>
 
                    
                </div>

                <div class="row">
                    <div class="span4"></div>
                <div class="span4">  
                    <?php if($page>1):?>
                    <button id="subscribe" class="button button-sp"><a href="plan.php?page=<?php print($page-1); ?>">前のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp"><a href="">前のページ</a></button>
                    <?php endif; ?>

                    <?php if($page<$maxpage): ?>
                        <button id="subscribe" class="button button-sp"><a href="plan.php?page=<?php print($page+1); ?>">次のページへ</a></button>
                    <?php else: ?>
                    <button id="subscribe" class="button button-sp"><a href="">次のページ</a></button>
                    <?php endif; ?>
                </div>
                </div>
            </div>
        </div>




        
<div class="section secondary-section " id="portfolio">
                <div class="container">
                    <!-- ここからモーダルウィンドウ -->


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

