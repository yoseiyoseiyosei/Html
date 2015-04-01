<?php 
//テーブルの全ての情報を取得
function tblall($tbl_name){
	$sql=sprintf("SELECT * FROM {$tbl_name}");
	$tempall=mysql_query($sql) or die(mysql_error());
    return $tempall;
}

//テーブルのIDからテーブル情報を引っ張ってくるとき
function tbl($tbl_name,$tbl_id,$select_id){
	$sql=sprintf("SELECT * FROM {$tbl_name} WHERE {$tbl_id}=%d",$select_id);
	$temp=mysql_query($sql) or die(mysql_error());
    $tblInfo=mysql_fetch_assoc($temp);
    return $tblInfo;
}

//テーブルから全ての情報を引き出す
function tblallinfo($tbl_name){
$sql='SELECT * FROM {$tbl_name}';
$temp=mysql_query($sql) or die(mysql_error());
$tblInfo=mysql_fetch_assoc($temp);
return $tblInfo;
}



function htmlSC($value){
    return htmlspecialchars($value,ENT_QUOTES,'UTF-8');
}
function mres($value){
	return mysql_real_escape_string($value);
}

function tbl_temp($tbl_name,$tbl_id,$select_id){
	$sql=sprintf("SELECT * FROM {$tbl_name} WHERE {$tbl_id}=%d",$select_id);
	$temp=mysql_query($sql) or die(mysql_error());
	return $temp;
}

 ?>