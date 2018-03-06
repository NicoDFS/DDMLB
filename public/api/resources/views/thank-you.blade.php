@extends('welcome')

@section('content')
<div style="margin-top:10px;">
<div class="container">
	<div class="jumbotron text-xs-center">
  <h1 class="display-3">Thank You!</h1>
  <p class="lead"><strong>Registration successfully</strong> Login for complete your account setup.</p>
  <hr>
  <p>
    Having trouble? <a href="mailto:support@draftdaily.com">Contact us</a>
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="{{route('user.login')}}" role="button">Continue to Login</a>
  </p>
</div>
</div>
</div>
<script type="text/javascript">
var timer = 3; //seconds
 function delayer() {
 window.location = '/user/login';
}
setTimeout('delayer()', 1000 * timer); 
</script>
@endsection
