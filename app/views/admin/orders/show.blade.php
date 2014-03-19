

	<html>
		<body>

	
	<table id="blogs" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-1">名称</th>
				<th class="col-md-1">数量</th>
				<th class="col-md-1">价钱</th>
				<th class="col-md-1">折扣</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
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