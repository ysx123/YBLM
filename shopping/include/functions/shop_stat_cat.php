<?
Function shop_stat_cat($cat_id){
	$q=mysql_query("select * from stat_cat where cat_id='$cat_id' and day=now()");
	if(!mysql_num_rows($q)){

		mysql_query("insert into stat_cat (cat_id,views,day) values ('$cat_id','1',now())");
	}else{
		$a=mysql_fetch_array($q);
		$id=$a["id"];
		$views=$a["views"]+1;
		mysql_query("update stat_cat set views='$views' where id='$id'");
	}
}
?>