<?php
	$con=mysql_connect("localhost","root","goodluck");
	mysql_select_db("wechat");
	if($_POST['type']==1)
	{

		$sql="select id,status from styles where  status<".$_POST['status']." order by status desc limit 1";
	}
	else
	{
		$sql="select id,status from styles where  status>".$_POST['status']." order by status asc limit 1";
	}
	$query=mysql_query($sql);
	$id=mysql_result($query, 0,"id");
	$status=mysql_result($query, 0,"status");
	$up1="update styles set status=".$_POST['status']." where id=".$id."";
	$up2="update styles set status=".$status." where id=".$_POST['id']."";
	mysql_query($up1);
	mysql_query($up2);
	mysql_close($con);
?>
