

	<html>
		<body>

	
	<table id="blogs" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-1">订单号</th>
				<th class="col-md-1">下单时间</th>
				<th class="col-md-1">顾客名</th>
				<th class="col-md-1">地址名</th>
				<th class="col-md-1">费用</th>
				<th class="col-md-1">支付状态</th>
				<th class="col-md-1">手机号码</th>
				<th class="col-md-1">备注</th>
				<th class="col-md-1">详情</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<button type="button" class="btn btn-info"><a href="../export.php" target="_blank">导出为excel</a></button>
<!--[if !IE]> -->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->
		<!--[if !IE]> -->

		<script type="text/javascript">
            window.jQuery || document.write("<script src='{{{asset('assets/js/ace/jquery-2.0.3.min.js')}}}>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='{{{asset('assets/js/ace/jquery-1.10.2.min.js')}}}'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='{{{asset('assets/js/ace/jquery.mobile.custom.min.js')}}}>"+"<"+"/script>");
		</script>
{{ Basset::show('admin.js') }}

   <script src="{{asset('assets/js/ace/ace-extra.min.js')}}"></script>
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#blogs').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"bFilter":true,
					"sLengthMenu": "_MENU_",
					"sInfo":"",
					"bPaginate": false,
			         "bSort": false,
			         "sSearch":"搜索"
				},
				"bFilter":false,
				"bPaginate" : false,
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/orders/infos/'.$id) }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"20%", height:"80%"});
	     		}
			});
		});
		</script>

</body>
</html>