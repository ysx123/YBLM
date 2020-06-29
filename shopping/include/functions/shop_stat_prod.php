<?
Function shop_stat_prod($article_id){
	$q=mysql_query("select * from stat_prod where article_id='$article_id' and day=now()");
	if(!mysql_num_rows($q)){
		mysql_query("insert into stat_prod (article_id,views,day) values ('$article_id','1',now())");
	}else{
		$a=mysql_fetch_array($q);
		$id=$a["id"];
		$views=$a["views"]+1;
		mysql_query("update stat_prod set views='$views' where id='$id'");
	}
}
?>