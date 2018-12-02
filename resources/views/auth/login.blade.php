@include('layout.header-link')

<!-- login content strt -->
<div class="body_wrap login_form">
	<div class="container">
		 <div class="row justify-content-center">
		 	<div class="col-lg-4 col-sm-8">

		 		<div class="logo_holder">
		 			<a href="/" title="md-gorup.com">
		 				<img src="{{ asset('frontend/images/logo.png') }}">
		 			</a>
		 		</div>

		 		<div class="sign_info">
		 			<p>{{ __('label.Sign into your account here. New user') }} <a href="{{ route('auth.registration') }}">{{ __('label.sign up') }}</a></p>
		 		</div>
				@include('layout.error-info')
				@include('layout.session-info')
		 		<form class="user_form" method="POST" action="{{ route('auth.postLogin') }}">
					{{ csrf_field() }}
		 			<div class="form-group">
		 				<input type="text" name="email" placeholder="{{ __('label.Enetr Email') }}" class="form-control"  />
		 			</div>
		 			<div class="form-group">
		 				<input type="password" name="password" placeholder="{{ __('label.Enetr Password') }}"  class="form-control" />
		 			</div>
		 			<button class="sign_submit" type="submit">{{ __('label.Log in') }}</button>
		 			<p><a class="forget_password_button" href="javascript:void(0);">{{ __('label.Forgot password?') }}</a></p>
		 		</form>
		 	</div>

		 	<div class="col-md-12"></div>

		 	<div class="col-lg-5 col-sm-10">
		 		<div class="social_button">
		 			<a class="fb" href="#"><img src="{{ asset('frontend/images/fb.png') }}">Sign in with Facebook</a>
					<a class="googel" href="{{ route('auth.redirect','google') }}"><img src="{{ asset('frontend/images/google.png') }}">{{ __('label.Sign in with Google') }}</a>
		 		</div>
		 	</div>
		 </div>
	</div>
</div>
<!-- login content end -->

@push('script')
	<script type="text/javascript">
	$('.forget_password_button').click(function() {
		$.confirm({
			title: '{{__('label.Forgot your password?')}}',
			type: 'green',
			theme:'material',
			content: '' +
			'<form action="javascript:void(0);" class="formName">' +
			'<div class="form-group">' +
			'<input type="text" placeholder="{{__('label.Enter Email')}}" class="send_email form-control" required />' +
			'</div>' +
			'</form>',
			buttons: {
				formSubmit: {
					text: 'Submit',
					btnClass: 'btn-blue',
					action: function () {
						var send_email = this.$content.find('.send_email').val();
						var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
						if(!send_email || !regex.test(send_email)){
							showError('{{__('label.Enter valid Email')}}');
							return false;
						}
					   $.ajax({
				   		headers: {
				   		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   		},
				   		type : 'POST',
						async : false,
				   		data : {'email':send_email},
				      		url  : "{{ route('auth.forgotPassword')}}",
				      		success: function(data){
								if(parseInt(data) < 1){
									showError('{{__('label.Invalid email address. Try again')}}');
								}else {
									showSuccess('{{__('label.An email has been sent to your account!')}}');
								}
				      		}
				      	});
					}
				},
				cancel: function () {
					//close
				},
			},
		});
});
</script>
@endpush

@include('layout.footer-link')
