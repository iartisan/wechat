@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

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
							<li class="active">客户管理</li>
						</ul>
@stop
@section('content')
<p align=center>客户总量:<span style="color:red;">{{{$ClientsCount}}}</span>客户点赞数:<span style="color:red;">{{{$ClientsCount}}}</span>客户点单数:<span style="color:red;">{{{$OrdersCount}}}</span></p>
	<table id="blogs" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-1">微信昵称</th>
				<th class="col-md-1">姓名</th>
				<th class="col-md-1">手机号码</th>
				<th class="col-md-1">收货地址</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
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
				"bSort":false,
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/clients/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});
	</script>
@stop
