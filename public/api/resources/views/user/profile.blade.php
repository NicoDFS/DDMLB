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
			<li class="active">Edit Profile</li>
		</ol>
	</section>
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Profile</h3>
		</div>
		<!-- /.box-header -->
		@include('layouts.message')
		<section class="content"> 
			<form role="form" action="{{route('user.profile')}}" method="post"  enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<div class="box-body">
				
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label>Name </label>
						<div class="row">
							<div class="col-xs-6">
								<input name="name" type="text" value="{{ $AppUser->name }}" class="form-control" placeholder="Enter app name">
							</div>
						</div>
						@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</div>
					
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						 <label>Email</label>
						<div class="row">
							<div class="col-xs-6">
								<input name="email" value="{{ $AppUser->email }}" type="text"  class="form-control" disabled>
							</div>						
						</div>						 
					</div>
					
						
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label>Password </label>
						<div class="row">
							<div class="col-xs-6">
								<input name="password" type="password" class="form-control" >
							</div>
						</div>
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
					
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label>Confirm Password </label>
						<div class="row">
							<div class="col-xs-6">
								<input name="password_confirmation" type="password"  class="form-control" >
							</div>
						</div>
					</div>
					<div class="form-group">
							<div class="row">
								<div class="col-xs-6">
									@php 
									$path = '/assets/Apps/'.Auth::guard('appuser')->user()->id.'/profile/'.Auth::guard('appuser')->user()->profile_image 
									@endphp
									<span class="info-box-icon2 ">
										@if(Auth::guard('appuser')->user()->profile_image) 
										<img src="/public/timthumb.php?src={{ URL::asset($path) }}&h=160&w=160&q=90" class="img-circle" width="80px"alt="User image">
										@else
										 <img src="/public/timthumb.php?src={{ URL::asset($path) }}&h=160&w=160&q=90" class="img-circle" alt="User image">
										@endif
									</span>
								</div>
							</div>
						</div> 	
					<div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
						<label>Profile Image</label>
							<div class="row">
								<div class="col-xs-6">
									<input name="profile_image" type="file"  class="form-control" value="{{ old('profile_image') }}" >
								</div>
							</div>
						@if ($errors->has('profile_image'))
						<span class="help-block">
						  <strong>{{ $errors->first('profile_image') }}</strong>
						</span>
						@endif
					</div>	
				
				</div>
					  <!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</section>         
	</div>
 
@endsection
