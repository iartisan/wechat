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
	$str="select * from orders";
	$q=mysql_query($str);
	echo mysql_num_rows($q);
		
 ?>

