@if($errors->any()) 
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i> Alert!</h4>
			  {{$errors->first()}}
		</div> 
     @endif

@if(Session::has('alert-success'))

    <div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		 @foreach (['success'] as $msg)			<p>{{ Session::get('alert-' . $msg) }} </p>
			  		@endforeach
	</div>		   @endif
			 
		
   
