<?php

if (!empty($_SESSION['id']) || !empty($_SESSION['user_fb_info'])) {

}else{
    header("Location:login.php");
}
 ?>