<?php 
function insertaction($uerid,$text,$planid,$date){
	$insert_sql=sprintf('INSERT INTO action_tbl SET user_id=%d, action_text="%s", plan_id=%d,action_created=NOW()',
        $uerid,$text,$planid,$date
        );
    mysql_query($insert_sql) or die(mysql_error());
}



 ?>