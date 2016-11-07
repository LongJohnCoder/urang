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
					  		<tr>
						    	<td style="width:20%">{{$notification->author}}</td>
						    	<td style="width:80%" id="des_{{$notification->id}}"><a href="{{route('getShowMail' , base64_encode($notification->id))}}">{{$notification->description}}</a></td>
						    </tr>
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