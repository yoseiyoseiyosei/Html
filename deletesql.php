<?php 
function delete($tbl_name,$tbl_id,$delete_id){
	$sql=sprintf("DELETE FROM {$tbl_name} WHERE {$tbl_id}=%d",$delete_id);
	mysql_query($sql) or die(mysql_error());
}


 ?>