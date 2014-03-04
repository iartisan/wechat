<?php
<<<<<<< HEAD
	phpinfo();
=======
	header("Content-type:application/vnd.ms-excel");

	header( "Accept-Ranges: bytes ");

	header( "Content-Disposition: attachment; filename=订单数据.xls ");

	header( "Expires: 0 ");

	header( "Cache-Control: must-revalidate, post-check=0, pre-check=0 ");

	header( "Pragma: public ");
	mysql_connect("localhost","root","goodluck");
	mysql_select_db('wechat');
	$week = date("W", time());
	$str="select * from orders";
	$q=mysql_query($str);
	echo "编号\t下单时间\t顾客名\t菜品\t费用\t折扣\t支付状态\t联系方式\t备注\r\n";
	while($rows = mysql_fetch_array($q))
	 {
	 	echo "V".date('Ymd').$rows['id']."\t";
	 	echo $rows['created_at']."\t";
		echo $rows['name']."\t";
		echo $rows['foods']."\t";
		echo $rows['price']."\t";
		echo $rows['rebate']."\t";
		echo $rows['pay']."\t";
		echo $rows['phone']."\t";
		echo $rows['remark']."\r\n";
		//echo "";
	}	
>>>>>>> huihui
 ?>

