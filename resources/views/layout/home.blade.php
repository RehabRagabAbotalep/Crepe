@extends('layout.master')
@section('title')
	Crep&Waffle
@endsection


@section('content')

	<div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
       <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <a class="facebook" href="{{route('facebook.login')}}">
                    <i class="fab fa-facebook fa-2x"></i>
                    COTINUE WITH FACEBOOK
                </a>
                <span>OR</span>
                <form action="{{route('login')}}" method="POST">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                    
                        {{ csrf_field() }}

                  <div class="form-group">
                    <input type="text" class="form-control" name="login" placeholder="Email Or PhoneNumber">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <span><a href="{{route('forgetPassword')}}">Forget Password?</a></span>
                  <div class="form-group">
                    <input type="submit" class="login" name="submit" value="Login">
                  </div>
                </form>
                <span>Dont have an account?<a href="{{route('signUp')}}">Create an Account</a></span>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->


        <!-- Slider -->
    	<div id="myCarousel" class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="" contenteditable="false"></li>
            <li data-target="#myCarousel" data-slide-to="1" class="active" contenteditable="false"></li>
            <li data-target="#myCarousel" data-slide-to="2" class="" contenteditable="false"></li>
            <li data-target="#myCarousel" data-slide-to="3" class="" contenteditable="false"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item" style="">
                <img src="images/crep13.jpg" alt="" class="">
                
            </div>
            <div class="item active">
                <img src="images/crep12.jpg" alt="" class="">
                
            </div>
            <div class="item" style="">
                <img src="images/crep14.jpg" alt="" class="">
            </div>

            <div class="item" style="">
                <img src="images/crep2.jpg" alt="" class="">
            </div>
        </div>    

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>

        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
    <!-- Slider -->

    <!-- Content -->
    <div class="content">
        <h1>Most Orderd</h1>
        <div class="image">
            <img src="images/crep11.jpg">
        </div>
        <div class="image">
            <img src="images/crep3.png">
        </div>
        <div class="image">
            <img src="images/crep4.png">
        </div>
        <div class="image">
            <img src="images/crep6.png">
        </div>
        <div class="image">
            <img src="images/crep7.png">
        </div>
        <div class="image">
            <img src="images/crep8.jpg">
        </div>

    </div>
     <!-- Content -->
</div>
	
@endsection
@section('scripts')
	<script type="text/javascript">
		  $('#myCarousel').carousel();
    var winWidth = $(window).innerWidth();
    $(window).resize(function () {

        if ($(window).innerWidth() < winWidth) {
            $('.carousel-inner>.item>img').css({
                'min-width': winWidth, 'width': winWidth
            });
        }
        else {
            winWidth = $(window).innerWidth();
            $('.carousel-inner>.item>img').css({
                'min-width': '', 'width': ''
            });
        }
    });
	</script>
@endsection
