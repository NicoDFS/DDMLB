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
      </ol>
    </section>
      <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Mr. {{ucfirst(Auth::guard('appuser')->user()->name)}}'s App List</h3>
            </div>
            <!-- /.box-header -->
			<div>
				<div style='display:none;' class="ajax_msg alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Success!</h4>					  
						 <p>App has been deleted successfully. </p> 
				</div>
			</div>
			@include('layouts.message')
            <div class="box-body table-responsive no-padding">
              
                @if(count($applications) > 0)
                @foreach($applications as $Apps)
                @php 
                $path = '/assets/Apps/'.Auth::guard('appuser')->user()->id.'/'.$Apps->id.'/'.$Apps->app_logo 
                    @endphp
                <div class="col-md-3 col-sm-6 col-xs-12" id="box_{{$Apps->id}}">
                    <div class="overEffect">
                        <a href="#" class="product-image">
                          <div class="info-box1">
								<span class="info-box-icon2 ">
									@if($Apps->app_logo)
										<img src="/public/timthumb.php?src={{ URL::asset($path) }}&w=80&q=90" class="" alt="App image">
									@else
									  <img src="/public/timthumb.php?src={{ URL::asset('public/images/No-Image-Basic.png') }}&w=80&q=90" class="img-circle" alt="App image">
									@endif
								</span>
                
                            <div class="info-box-content">
                              <span class="info-box-number">{{ucfirst($Apps->app_name)}}</span>
                              <span class="info-box-text">App Id : {{ucfirst($Apps->appId)}}</span>
                              <span class="info-box-text">{{ucfirst($Apps->domain_name)}}</span>
                              
                              <span class="info-box-number">
                                  @if($Apps->status == 1)
                                      <span class="label label-success">Live</span>
                                    @elseif($Apps->status == 2)
                                        <span class="label label-warning">Pending</span>
                					@else
                						<span class="label label-danger">Inactive</span>
                                    @endif
                              </span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                  </a>  
						<div class="action">
								
								<a href="{{ route('EditApp', ['id' => base64_encode($Apps->id)]) }}" class="ViewApp"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Application!">
								<i class="fa fa-edit"></i></a>
								<!--<span>Add to cart</span>-->
								</button>       
								<a href=" #" class="DeleteApp" data-placement="top" data-title="Are you sure?" title="" rid="{{$Apps->id}}" 
								data-toggle="confirmation" data-original-title="Are you sure to remove?"> <i class="fa fa-trash"></i></a> 
								<!-- fixcode quick view -->
								<a href="{{ route('ViewApp', ['id' => base64_encode($Apps->id)]) }}" class="ViewApp"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Quickview!"> 
								<i class="fa fa-eye"></i></a>								
						</div>
                </div>
                </div>
                @endforeach
                @else
                <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                No record found. Click here to <a href="/user/new-app">Create Application</a>
              </div>
                          <!-- /.info-box -->
                </div>
                @endif
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">             
              
			  {{ $applications->appends(['s' => $params->s,'startdate' =>$params->startdate,'enddate' =>$params->enddate,'status' =>$params->status])->render() }}
            </div>

<script>
$(document).ready(function(){
    $('body').on('confirmed.bs.confirmation', '.DeleteApp', function() {
        var Rcord = $(this).attr('rid');
        $.ajax({
         type:'POST',
         data: {"_token": $('meta[name="csrf-token"]').attr('content'),"id": Rcord},
         url:'/user/delete-app',
         success:function(data){
			$('.ajax_msg').show();
			setTimeout(function() {$(".alert").hide('blind', {}, 500)}, 5000);
            if(data){
                $( "div" ).remove('#box_'+Rcord);
            }else{
                
            }
        }
      });
    });
});
</script>
          </div>
@endsection
