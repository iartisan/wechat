<?php
	header( "Content-type: application/octet-stream ");

	header( "Accept-Ranges: bytes ");

	header( "Content-Disposition: attachment; filename=url.txt ");

	header( "Expires: 0 ");

	header( "Cache-Control: must-revalidate, post-check=0, pre-check=0 ");

	header( "Pragma: public ");
	mysql_connect("localhost","root","goodluck");
	mysql_select_db('wechat');
	$str="select * from orders";
	$q=mysql_query($str);
	echo "订单号\t下单时间\t顾客名\t菜品\t手机号码\t费用\t折扣\t支付状态\t备注\r\n";
	while($rows = mysql_fetch_array($q))
	 {
		echo "VG".$date(YMD).$rows['id']."\t";
		echo $rows['created_at']."\t";
		echo $rows['name']."\t";
		$sql="select count(*) as count from ordersmsg where of_orders=".$id."";
		$query=mysql_query($sql);
		echo $rows['phone']."\t";
		echo $rows['price']."\t";
		echo $rows['rebate']."\t";
		echo $rows['pay']."\t";
		echo $rows['remark']."\r\n";
		//echo "";
	}	
 ?>

