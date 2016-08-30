@extends('pages.layouts.master-black')
@section('content')
	 <div class="login-page">
        @if(Session::has('fail'))
          <div class="alert alert-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> {{Session::get('fail')}}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          </div>
        @else
        @endif
        @if(Session::has('success'))
          <div class="alert alert-success">                               {{Session::get('success')}}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          </div>
        @else
        @endif
          <div class="form">
            <!--<form class="register-form" role="form" method="post" action="register.php">
              <input type="text" placeholder="name"/>
              <input type="password" placeholder="password"/>
              <input type="text" placeholder="email address"/>
              <button>create</button>
              <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>-->
            <form class="login-form" role="form" action="{{route('postForgotPassword')}}" method="post">
            	<label for="forgot_pass_user_email">Email</label>
               <input type="email"  id="forgot_pass_user_email" name="forgot_pass_user_email" placeholder="your email" required="">
              <button type="submit">Submit</button>
              <input type="hidden" name="_token" value="{{Session::token()}}"></input>
            </form>
          </div>
        </div>
      </div>
@endsection