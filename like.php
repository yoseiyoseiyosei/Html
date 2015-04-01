<?php
	function likeadd($request_like,$tbl_name,$tbl_id,$tbl_like){
	$fetch_sql=sprintf("SELECT * FROM {$tbl_name} WHERE {$tbl_id}='%d'",mysql_real_escape_string($request_like));
    $temp=mysql_query($fetch_sql) or die(mysql_error());
    $user_like=mysql_fetch_assoc($temp);
    $user_like["$tbl_like"]++;
    $add_sql=sprintf("UPDATE {$tbl_name} SET {$tbl_like}='%d' WHERE {$tbl_id}='%d'",mysql_real_escape_string($user_like["$tbl_like"]),mysql_real_escape_string($request_like));
    mysql_query($add_sql) or die(mysql_error());
	}
 ?>