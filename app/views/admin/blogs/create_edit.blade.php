@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">详情</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Blog Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($foods)){{ URL::to('admin/blogs/' . $foods->id . '/edit') }}@endif" enctype="multipart/form-data" >
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- Post Title -->
				<div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="title">名称</label>
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
						<label class="control-label" for="title">类型</label>
                        <select class="form-control" name="type">
                          @foreach($styles as $s)
                          <option value="{{{$s->name}}}" @if (isset($foods) && $foods->type==$s->name) selected='selected' @endif>{{{$s->name}}}</option>
						  @endforeach
						</select>
					</div>
				</div>

				<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">价格</label>
						<input class="form-control" type="text" name="price" id="title" value="{{{ isset($foods) ? $foods->price : null }}}" />
					</div>
				</div>

				<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">详情介绍</label>
						<textarea class="form-control" type="text" name="content" id="title" value="{{{ isset($foods) ? $foods->content : null }}}" rows="5">{{{ isset($foods) ? $foods->content : null }}}</textarea>
					</div>
				</div>
					
				<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">会员折扣(请输入1-10之间的数字。如:9.5代表九五折)</label>
						<input class="form-control" type="text" name="rebate" id="title" value="{{{ isset($foods) ? ($foods->rebate)/10 : null }}}" />
					</div>
				</div>

				<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
					<div class="col-md-12">
						 <label class="control-label" for="title">状态</label>
                        <select class="form-control" name="status">
						  <option>上架</option>
						  <option>下架</option>
						</select>
					</div>
				</div>

				<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="title">标签</label>
                        <input class="form-control" type="text" name="tag" id="title" value="{{{ isset($foods) ? $foods->tag :null}}}" />
					</div>
				</div>

				<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="title">所需时间</label>
                        <input class="form-control" type="text" name="times" id="title" value="{{{ isset($foods) ? $foods->times :null}}}" />
					</div>
				</div>
				<!-- ./ content -->
			</div>
			<!-- ./ general tab -->

			<!-- Meta Data tab -->
			<!-- ./ meta data tab -->
		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<element class="btn-cancel close_popup">取消</element>
				<button type="reset" class="btn btn-default">重置</button>
				<button type="submit" class="btn btn-success">更新</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop
