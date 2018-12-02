<div class="sidebar">
	<div class="sidebar_nav">
		<div class="side_user">
			<img src="{{ asset(Session::get('user_details')['profile_image']) }}">
			<p>{{ Session::get('user_details')['name'] }}</p>
		</div>
		<ul>
			<li><a href="#"><i class="far fa-user"></i> Profile</a></li>
			<li><a href="{{route('user.editProfile')}}"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
			<li class="logout">
			<form action="{{route('auth.logout')}}" method="post">
				{{ csrf_field() }}
				<i class="fas fa-sign-out-alt"></i> <input type="submit" class="" value="{{ __('label.Log Out')}}" />
			</form>
		   </li>

		</ul>
		<div class="close_s">
			<i class="fas fa-times"></i>
		</div>
	</div>
</div>
