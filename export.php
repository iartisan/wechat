<?php
	header( "Content-type: application/octet-stream ");

	header( "Accept-Ranges: bytes ");

	header( "Content-Disposition: attachment; filename=url.txt ");

	header( "Expires: 0 ");

	header( "Cache-Control: must-revalidate, post-check=0, pre-check=0 ");

	header( "Pragma: public ");
	mysql_connect("localhost","root","goodluck");
	mysql_select_db('wechat');
	$week = date("W", time());
	$str1="select * from orders";
	$q=mysql_query($str1);
	echo "编号\t省份\t用户名\t信息\t电话号码\t日期\t总积分\t转发积分\t评论积分\t排名\r\n";
	while($rows = mysql_fetch_array($q))
	 {
		echo $rows['id']."\t";
		echo $rows['name']."\t";
		echo $rows['created_at']."\t";
		echo $rows['price']."\t";
		echo $rows['remark']."\r\n";
		//echo "";
	}	
 ?>

