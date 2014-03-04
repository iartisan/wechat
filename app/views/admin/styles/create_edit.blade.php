@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">详情</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Blog Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($styles)){{ URL::to('admin/types/' . $styles->id . '/edit') }}@endif" enctype="multipart/form-data" >
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
						<input class="form-control" type="text" name="type_name" id="title" value="{{{ isset($styles) ? $styles->name:null }}}" />
					</div>
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
