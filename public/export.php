<?php
	header("content-type:text/html; charset=utf-8");
	header("Content-type:application/vnd.ms-excel");
	header( "Accept-Ranges: bytes ");
	header( "Content-Disposition: attachment; filename=订单数据.xls ");
	header( "Expires: 0 ");
	header( "Cache-Control: must-revalidate, post-check=0, pre-check=0 ");
	header( "Pragma: public ");
	mysql_connect("localhost","root","goodluck");
	mysql_query("set names utf8");
	mysql_select_db('wechat');
	$week = date("W", time());
	$str="select * from orders";
	$q=mysql_query($str);
	echo "编号\t下单时间\t顾客名\t菜品\t费用\t折扣\t支付状态\t联系方式\t备注\r\n";
	while($rows = mysql_fetch_array($q))
	 {
	 	echo "V".date('Ymd').$rows['id']."\t";
	 	echo $rows['created_at']."\t";
		$sql="select * from contacts where id=".$rows['of_contact'].""."\t";
		$query=mysql_query($sql);
		while($r=mysql_fetch_array($query))
		{
			echo $r['name']."\t";
			echo $r['phone']."\t";
			echo $r['address']."\t";
		}
		$strsql="select foods.name as name,om.count as count,om.price as price,om.rebate as rebate from foods inner join ordersmsgs as om on om.of_food=foods.id and of_order=".$rows['id']."";
		$qt=mysql_query($strsql);
		for($i=0;$i<mysql_num_rows($qt);$i++)
		{
			$fuhao=":";
			if($i==(mysql_num_rows($qt)-1))
			{
				$fuhao="";
			}
			$s.=mysql_result($qt,$i,"name").",".mysql_result($qt,$i,"count").",".mysql_result($qt,$i,"price").",".mysql_result($qt,$i,"rebate").$fuhao;
			if($i==(mysql_num_rows($qt)-1))
			{
				echo $s."\t";
			}
		}
		echo $rows['remark']."\r\n";
		//echo "";
	}	
 ?>

