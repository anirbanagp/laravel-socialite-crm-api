@include('layout.header-link')

<!-- header  start  -->

<header id="header">

	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-2">
				<div class="header_logo">
					<a title="MD-Group" href="logo.png"><img src="{{ asset('frontend/images/logo.png') }}" class="img-fluid"></a>
				</div>
			</div>
			<div class="col-lg-8 col-md-8">
				<div class="nav_list">
					<ul class="float-right">
						<li class="nav_item"><a href="#">Summary</a></li>
						<li class="active nav_item"><a href="#">Public profile</a></li>
						<li class="nav_item"><a href="#">Configuration</a></li>
						<li class="nav_item"><a href="#">Maximum limit</a></li>
						<li class="nav_item"><a href="#">Quote requests</a></li>
						<li class="nav_item"><a href="#">Assistance</a></li>
						<li class="dropdown nav_item">
							  <a href="#" data-toggle="dropdown">Language
							  	 <img src="{{ asset('frontend/images/down-arrow.png') }}">
							  </a>
							  <ul class="dropdown-menu language_drop">
							    <li><a href="#"> <img src="{{ asset('frontend/images/it.png') }}"> Italian</a></li>
							    <li><a href="#">  <img src="{{ asset('frontend/images/en.png') }}"> English</a></li>
							  </ul>
						</li>
					</ul>
				</div>
			</div>
			@if(Session::get('user_details') !== null)
			<div class="col-lg-2 col-md-2">
				<div class="user_view">
					<span class="user_img"><img src="{{ asset(Session::get('user_details')['profile_image']) }}"></span>
					<span class="user_name">{{ Session::get('user_details')['name'] }}</span>
					<a href="javascript:void(0);" class="s_sidebar"><img width="22px" src="{{ asset('frontend/images/menu.svg') }}"></a>
				</div>
			</div>
			@endif
		</div>
	</div>

</header><!-- /header -->

@include('layout.side-bar')
