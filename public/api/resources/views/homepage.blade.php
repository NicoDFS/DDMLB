@extends('welcome')

@section('content')
<style>
	.cen-img {
    position: absolute;
    width: 394px;
    height: 136px;
    top: 50%;
    left: 50%;
    margin-left: -197px;
    margin-top: -68px;
	text-align: center;
}
  
  </style>
<div class="cen-img"><img src="{{ URL::asset('public/images/logo.png') }}" alt="User Image" style="width: 85%;margin: 0 auto;">
<h3><p style="color:white;">DraftDaily And DFSCoin API Documentation.</p></h3>
</div>


@endsection