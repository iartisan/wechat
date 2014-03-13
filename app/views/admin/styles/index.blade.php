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
							<li class="active">分类管理</li>
						</ul>
@stop
@section('content')
	

	<table id="blogs" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-1">名称</th>

				<th class="col-md-1">排序</th>
				<th class="col-md-1">操作</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
		<a href="{{{ URL::to('admin/styles/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> 创建</a>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#blogs').dataTable( {
				"aaSorting": [[ 1, "asc" ]],
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
		        "sAjaxSource": "{{ URL::to('admin/styles/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}

			});
		});
		function bgsenda(cmdname,strparam,funname,showmsg)
		{
			var myobj = false;
			try {
				myobj = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e)
			{
			  try
			  {
				  myobj = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  catch(e2)
			  {
				  myobj = false;
			  }
			}

			if (!myobj && typeof XMLHttpRequest != 'undefined') {
				myobj = new XMLHttpRequest();
			}
				/*myobj.setTimeouts(5000, 5000, 15000, 0);*/
				//myobj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				myobj.open("POST",cmdname,true);
				myobj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				
				myobj.onreadystatechange=function()
				{
		               		if(myobj.readyState==4)
					{
		                   			if(myobj.status==200)
						{
							funname(myobj.responseText);
		                       		}
		                		 }
		           	};
				myobj.send(strparam);
				return;

			
		}
		function up(id,status)
		{
			bgsenda("../type.php","id="+id+"&status="+status+"&type=1",update_ok,"");
		}
		function down(id,status)
		{
			bgsenda("../type.php","id="+id+"&status="+status+"&type=2",update_ok,"");
		}
		function update_ok(text)
		{
			window.location.reload();
		}
	</script>
@stop