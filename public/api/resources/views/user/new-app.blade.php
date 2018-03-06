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
			<li class="active">Add New App</li>
		</ol>
	</section>
<div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title">Add New App</h3>
	</div>
		<!-- /.box-header -->
	@include('layouts.message')
	<section class="content"> 
		<form role="form" action="{{route('PostAppNew')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="box-body">
				<div class="form-group{{ $errors->has('app_name') ? ' has-error' : '' }}">
					<label>App Name </label>
						<div class="row">
							<div class="col-xs-6">
								<input name="app_name" type="text" value="{{ old('app_name') }}" class="form-control" placeholder="Enter app name">
							</div>
						</div>
						  @if ($errors->has('app_name'))
						<span class="help-block">
							  <strong>{{ $errors->first('app_name') }}</strong>
						</span>
						  @endif
				</div>
				<div class="form-group{{ $errors->has('domain_name') ? ' has-error' : '' }}">
					<label>Domain Name</label>
						<div class="row">
							<div class="col-xs-6">
								<input name="domain_name" value="{{ old('domain_name') }}" type="text"  class="form-control"   placeholder="Enter domain name">
							</div>
						
						</div>
						  @if ($errors->has('domain_name'))
						<span class="help-block">
							<strong>{{ $errors->first('domain_name') }}</strong>
						</span>
						  @endif
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
							<textarea id="editor1" name="description" rows="10" cols="80">{{{ old('description') }}}</textarea>   
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
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
		</form>
	</section>
		

</div>

@endsection
