@extends('layouts.master')

@section('content')
	<!-- Default box -->
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Applicaiton List</li>
		<li class="active"> {{ucfirst($ApiApps->app_name)}}</li>
      </ol>
	</section>
	@include('layouts.message')
	<div class="box">
		<div class="box-header with-border">
              <h3 class="box-title">{{ucfirst($ApiApps->app_name)}} Details</h3>
            </div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover" id="">
				<thead>
					<tr>
					  <th>Key</th> 
					  <th>Value</th>
					</tr>
				</thead>
				<tbody>
					@if(count($ApiApps) > 0)
						
						<tr>
						  <td>App Name</td>
						  <td>{{$ApiApps->app_name}}</td>			 
						</tr>
						
						<tr>
						  <td>Domain Name</td>
						  <td>{{$ApiApps->domain_name}}</td>			 
						</tr>
						
						<tr>
						  <td>App Id</td>
						  <td>{{$ApiApps->appId}}</td>			 
						</tr>
						<tr>
						  <td>SecretID</td>
						  <td>{{$ApiApps->secretId}}</td>			 
						</tr>
						<tr>
						  <td>Description</td>
						  <td>{!! $ApiApps->app_desc !!}</td>			 
						</tr>
						<tr>
						  <td>Created</td>
						  <td>{{$ApiApps->created_at}}</td>			 
						</tr>
						
						<tr>
							<td>Status</td>
							<td>
								<span class="info-box-number">
								  @if($ApiApps->status == 1)
									  <span class="label label-success">Live</span>
									@elseif($ApiApps->status == 2)
										<span class="label label-warning">Pending</span>
									@else
										<span class="label label-danger">Inactive</span>
									@endif
								</span>
							 </td>		 
						</tr>
						
						<tr>

							<td>App logo</td>
							@php 
								$path = '/assets/Apps/'.Auth::guard('appuser')->user()->id.'/'.$ApiApps->id.'/'.$ApiApps->app_logo 
							@endphp
							<td>
								
								@if($ApiApps->app_logo)
									<img src="/public/timthumb.php?src={{ URL::asset($path) }}&w=80&q=90" class="" alt="App image">
								@else
									 <img src="/public/timthumb.php?src={{ URL::asset('public/images/No-Image-Basic.png') }}&w=80&q=90" class="img-circle" alt="App image">
								@endif
							</td>
						</tr>
					
					@else
						<tr><td colspan="7">No record.</td></tr>
					@endif
					
				</tbody>
		  </table>
		</div>
		<!-- /.box-body -->
	 </div> 

@endsection
