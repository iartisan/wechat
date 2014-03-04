<?php
	mysql_connect("localhost","root","goodluck");
	mysql_select_db('wechat');
	if($_POST['type']==1)
	{
		$sql="select id,status from styles where status<".$_POST['status']." order by id desc limit 1";
	}
	else
	{
		$sql="select id,status from styles where status>".$_POST['status']." order by id asc limit 1";
	}
	$query=mysql_query($sql);
	$status=mysql_result($query,0,"status");
	$id=mysql_result($query,0,"id");
	$s="update styles set status=".$_POST['status']." where id=".$id."";
	mysql_query($s);
	$s="update styles set status=".$status." where id=".$_POST['id']."";
	mysql_query($s);
 ?>

