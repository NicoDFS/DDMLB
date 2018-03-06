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
			<li class="active">{{ucfirst($Apps->app_name)}}</li>
		  </ol>
	</section>
    <div class="box">
           <div class="box-header with-border">
              <h3 class="box-title">Edit {{ucfirst($Apps->app_name)}} App</h3>
            </div>
            <!-- /.box-header -->
           @include('layouts.message')
		<section class="content"> 
			<form role="form" action="{{route('EditApp',$Apps->id)}}" method="post"  enctype="multipart/form-data">
					  {{ csrf_field() }}
				<div class="box-body">
					<div class="form-group">
						<div class="row">
						    <div class="col-md-12 col-xs-12">
							<div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
								<label>App Name </label>
								<div class="row">
									<input name="name" type="text" value="{{ $Apps->app_name }}" class="form-control" placeholder="Enter app name">
								</div>
								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
							<div class="col-md-6 {{ $errors->has('appId') ? ' has-error' : '' }}">
							    <div class="col-md-12 col-xs-12">
							        <label>App Id</label>
    								<div class="row">
    								<div class="col-xs-4 col-md-4">
    									<span id="newAppId">{{ $Apps->appId }}</span>
    								</div>
    								<div class="col-xs-3 col-md-3">
    								    <button type="button" appId="{{ $Apps->id }}" id="generate" class="btn btn-primary">Generate New</button>
    								</div>
    								<div class="col-xs-5 col-md-5">
    								    <span id="message-box" style="display:none;" class="help-block">
    									    <strong id="message"></strong>
    								    </span>
    								</div>
    								</div>
							    </div>
							</div>
							</div>
						</div>
					</div>
					<div class="{{ $errors->has('domain_name') ? ' has-error' : '' }}">
						 <label>Domain Name</label>
						<div class="row">
							<div class="col-xs-6">
								<input name="domain_name" value="{{ $Apps->domain_name }}" type="text"  class="form-control"   placeholder="Enter domain name">
							</div>
						
						</div>
						  @if ($errors->has('domain_name'))
						<span class="help-block">
							<strong>{{ $errors->first('domain_name') }}</strong>
						 </span>
						  @endif
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-xs-6">
								@php 
									$path = '/assets/Apps/'.Auth::guard('appuser')->user()->id.'/'.$Apps->id.'/'.$Apps->app_logo 
								@endphp
								<span class="info-box-icon2 ">
									@if($Apps->app_logo)
									<img src="/public/timthumb.php?src={{ URL::asset($path) }}&w=80&q=90" class="" alt="App image">
									@else
									 <img src="/public/timthumb.php?src={{ URL::asset('public/images/No-Image-Basic.png') }}&w=80&q=90" class="img-circle" alt="App image">
									@endif
								</span>
							</div>
						</div>
							
					</div>
						
					<div class="form-group{{ $errors->has('app_logo') ? ' has-error' : '' }}">
						<label>Logo</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="app_logo" type="file"  class="form-control" value="{{ old('app_logo') }}" >
								</div>
							</div>
							@if ($errors->has('app_logo'))
							<span class="help-block">
							  <strong>{{ $errors->first('app_logo') }}</strong>
							</span>
							@endif
					</div>
						
					<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
						<label>Description</label>
							<div class="row">
								<div class="col-xs-6">
									<textarea id="editor1" name="description" placeholder="Enter description"  rows="10" cols="80" >{{ $Apps->app_desc }}</textarea>
								</div>
							
							</div>
							@if ($errors->has('description'))
								<span class="help-block">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
							@endif
					 </div>
				</div>
					  <!-- /.box-body -->

					  <div class="box-footer">
						<button type="submit" class="btn btn-primary">Update</button>
					  </div>
			</form>
		</section>
            

  </div>
  <script>
$(document).ready(function(){
    $('#generate').click(function() {
        var appId = $(this).attr('appId');
        $.ajax({
			type:'POST',
			data: {"_token": $('meta[name="csrf-token"]').attr('content'),"id": appId},
			url:'/user/change-appId',
			success:function(data){
				var obj = JSON.parse(data);
				$('#newAppId').html(obj.appId);
				$('#message').html('AppId changed successfully.');
				$('#message').css('color','green');
				$('#message-box').show();				
				setTimeout(function() {$("#message-box").hide('blind', {}, 500)}, 3000);
			}
		});
    });
});
</script>
 
@endsection
