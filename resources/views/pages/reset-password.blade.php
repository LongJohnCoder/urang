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
        @if($errors)
          @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{ $error }}</li>
            </div>
          @endforeach
        @endif
          <div class="form">
            <!--<form class="register-form" role="form" method="post" action="register.php">
              <input type="text" placeholder="name"/>
              <input type="password" placeholder="password"/>
              <input type="text" placeholder="email address"/>
              <button>create</button>
              <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>-->
            <form class="login-form" role="form" action="{{route('postResetPassword')}}" method="post" onsubmit="return matchPassword();">
               <input type="password"  id="new_password" name="new_password" placeholder="new password" required="" onkeyup="return matchPassword();">
               <input type="password"  id="conf_new_password" name="conf_new_password" placeholder="confirm new password" required="" onkeyup="return matchPassword();">
               <div id="pass_status"></div>
              <button type="submit">Submit</button>
              <input type="hidden" name="_token" value="{{Session::token()}}"></input>
              <input type="hidden" name="user_id" value="{{$reset_id}}"></input>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        function matchPassword() {
          var password = $('#new_password').val();
          var conf_password = $('#conf_new_password').val();
          if (password.length >=  6) 
          {
            if (password == conf_password) 
            {
              $('#pass_status').html('<p style="color: green;">password and confirm password is matched!</p>');
              return true;
            }
            else
            {
              $('#pass_status').html('<p style="color: red;">password and confirm password should be same and atleast 6 charecter!</p>');
              return false;
            }
          }
          else
          {
            $('#pass_status').html('<p style="color: red;">password should be atleast 6 charecter!</p>');
              return false;
          }
        }
      </script>
@endsection