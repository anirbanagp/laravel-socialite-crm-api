@include('layout.header-link')

<!-- signup content strt -->

<div class="body_wrap signup_form">
	<div class="container">
		 <div class="row justify-content-center">
		 	<div class="col-lg-4 col-sm-8">

		 		<div class="logo_holder">
                    <a href="/" title="md-gorup.com">
		 				<img src="{{ asset('frontend/images/logo.png') }}">
		 			</a>
		 		</div>

		 		<div class="sign_info">
		 			<p>{{ __('label.Already registered') }} <a href="{{ route('auth.login') }}">{{ __('label.Log in') }}</a></p>
		 		</div>
				@include('layout.error-info')
				@include('layout.session-info')
		 		<form class="user_form" name="registration-form" action="{{ route('auth.postRegistration') }}" method="POST">
					{{ csrf_field() }}
		 			<div class="form-group">
		 				<input type="text" value="{{ old('firstname') }}" name="firstname" placeholder="{{ __('label.First Name') }}" class="form-control"  />
		 			</div>
		 			<div class="form-group">
		 				<input type="text" value="{{ old('lastname') }}" name="lastname" placeholder="{{ __('label.Last Name') }}" class="form-control"  />
		 			</div>
		 			<div class="form-group">
		 				<input type="text" value="{{ old('email') }}" name="email" placeholder="{{ __('label.Email') }}" class="form-control"  />
		 			</div>
		 			<div class="form-group">
		 				<input type="text" value="{{ old('phone_number') }}" name="phone_number" placeholder="Phone No" class="form-control"  />
		 			</div>
		 			<div class="form-group">
		 				<input type="password" name="password" placeholder="{{ __('label.Password') }}"  class="form-control" />
		 			</div>
		 			<div class="form-group sign_check">
		 				<label><input type="checkbox" name="terms" value="1"> <span> {{ __('label.I agree to the') }} <a href="#">{{ __('label.Terms and Conditions') }}</a></span></label>
		 			</div>
		 			<div class="form-group cap">
						{!! Captcha::display(['data-theme' => 'light', 'data-type' => 'audio']) !!}
		 			</div>
		 			<button class="sign_submit" type="submit">{{ __('label.Sign up') }}</button>

		 		</form>
		 	</div>

		 	<div class="col-md-12"></div>

		 	<div class="col-lg-5 col-sm-10">
		 		<div class="social_button">
                    <a class="fb" href="#"><img src="{{ asset('frontend/images/fb.png') }}">{{ __('label.Sign in with Facebook') }}</a>
		 			<a class="googel" href="{{ route('auth.redirect','google') }}"><img src="{{ asset('frontend/images/google.png') }}">{{ __('label.Sign in with Google') }}</a>
		 		</div>
		 	</div>
		 </div>
	</div>
</div>


<!-- signup content end -->

@include('layout.footer-link')
