<?php 
//表示するページ数を求める
if (!empty($_REQUEST['page'])) {
    $page=$_REQUEST['page'];
}else{
    $page=1;
}
$cnt_sql ="SELECT COUNT(*) AS cnt FROM {$tbl_name}";
$cnt_tmp=mysql_query($cnt_sql);
$msg=mysql_fetch_assoc($cnt_tmp);
$maxpage=ceil($msg['cnt']/$page_num);
$page=min($page,$maxpage);

//表示し始める行数を求める
$start_row=($page-1)*$page_num;



 ?>