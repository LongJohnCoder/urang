@extends('pages.layouts.user-master')
@section('content')
<style type="text/css">
	td {
		cursor: pointer;
	}
</style>
<div class="main-content neighbour">
    <div class="container">
      <div class="row">
        <div class="col-md-8 dashboard">
            <h2 > Notifications </h2>
            <!-- <div class="dash-section">
              <h3>New Pick-Up</h3>
              <p><a href="{{route('getPickUpReq')}}"></span><i class="fa fa-share" aria-hidden="true"></i> Schedule Pick-Up </a></p>
            </div> -->
            <div class="clear50"></div>
            <div class="dash-section">
              <table class="table table-bordered table-striped ">
				  <thead></thead>
				  <tbody>
				  	@if(count($find_notification) > 0)
				  		@foreach($find_notification as $notification)
				  			@if($notification->is_read == 0)
						  		<tr style="background-color: #C0C0C0;">
							    	<td style="width:30%"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$notification->author}}</td>
							    	<!--unread-->
							    	@if(strlen($notification->description) >= 100)
							    		<td style="width:70%" id="des_{{$notification->id}}"><a href="{{route('getShowMail' , base64_encode($notification->id))}}">{{substr($notification->description, 0, 100)}}....<u>view more..</u></a></td>
							    	@else
							    		<td style="width:70%" id="des_{{$notification->id}}"><a href="{{route('getShowMail' , base64_encode($notification->id))}}">{{$notification->description, 0, 100}}</a></td>
							    	@endif
							    </tr>
							    @else
							    	<tr>
								    	<td style="width:30%"><i class="fa fa-inbox" aria-hidden="true"></i> {{$notification->author}}</td>
								    	<!--read-->
								    	@if(strlen($notification->description) >= 100)
								    		<td style="width:70%" id="des_{{$notification->id}}"><a href="{{route('getShowMail' , base64_encode($notification->id))}}">{{substr($notification->description, 0, 100)}}.....<u>view more..</u></a></td>
								    	@else
								    		<td style="width:70%" id="des_{{$notification->id}}"><a href="{{route('getShowMail' , base64_encode($notification->id))}}">{{$notification->description, 0, 100}}</a></td>
								    	@endif
								    </tr>
							    @endif
						@endforeach
				  	@else
				  		<tr><td>No Data</td></tr>
				  	@endif
				   </tbody>
				</table>
				<span style="float: right;">{!!$find_notification->render()!!}</span>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
