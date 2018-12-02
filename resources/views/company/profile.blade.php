@extends('layout.base-layout')

@section('body')

<div class="profile_wrap">
	<!-- profile information -->
	<div class="container">
		<div class="profile_info">

			<div class="row">
				<div class="col-lg-6 profile_heading">
					<p>View public profile </p>
				</div>
				<div class="col-lg-6">
					<div class="profile_action float-right">
						<a href="#"><i class="fas fa-clone"></i> Copy URL porfile</a>
						<a href="#"><i class="fas fa-user-edit"></i> Edit profile </a>
					</div>
				</div>
			</div>

			<hr/>
			<div class="row">
				 <div class="col-sm-4 col-md-4 col-lg-3 company_id">
				 	<img src="{{ asset('frontend/images/logo-md.png') }}" class="img-fluid">
				 	<p>MD Group s.r.l.</p>
				 </div>
				 <div class="col-sm-4 col-md-4 col-lg-3 profile_content">

				 	<div class="rating">
				 	  <i class="active fas fa-star"></i>
				 	  <i class="active fas fa-star"></i>
				 	  <i class="active fas fa-star"></i>
				 	  <i class="fas fa-star"></i>
				 	  <i class="fas fa-star"></i>
				 	  <span>3/5</span>
				 	</div>
				 	<p><img width="20px" src="{{ asset('frontend/images/map-pin.svg') }}"/> Gorizia, Italy</p>
				 	<p><img width="20px" src="{{ asset('frontend/images/internet.svg') }}"/> www.mdgroup.com</p>
				 </div>
				 <div class="col-sm-4 col-md-4 col-lg-3 profile_content">
				 	<p class="blank"> &nbsp </p>
				 	<p><img width="20px" src="{{ asset('frontend/images/telephone.svg') }}"/> +39 1234567890</p>
				 	<p><img width="20px" src="{{ asset('frontend/images/at.svg') }}"/> info@mdgroup.com</p>
				 </div>
				 <div class="col-md-12 col-lg-3 map">
				 	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44387.41585740608!2d13.574595191831518!3d45.94701735187696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x477b00b63a5c98f5%3A0x36801403d70448b8!2s34170+Gorizia%2C+Province+of+Gorizia%2C+Italy!5e0!3m2!1sen!2sin!4v1529479830588" width="100%" height="135" frameborder="0" style="border:0" allowfullscreen></iframe>
				 </div>
			</div>

		</div>
	</div>

	<!-- basic Information -->

	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="basic_info">

					<ul class="nav nav-pills">
					  <li class="nav-item">
					    <a class="nav-link active" data-toggle="pill" href="#who">Who we are</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" data-toggle="pill" href="#images">Images</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" data-toggle="pill" href="#reviews">Reviews</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" data-toggle="pill" href="#interview">  Interview with the Company</a>
					  </li>
					</ul>


					<div class="tab-content">
					  <div class="tab-pane active" id="who">

					  	<div class="about_content">
					  		<h3>About us <a href="#"><img width="20px" src="{{ asset('frontend/images/pencil.svg') }}"></a></h3>
					  		<hr/>
					  		<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
					  		<br/><br/>
							There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
					  	</div>

					  	<div class="add_img">
					  		<h3>Images of the project</h3>
					  		<hr/>
					  		<div class="upload_wrap">
					  			<div class="EditImageUpload">
	                                <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple="">
	                                <label for="file-1">
	                                  <img src="{{ asset('frontend/images/upload.png') }}" class="img-fluid">
	                                  <span>Add Image</span>
	                                </label>
	                            </div>
					  			<p></p>
					  		</div>
					  	</div>

					  </div>
					  <div class="tab-pane fade" id="images">
					  	<div class="coming">
					  		<p>Coming Soon...</p>
					  	</div>
					  </div>
					  <div class="tab-pane fade" id="reviews">
					  	<div class="coming">
					  		<p>Coming Soon...</p>
					  	</div>
					  </div>
					  <div class="tab-pane fade" id="interview">
					  	<div class="coming">
					  		<p>Coming Soon...</p>
					  	</div>
					  </div>
					</div>

				</div>
			</div>

			<div class="col-lg-4">
				<div class="right_public">
					<h3>Create and share your public profile</h3>
					<hr/>
					<div class="pub pub_1">
						<span><img width="25px" src="{{ asset('frontend/images/public.png') }}"></span>
						<p>On the other hand, we denounce with righteous indignation and
						dislike men who are so.</p>
					</div>
					<div class="pub pub_2">
						<span><img width="25px" src="{{ asset('frontend/images/public.png') }}"></span>
						<p>On the other hand, we denounce with righteous indignation and
						dislike men who are so.</p>
					</div>
					<div class="pub pub_3">
						<span><img width="25px" src="{{ asset('frontend/images/public.png') }}"></span>
						<p>On the other hand, we denounce with righteous indignation and
						dislike men who are so.</p>
					</div>
				</div>


				<div class="right_public">
					<h3>Company : figures and facts</h3>
					<hr/>
					<div class="pub">
						<img src="{{ asset('frontend/images/certified.png') }}">
						<p>
							Type of company
							<i>S.R.L</i>
						</p>
					</div>
					<div class="pub">
						<img src="{{ asset('frontend/images/certified.png') }}">
						<p>
							Type of company
							<i>S.R.L</i>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
