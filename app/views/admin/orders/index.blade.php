@extends('admin.layouts.default')

{{-- Web site Title --}}

@section('keywords')Blogs administration @stop
@section('author')Laravel 4 Bootstrap Starter SIte @stop
@section('description')Blogs administration index @stop

{{-- Content --}}
@section('breadcrumbs')
<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="#">主页</a>
							</li>
							<li class="active">订单管理</li>
						</ul>
@stop
@section('content')
	
	
	<table id="blogs" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-1">订单号</th>
				<th class="col-md-1">下单时间</th>
				<th class="col-md-1">顾客名</th>
				<th class="col-md-1">地址名</th>
				<th class="col-md-1">菜单</th>
				<th class="col-md-1">费用</th>
				<th class="col-md-1">手机号码</th>
				<th class="col-md-1">支付状态</th>
				<th class="col-md-1">备注</th>
				<th class="col-md-1">详情</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<button type="button" class="btn btn-info"><a href="../export.php" target="_blank">导出为excel</a></button>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#blogs').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_",
					"sInfo":"",
					"oPaginate": {
							"sPrevious":"上一页",
					        "sNext": "下一页"
			         },
			         "sSearch":"搜索"

				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/orders/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"50%", height:"50%"});
	     		}
			});
		});
	</script>
@stop