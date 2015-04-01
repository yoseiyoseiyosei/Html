<?php
require "db_conect.php";
session_start();

$form = array('name' =>"",
                'email' =>"",
                'password' =>"",
                'pic' =>"",
             );
$error = array(
            "name" => "",
            "email"=>"",
            "password"=>"",
            "pic"=>""
            );

//fbでログインして初めてのログインの場合
if(isset($_SESSION['user_fb_info'])){
    $user_info=$_SESSION['user_fb_info'];
    $form['name']=$user_info['name'];
    $form['email']=$user_info['name']."@";
    $form['password']=sha1($user_info['id']);

}
//登録が押されてPOSTの中身が正常ならログイン画面にelseならエラーを表示する
if (!empty($_POST)) {
    $form=postCheck($form);
    $error=errorCheck($form);

    if(empty($error)){
        //確認画面に渡すためにSESSIONに格納していく
        $_SESSION['kakunin']['name']=$form['name'];
        $_SESSION['kakunin']['email']=$form['email'];
        $_SESSION['kakunin']['password']=$form['password'];


    if(!empty($form['pic_name'])){
        $_SESSION['kakunin']['pic_name']=$form['pic_name'];
        

            if(!empty($_FILES['pic']['name'])){
                $dir='/usr/local/www/a1.zeroprm.com/htdocs/b31_c577/keijiban/PDCA/Html/profile_img/';
                $file=$dir.basename($_FILES['pic']['name']);
                    //保存する
                    if(move_uploaded_file($_FILES['pic']['tmp_name'],$file)){
                     echo "<p>登録</p>";
                    }
            }

        }else{
            $_SESSION['kakunin']['pic_name']="noimage.jpg";
        }
        header("Location:fbsignupcheck.php");
    }

}

if(!empty($_GET['action']) and $_GET['action']=="rewrite"){
    $form=$_SESSION['kakunin'];
}

function errorCheck($form){
    if($form['name']==""){
        $error['name']="blank";
    }


    if(!empty($_FILES['pic']['name']) and strpos($form['pic_name'],'jpg')===false and strpos($form['pic_name'],'png')===false and strpos($form['pic_name'],'gif')===false){
        $error['pic']="nopicform";

    }

    return $error;
}

function postCheck($form){
    $form['name']=$_POST['name'];


    if(!empty($_FILES['pic']['name'])){
        $form['pic_name']=$_FILES['pic']['name'];
        $form['pic_tmpname']=$_FILES['pic']['tmp_name'];

    }else{
        $form['pic_name']="noimage.jpg";
    }
    return $form;
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

        <style>
        p{
            color: black;
        }



.uploadButton {
    display:inline-block;
    position:relative;
    overflow:hidden;
    border-radius:3px;
    background:#FECE1A;
    color:#fff;
    text-align:center;
    padding:10px;
    line-height:30px;
    width:180px;
    cursor:pointer;
}
.uploadButton:hover {
    background:#0aa;
}
.uploadButton input[type=file] {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;    
    cursor:pointer;
    opacity:0;
}
.uploadValue {
    display:none;
    background:rgba(255,255,255,0.2);
    border-radius:3px;
    padding:3px;
    color:#ffffff;
}
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
                            <li><a href="signup.php">SignUp</a></li>
                            <li><a href="login.php">Login</a></li>
                            
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
                                <h3>登録画面</h3>

                                <form id="contact-form" action="" method="post" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <div class="controls">
                                            <p>名前</p>
                                            <input type="text" name="name" placeholder="名前" class="span10" value="<?php echo htmlspecialchars($form['name']); ?>" maxlenth="255" />
                                            
                                             <!--エラー警告表示-->
                                            <?php if (!empty($error['name']) and $error['name']=="blank") {echo "名前を入力してください";}?>
                                        </div>
                                    </div>
                                    

                                    <div class="control-group">
                                        <div class="controls">
                                            <p>写真</p>
                                            <div class="position">
                                                <div class="uploadButton">
                                                    ファイルを選択
                                                <input type="file" onchange="uv.style.display='inline-block'; uv.value = this.value;" />
                                                <input type="text" id="uv" class="span10" disabled />
                                                </div>    
                                            </div>

                                            <!--エラー警告表示-->
                                            <?php if (!empty($error['pic']) and $error['pic']=="nopicform") {echo "ファイルの拡張子をjpgまたはgifまたはpngにしてください";}
                                            ?>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="controls">
                                            <button id="send-mail" class="message-btn">登録</button>
                                        </div>
                                    </div>
                                </form>


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
