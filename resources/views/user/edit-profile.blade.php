@extends('layout.base-layout')

@section('body')
    <div class="profile_edit_wrap">
    	<!-- edit profile information -->
    	<div class="container">
    		<div class="profile_info edit_profile">
    			 <h3>{{ __('label.Edit your personal Information') }}</h3>
              	 <hr/>
              	 <div class="edit_body">
                     <form class="edit-profile" enctype="multipart/form-data" action="{{ route('user.updateProfile') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row justify-content-center">
        	               <div class=" col-lg-3 col-lg-3 col-md-5 col-sm-12">
        	                  <div class="form-group p_upload">

        	                          <!-- user upload -->
        	                          <span class="profile_avatar">
        	                            <img class="img-fluid profile-image-thumb" src="{{ $user->userProfile->image }}">
        	                          </span>
        	                        <span>
        	                          <label class="file-upload btn ">
        	                              <img width="20px" src="{{ asset('frontend/images/up.svg') }}">
        	                              {{ __('label.Upload') }}
        	                              <input name="image" id="image-upload" value="{{ old('image') }}"type="file" />
        	                          </label>
        	                        </span>
        	                  </div>
        	               </div>
        	             </div>
        	            <div class="row">
        	               <div class="col-md-4">
        	                 <div class="form-group">
        	                    <label>{{ __('label.First name') }}</label>
        	                    <input placeholder="" type="text" name="firstname" value="{{ old('firstname', $user->first_name) }}" class="form-control">
        	                 </div>
        	               </div>
        	               <div class="col-md-4">
        	                 <div class="form-group">
        	                    <label>{{ __('label.Last name') }}</label>
        	                    <input placeholder="" type="text" name="lastname" value="{{ old('lasttname', $user->last_name) }}" class="form-control">
        	                 </div>
        	               </div>
        	               <div class="col-md-4 col-lg-4">
        	                 <div class="form-group">
        	                    <label>{{ __('label.Email') }}</label>
        	                    <input placeholder="" disabled type="Email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
        	                 </div>
        	               </div>
        	               <div class="col-md-4 col-lg-4">
        	                 <div class="form-group">
        	                    <label>{{ __('label.Phone No') }}</label>
        	                    <input placeholder="" type="number" name="phone_number" value="{{ old('phone_number',$user->userProfile->phone_number) }}" class="form-control">
        	                 </div>
        	               </div>

        	               <div class="col-md-8">
        	                 <div class="form-group">
        	                    <label>{{ __('label.Address') }} </label>
        	                     <input placeholder="" type="text" name="address" value="{{ old('address', $user->userProfile->address) }}" class="form-control">
        	                 </div>
        	               </div>
                           <div class="col-md-4 col-lg-4">
        	                 <div class="form-group">
        	                    <label>{{ __('label.Gender') }}</label>
        	                    <select name="gender" class="form-control">
        	                      <option selected>{{ __('label.Select') }}</option>
        	                      <option {{ old('gender', $user->userProfile->gender) === 'male' ? 'selected' : '' }} value="male">{{ __('label.male') }}</option>
        	                      <option {{ old('gender', $user->userProfile->gender) === 'female' ? 'selected' : '' }} value="female">{{ __('label.female') }}</option>
        	                    </select>
        	                 </div>
        	               </div>

        	               <div class="col-md-12">
        	                 	<br/>
        		                <h3>{{ __('label.Change Password') }}</h3>
        	      				<hr/>
        	      		   </div>

        	      		   <div class="col-md-4 col-lg-4">
        	                 <div class="form-group">
        	                    <label>{{ __('label.Enter your old password') }}</label>
        	                    <input placeholder="" type="password" name="old_password" value="" class="form-control">
        	                 </div>
        	               </div>
        	               <div class="col-md-4 col-lg-4">
        	                 <div class="form-group">
        	                    <label>{{ __('label.Enter your new password') }}</label>
        	                    <input placeholder="" type="password" name="password" value="" class="form-control">
        	                 </div>
        	               </div>
        	                 <div class="col-md-4 col-lg-4">
        	                 <div class="form-group">
        	                    <label>{{ __('label.Confirm password') }}</label>
        	                    <input placeholder="" type="password" name="confirm_password" value="" class="form-control">
        	                 </div>
        	               </div>

        	               <div class="col-md-10">
        	                  <button class="edit_submit btn" type="submit">{{ __('label.Save') }}</button>
        	               </div>
        	            </div>
                    </form>
                 </div>

    		</div>
    	</div>

    	<!-- edit basic Information -->
    </div>
@endsection
@push('script')
    <script type="text/javascript">
    function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('.profile-image-thumb').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image-upload").change(function() {
        readURL(this);
    });
    </script>
@endpush
