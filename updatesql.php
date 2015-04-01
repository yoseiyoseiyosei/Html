<?php 
function updateusser($name,$email,$password,$pic,$id){
	$sql=sprintf('UPDATE user_profile SET user_name="%s",user_email="%s",user_password="%s",user_pic="%s" WHERE user_id=%d',
		$name,$email,$password,$pic,$id);	
}

function updatereport($text,$pic,$movie,$reportid){
	$sql=sprintf('UPDATE report_tbl SET do_text="%s",do_pic="%s",do_movie="%s" WHERE report_id=%d',
		$text,$pic,$movie,$reportid);
	mysql_query($sql) or die(mysql_error());
}

function updateplan($title,$planid){
	$sql=sprintf('UPDATE plan_tbl SET plan_title="%s" WHERE plan_id=%d',
		$title,$planid);
	mysql_query($sql) or die(mysql_error());
}

function updateaction($text,$actionid){
	$sql=sprintf('UPDATE action_tbl SET action_text="%s" WHERE action_id=%d',
		$text,$actionid);
	mysql_query($sql) or die(mysql_error());
}

 ?>