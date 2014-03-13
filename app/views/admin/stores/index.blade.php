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
							<li class="active">门店管理</li>
						</ul>
@stop
@section('content')
	
	<table id="blogs" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-1">名称</th>
				<th class="col-md-1">地址</th>
				<th class="col-md-1">电话</th>
				<th class="col-md-1">触发关键字</th>
				<th class="col-md-1">标签</th>
				<th class="col-md-1">地理坐标经度</th>
				<th class="col-md-1">地理坐标纬度</th>
				<th class="col-md-1">图片</th>
				<th class="col-md-1">操作</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	@if ($count==0)<a href="{{{ URL::to('admin/stores/create') }}}" class="btn btn-small btn-info iframe"><span class='glyphicon glyphicon-plus-sign'></span> 创建</a> @endif
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
		        "sAjaxSource": "{{ URL::to('admin/stores/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});
	</script>
@stop