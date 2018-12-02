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
					<p>{{ __('label.Remember Password?') }} <a href="{{ route('auth.login') }}">{{ __('label.Log in') }}</a></p>
		 		</div>
				@include('layout.error-info')
				@include('layout.session-info')
		 		<form class="user_form" method="POST" action="{{ route('auth.postResetPassword') }}">
					{{ csrf_field() }}
		 			<div class="form-group">
		 				<input type="password" name="password" placeholder="{{ __('label.New Password') }}" class="form-control"  />
		 			</div>
		 			<div class="form-group">
		 				<input type="password" name="confirm_password" placeholder="{{ __('label.Confirm Password') }}"  class="form-control" />
		 			</div>
		 			<button class="sign_submit" type="submit">{{ __('label.Update') }}</button>
		 		</form>
		 	</div>

		 	<div class="col-md-12"></div>

		 </div>
	</div>
</div>
<!-- login content end -->

@push('script')
	<script type="text/javascript">
	$('.forget_password_button').click(function() {
		$.confirm({
			title: '{{__('label.Forgot your password?')}}',
			type: 'blue',
			theme:'material',
			content: '' +
			'<form action="" class="formName">' +
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
