@extends($login_check !=null ? 'pages.layouts.user-master' : 'pages.layouts.master')
@section('content')
<style type="text/css">
    label.error { color: red; }
    input.error{ border-bottom: 1px solid red; margin-bottom: 4%;}
    textarea.error {border-bottom: 1px solid red;}
</style>
	<section class="top-header countact-us-header with-bottom-effect transparent-effect dark dark-strong">
            <div class="bottom-effect"></div>
            <div class="header-container">	
                <div class="header-title">
                    <div class="header-icon"><span class="icon icon-Wheelbarrow"></span></div>
                    <div class="title">contact us</div>
                    <em>U-Rang, We Answer</em>
                </div>
            </div><!--container-->
        </section>  

        <section class="countact-us-section contact-us-reverse-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="contact-block">

                                    <div class="contact-block-heading">
                                        <h3>keep in touch</h3>
                                    </div>
                                    <div class="row contacts-list">
                                        <div class="col-md-12 clearfix">
                                            <div class="type-info pull-left">
                                                <i class="icon icon-House"></i>
                                                address
                                            </div>
                                            <div class="info pull-right text-right">
                                                <p class="no-margin">15 Broad Steet New York, NY 10005</p>
                                                <p class="no-margin">355 E 23rd Street New York, NY 10010</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 clearfix">
                                            <div class="type-info pull-left">
                                                <i class="icon icon-Phone2"></i>
                                                phone
                                            </div>
                                            <div class="info pull-right text-right">
                                                <p class="no-margin">(646)902-5326</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 clearfix">
                                            <div class="type-info pull-left">
                                                <i class="icon icon-Mail"></i>
                                                email
                                            </div>
                                            <div class="info pull-right text-right">
                                                <p class="no-margin"><a href="mailto:lisa@u-rang.com" style="text-decoration: underline;">lisa@u-rang.com</a></p>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12 clearfix">
                                            <div class="type-info pull-left">
                                                <i class="icon icon-Mouse"></i>
                                                Skype Chat
                                            </div>
                                            <div class="info pull-right text-right">
                                                <p class="no-margin">u-rang</p>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7 col-md-offset-1 col-sm-6">
                        <div class="contact-form">
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
                            <div class="form-heading">
                                <h5>send a message</h5>
                            </div>
                            <form method="post" action="{{ route('postContactForm') }}" name="contact-form" id="contact-form">
                                <div id="response"></div>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="firstName" id="firstName"  placeholder="FIRST NAME" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="lastName" id="lastName" placeholder="LAST NAME" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="phone" id="phone" placeholder="PHONE NO." class="form-control" required/>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" required id="email" placeholder="EMAIL" class="form-control" required/>
                                        </div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="subject" required id="subject" placeholder="SUBJECT" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" placeholder="YOUR QUERY" required="true"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group"> 
                                            <button type="submit" class="btn btn-default">send message</button>
                                        </div>
                                        <input type="hidden" name="_token" value="{{Session::token()}}">
                                    </div> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="socials-list">
                            <div class="row">
                                <div class="col-md-2 col-sm-4">
                                    <a href="#" class="social-item facebook-item">facebook</a>
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <a href="#" class="social-item twitter-item">twitter</a>
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <a href="#" class="social-item google-plus-item">google +</a>
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <a href="#" class="social-item linkedin-item">linkedin</a>
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <a href="#" class="social-item pinterest-item">pinterest</a>
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <a href="#" class="social-item behance-item">behance</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="{{url('/')}}/public/new/vendor/jq-validation/jquery.validate.min.js"></script>
        <script src="{{url('/')}}/public/new/vendor/jq-validation/additional-methods.min.js"></script>
        <script>
            $( "#contact-form" ).validate({
              rules: {
                firstName: {
                    required : true
                },
                lastName : {
                    required : true
                },
                phone: {
                  required: true,
                  phoneUS: true
                },
                email: {
                    required: true,
                    email: true
                }

              },
              messages: {
                    firstName: '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please enter your first name !',
                    lastName: '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please enter your last name !',
                    phone: '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please enter a valid phone number !',
                    email: '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please enter a valid email address !',
                    subject: '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please give a valid subject line !',
                    message: '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please enter a valid message this is a required field !'
                }
            });
        </script>
@endsection