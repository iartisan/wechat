@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Blogs administration @stop
@section('author')Laravel 4 Bootstrap Starter SIte @stop
@section('description')Blogs administration index @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			门店管理
			<div class="pull-right">
				<a href="{{{ URL::to('admin/stores/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> 创建</a>
			</div>
		</h3>
	</div>

	<div class="tab-content">
		<!-- General tab -->
		<div class="table table-striped" id="tab-general">
			<!-- Post Title -->
			<div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="title">名称</label>
					<input class="form-control" type="text" name="food_name" id="title" value="{{{ isset($foods) ? $foods->name:null }}}" />
				</div>
			</div>
		</div>
		<div class="tab-pane active" id="tab-general">
			<!-- Post Title -->
			<div class="form-group">
                <div class="col-md-12">
                    <label class="control-label" for="title">地址</label>
					<input class="form-control" type="text" name="food_name" id="title" value="{{{ isset($foods) ? $foods->name:null }}}" />
				</div>
			</div>
		</div>
		<div class="tab-pane active" id="tab-general">
			<!-- Post Title -->
			<div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="title">电话</label>
					<input class="form-control" type="text" name="food_name" id="title" value="{{{ isset($foods) ? $foods->name:null }}}" />
				</div>
			</div>
		
			<div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
				<div class="col-md-12">
	                <label class="control-label" for="content">图片上传</label>
				    <input class="form-control" type="file"  name="photo" id="photo" value="{{{ Input::old('pic1_url', isset($foods) ? $foods->pic : null ) }}}" />
				</div>
			</div>
			<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
				<div class="col-md-12">
					<label class="control-label" for="title">店面介绍</label>
	                <textarea class="form-control" type="text" name="tag" id="title" value="{{{ isset($foods) ? $foods->tag :null}}}" rows="5" ></textarea>
				</div>
			</div>
			<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
				<div class="col-md-12">
					<label class="control-label" for="title">触发关键字</label>
	                <input class="form-control" type="text" name="tag" id="title" value="{{{ isset($foods) ? $foods->tag :null}}}" />
				</div>
			</div>
		</div>
		<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
				<div class="col-md-12">
					<label class="control-label" for="title"><h4>地图信息</h4></label>
				</div>
		</div>
		<div class="form-inline" role="form">
		  <div class="form-group">
		    <label class="sr-only" for="exampleInputEmail2">输入地址</label>
		    <input type="email" id="city" class="form-control" id="exampleInputEmail2" placeholder="输入地址">
		  </div>
		  <button type="button" onclick="Doit()"  class="btn btn-default">搜索</button>
		</div>
		<div id="allmap" style="width:100%;height:500px;margin-top:10px;"></div>
		<input type=text value="" id="pointer_x" /> <input type=text value="" id="pointer_y" /><br />
	</div>
@stop

{{-- Scripts --}}
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6d31121ec9e0aac87d46eb2f7074950f"></script>
@section('scripts')
	<script type="text/javascript">
		var map = new BMap.Map("allmap");
		var point = new BMap.Point(116.331398,39.897445);
		map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
		map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}));  //
		map.centerAndZoom(point,12);
		map.enableScrollWheelZoom(true);
		function Doit()
		{
			var city=document.getElementById("city").value;
			var myGeo = new BMap.Geocoder();
			document.getElementById("pointer_x").value= point.lng;  //获取marker的位置
			document.getElementById("pointer_y").value=point.lat;
			point.lng , point.lat
			myGeo.getPoint(city, function(point){
			  if (point) {
			  	marker1 = new BMap.Marker(new BMap.Point(point.lng , point.lat));
			    map.centerAndZoom(point, 20);
			    marker1.enableDragging(); 
			    map.addOverlay(marker1);
			    marker1.addEventListener("mouseup",function(e){
				var p = marker1.getPosition();    
				document.getElementById("pointer_x").value= p.lng;  //获取marker的位置
				document.getElementById("pointer_y").value=p.lat;
				});
			  }
			}, "北京市");
		}
		var oTable;
		$(document).ready(function() {
			oTable = $('#blogs').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/blogs/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});
	</script>
@stop