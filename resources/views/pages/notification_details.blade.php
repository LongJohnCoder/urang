@extends('pages.layouts.user-master')
@section('content')
	<style type="text/css">
		i {
			color: #ff6400;
		}
		img {
			height: 35px;
		}
		#order_id {
			margin-top: -25px;
		}
		body {
			overflow: hidden;
		}
	</style>
	<div class="main-content neighbour">
		<div class="row">
			<div class="container">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label><i class="fa fa-bell" aria-hidden="true"></i></label> Notification from Admin 
					<hr>
				</div>
			</div>
			<div class="container">
				<div class="col-md-1 col-sm-1 col-xs-1">
					<img src="{{url('/')}}/public/new/img/user.png" alt="admin image default">
				</div>
				<div class="col-md-11 col-sm-11 col-xs-11">
					{{"<". $getDetails->author .">"}}
					<span></span>
					<p>To, {{$getDetails->user->email}}</p>
					<p id="order_id">For pickup request ID : {{$getDetails->pick_up_req_id}}</p>
				</div>
			</div>
			<div class="container">
				<div class="col-md-12 col-sm-12 col-xs-12">
					{{$getDetails->description}}
				</div>
			</div>
		</div>
	</div>
@endsection