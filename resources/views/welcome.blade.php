@extends('layoutindex')
@section('content')



<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"></div>


    <!-- End Main Header -->

	<!-- Main Slider Three -->
	<section class="main-slider-three">
		<div class="banner-carousel">
			<!-- Swiper -->
			<div class="swiper-wrapper">

				<div class="swiper-slide slide">
					<div class="auto-container">
						<div class="row clearfix">

							<!-- Content Column -->
							<div class="content-column col-lg-6 col-md-12 col-sm-12">
								<div class="inner-column">
									<h2>Your Most Trusted Health Partner For Life.</h2>
									<div class="text">We offer free consulting and the best project management for your ideas, 100% delivery guaranteed.</div>
									<div class="btn-box">
										<a href="{{ route('patient.appointments.available') }}" class="theme-btn appointment-btn"><span class="txt">Appointment</span></a>
										<a href="services.html" class="theme-btn services-btn">Services</a>
									</div>
								</div>
							</div>

							<!-- Image Column -->
							<div class="image-column col-lg-6 col-md-12 col-sm-12">
								<div class="inner-column">
									<div class="image" style="width: 550px; height: 550px;">
										<img src="{{ asset('assets/img/photos/home1.jpg') }}" alt=""
                                        style="width: 550px; height: 550px;"/>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>


				<div class="swiper-slide slide">
					<div class="auto-container">
						<div class="row clearfix">

							<!-- Content Column -->
							<div class="content-column col-lg-6 col-md-12 col-sm-12">
								<div class="inner-column">
									<h2>Your Most Trusted Health Partner For Life.</h2>
									<div class="text">We offer free consulting and the best project management for your ideas, 100% delivery guaranteed.</div>
									<div class="btn-box">
										<a href="{{ route('patient.appointments.available') }}" class="theme-btn appointment-btn"><span class="txt">Appointment</span></a>
										<a href="services.html" class="theme-btn services-btn">Services</a>
									</div>
								</div>
							</div>

							<!-- Image Column -->
							<div class="image-column col-lg-6 col-md-12 col-sm-12">
								<div class="inner-column">
									<div class="image" style="width: 550px; height: 550px;">
										<img src="{{ asset('assets/img/photos/home2.jpg') }}" alt=""
                                        style="width: 550px; height: 550px;" />
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>


				<div class="swiper-slide slide">
					<div class="auto-container">
						<div class="row clearfix">

							<!-- Content Column -->
							<div class="content-column col-lg-6 col-md-12 col-sm-12">
								<div class="inner-column">
									<h2>Your Most Trusted Health Partner For Life.</h2>
<div class="text">We leverage cutting-edge technologies and artificial intelligence to provide smart solutions, ensuring precision, efficiency, and 100% guaranteed results.</div>

									<div class="btn-box">
										<a href="{{ route('patient.appointments.available') }}" class="theme-btn appointment-btn"><span class="txt">Appointment</span></a>
										<a href="" class="theme-btn services-btn">Services</a>
									</div>
								</div>
							</div>

							<!-- Image Column -->
							<div class="image-column col-lg-6 col-md-12 col-sm-12">
								<div class="inner-column">
									<div class="image" style="width: 550px; height: 550px;">
										<img src="{{ asset('assets/img/photos/home3.jpg') }}" alt=""
                                        style="width: 550px; height: 550px;" />
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>

			</div>
			<!-- Add Arrows -->
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
	</section>
	<!-- End Main Slider -->

	<!-- Health Section -->
	<section class="health-section">
		<div class="auto-container">
			<div class="inner-container">

				<div class="row clearfix">

					<!-- Content Column -->
					<div class="content-column col-lg-7 col-md-12 col-sm-12">
						<div class="inner-column">
							<div class="border-line"></div>
							<!-- Sec Title -->
							<div class="sec-title">
								<h2>Who We Are <br> Pioneering in Health.</h2>
								<div class="separator"></div>
							</div>
							<div class="text">Where you are at the heart of our mission. We hope you will consider us as your medical home—the place where you feel safe, comfortable and cared for. As a multi-specialty medical group,</div>
							<a href="about.html" class="theme-btn btn-style-one"><span class="txt">More About Us</span></a>
						</div>
					</div>

					<!-- Image Column -->
					<div class="image-column col-lg-5 col-md-12 col-sm-12">
						<div class="inner-column wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
							<div class="image">
								<img src="{{ asset('assets/img/photos/home4.jpg') }}" alt=""
                                style="width: 549px; height: 426px;" />
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</section>
	<!-- End Health Section -->

	<!-- Featured Section -->
	<section class="featured-section">
		<div class="auto-container">
			<div class="row clearfix">

				<!-- Feature Block -->
				<div class="feature-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="upper-box">
							<div class="icon flaticon-doctor-stethoscope"></div>
							<h3><a href="#">Medical Treatment</a></h3>
						</div>
						<div class="text">Whether you're taking your first steps, just finding your stride,</div>
					</div>
				</div>

				<!-- Feature Block -->
				<div class="feature-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="250ms" data-wow-duration="1500ms">
						<div class="upper-box">
							<div class="icon flaticon-ambulance-side-view"></div>
							<h3><a href="#">Emergency Help</a></h3>
						</div>
						<div class="text">Whether you're taking your first steps, just finding your stride,</div>
					</div>
				</div>

				<!-- Feature Block -->
				<div class="feature-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="500ms" data-wow-duration="1500ms">
						<div class="upper-box">
							<div class="icon fas fa-user-md"></div>
							<h3><a href="#">Qualified Doctors</a></h3>
						</div>
						<div class="text">Whether you're taking your first steps, just finding your stride,</div>
					</div>
				</div>

				<!-- Feature Block -->
				<div class="feature-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1500ms">
						<div class="upper-box">
							<div class="icon fas fa-briefcase-medical"></div>
							<h3><a href="#">Medical Professionals</a></h3>
						</div>
						<div class="text">Whether you're taking your first steps, just finding your stride,</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- End Featured Section -->

	<!-- Department Section Three -->
	<section class="department-section-three">
		<div class="image-layer" style="background-image:url(images/background/6.jpg)"></div>
		<div class="auto-container">
			<!-- Department Tabs-->
            <div class="department-tabs tabs-box">
				<div class="row clearfix">
                	<!--Column-->
                    <div class="col-lg-4 col-md-12 col-sm-12">
						<!-- Sec Title -->
						<div class="sec-title light">
							<h2>Health <br> Department</h2>
							<div class="separator"></div>
						</div>
                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            <li data-tab="#tab-urology" class="tab-btn">Urology Department</li>
                            <li data-tab="#tab-department" class="tab-btn active-btn">Neurology Department</li>
                            <li data-tab="#tab-gastrology" class="tab-btn">Gastrology Department</li>
							<li data-tab="#tab-cardiology" class="tab-btn">Cardiology Department</li>
							<li data-tab="#tab-eye" class="tab-btn">Eye Care Department</li>
                        </ul>
                    </div>
                    <!--Column-->
                    <div class="col-lg-8 col-md-12 col-sm-12">
                    	<!--Tabs Container-->
                        <div class="tabs-content">

                            <!-- Tab -->
                            <div class="tab" id="tab-urology">
                            	<div class="content">
									<h2>Urology Department</h2>
									<div class="title">Department of Neurology</div>
									<div class="text">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									</div>
									<div class="two-column row clearfix">
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>01 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>02 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
									</div>
									<a href="doctors-detail.html" class="theme-btn btn-style-two"><span class="txt">View More</span></a>
								</div>
							</div>

							<!-- Tab -->
                            <div class="tab active-tab" id="tab-department">
                            	<div class="content">
									<h2>Neurology Department</h2>
									<div class="title">Department of Neurology</div>
									<div class="text">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									</div>
									<div class="two-column row clearfix">
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>01 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>02 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
									</div>
									<a href="doctors-detail.html" class="theme-btn btn-style-two"><span class="txt">View More</span></a>
								</div>
							</div>

							<!-- Tab -->
                            <div class="tab" id="tab-gastrology">
                            	<div class="content">
									<h2>Gastrology Department</h2>
									<div class="title">Department of Neurology</div>
									<div class="text">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									</div>
									<div class="two-column row clearfix">
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>01 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>02 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
									</div>
									<a href="doctors-detail.html" class="theme-btn btn-style-two"><span class="txt">View More</span></a>
								</div>
							</div>

							<!-- Tab -->
                            <div class="tab" id="tab-cardiology">
                            	<div class="content">
									<h2>Cardiology Department</h2>
									<div class="title">Department of Neurology</div>
									<div class="text">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									</div>
									<div class="two-column row clearfix">
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>01 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>02 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
									</div>
									<a href="doctors-detail.html" class="theme-btn btn-style-two"><span class="txt">View More</span></a>
								</div>
							</div>

							<!-- Tab -->
                            <div class="tab" id="tab-eye">
                            	<div class="content">
									<h2>Eye Care Department</h2>
									<div class="title">Department of Neurology</div>
									<div class="text">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
										<p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									</div>
									<div class="two-column row clearfix">
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>01 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<h3>02 - Neurology Service</h3>
											<div class="column-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus</div>
										</div>
									</div>
									<a href="doctors-detail.html" class="theme-btn btn-style-two"><span class="txt">View More</span></a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
	<!-- End Department Section -->

	<!-- Team Section -->
	<section class="team-section">
		<div class="auto-container">

			<!-- Sec Title -->
			<div class="sec-title centered">
				<h2>The Medical Specialists</h2>
				<div class="separator"></div>
			</div>

			<div class="row clearfix">
				@foreach($doctors as $doctor)
				<!-- Team Block -->
				<div class="team-block col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="image">
							@if($doctor->profile_photo)
								<img src="{{ asset('storage/' . $doctor->profile_photo) }}" alt="{{ $doctor->name }}" style="width: 270px; height: 270px; object-fit: cover;" />
							@else
								<img src="{{ asset('assets/img/default-avatar.png') }}" alt="{{ $doctor->name }}" style="width: 270px; height: 270px; object-fit: cover;" />
							@endif
							<div class="overlay-box">
								<ul class="social-icons">
									<li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
									<li><a href="#"><span class="fab fa-google"></span></a></li>
									<li><a href="#"><span class="fab fa-twitter"></span></a></li>
									<li><a href="#"><span class="fab fa-skype"></span></a></li>
									<li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
								</ul>
								<a href="{{ route('appointment.create', ['doctor' => $doctor->id]) }}" class="appointment">Make Appointment</a>
							</div>
						</div>
						<div class="lower-content">
                            <h3><a href="#">Dr. {{ $doctor->name }}</a></h3>
                            <div class="designation">{{ optional($doctor->doctor)->specialization->name ?? 'General' }}</div>
                        </div>
					</div>
				</div>
				@endforeach
			</div>

		</div>
	</section>        <section class="video-section" style="background-image:url({{ asset('assets/img/viedo.png')}})">
            <div class="auto-container">
                <div class="content">
                    <a href="https://youtu.be/EceDhNJE6Eg?si=FR5FclvNg4t9pmjk" class="lightbox-image play-box"><span
                            class="flaticon-play-button"><i class="ripple"></i></span></a>
                    <div class="text">WE ARE CARE ABOUT YOUR HEALTH</div>
                    <h2>We Care About You</h2>
                </div>
            </div>
        </section>
        <section class="appointment-section-two">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="row clearfix">

                        <!-- Image Column -->
                        <div class="image-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="image">
                                    <img src="images/resource/doctor-2.png" alt="" />
                                </div>
                            </div>
                        </div>

                        <!-- Form Column -->
                        <div class="form-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <!-- Sec Title -->
                                <div class="sec-title">
                                    <h2>Appointment Form</h2>
                                    <div class="separator"></div>
                                </div>

                                <!-- Appointment Form -->
                                <div class="appointment-form">
                                    <form method="post" action="appointment.html">
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="text" name="username" placeholder="Name" required="">
                                                <span class="icon fa fa-user"></span>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="email" name="email" placeholder="Email" required="">
                                                <span class="icon fa fa-envelope"></span>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="tel" name="phone" placeholder="Phone No"
                                                    required="">
                                                <span class="icon fas fa-phone"></span>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="text" name="department" placeholder="Department"
                                                    required="">
                                                <span class="icon fas fa-home"></span>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="text" name="day" placeholder="Day">
                                                <span class="icon fa fa-calendar"></span>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="text" name="time" placeholder="Time" class="">
                                                <span class="icon far fa-clock"></span>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <textarea name="message" placeholder="Message"></textarea>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <button class="theme-btn btn-style-two" type="submit"
                                                    name="submit-form"><span class="txt">Book
                                                        Appointment</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial Section Two -->
        <section class="testimonial-section-two">
            <div class="auto-container">
                <!-- Sec Title -->
                <div class="sec-title centered">
                    <h2>What Patients Saying</h2>
                    <div class="separator"></div>
                </div>
                <div class="testimonial-carousel owl-carousel owl-theme">

                    <!-- Tesimonial Block Two -->


                    @foreach ( $reviews ?? [] as $review)


<div class="testimonial-block-two">
	<div class="inner-box">
		<div class="image">
			<img src="images/resource/author-4.jpg" alt="" />
		</div>
		<div class="text">{{$review->comment ?? ''}}</div>
		<div class="lower-box">
			<div class="clearfix">

				<div class="pull-left">
					<div class="quote-icon flaticon-quote"></div>
				</div>
				<div class="pull-right">
					<div class="author-info">

						<div class="author">{{$review->user->name ?? ''}}</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endforeach

                    <!-- Tesimonial Block Two -->


                </div>
            </div>
        </section>
        <!-- End Testimonial Section Two -->

        <!-- Counter Section -->
        <section class="counter-section style-two" style="background-image: url(images/background/pattern-3.png)">
            <div class="auto-container">

                <!-- Fact Counter -->
                <div class="fact-counter style-two">
                    <div class="row clearfix">

                        <!--Column-->
                        <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="content">
                                    <div class="icon flaticon-logout"></div>
                                    <div class="count-outer count-box">
                                        <span class="count-text" data-speed="2500" data-stop="2350">0</span>
                                    </div>
                                    <h4 class="counter-title">Satisfied Patients</h4>
                                </div>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                                <div class="content">
                                    <div class="icon flaticon-logout"></div>
                                    <div class="count-outer count-box alternate">
                                        +<span class="count-text" data-speed="3000" data-stop="350">0</span>
                                    </div>
                                    <h4 class="counter-title">Doctor’s Team</h4>
                                </div>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
                                <div class="content">
                                    <div class="icon flaticon-logout"></div>
                                    <div class="count-outer count-box">
                                        <span class="count-text" data-speed="3000" data-stop="2150">0</span>
                                    </div>
                                    <h4 class="counter-title">Success Mission</h4>
                                </div>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="900ms" data-wow-duration="1500ms">
                                <div class="content">
                                    <div class="icon flaticon-logout"></div>
                                    <div class="count-outer count-box">
                                        +<span class="count-text" data-speed="2500" data-stop="225">0</span>
                                    </div>
                                    <h4 class="counter-title">Successfull Surgeries</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- End Counter Section -->

        <!-- Doctor Info Section -->
        <section class="doctor-info-section">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="row clearfix">

                        <!-- Doctor Block -->
                        <div class="doctor-block col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <h3>Working Hours</h3>
                                <ul class="doctor-time-list">
                                    <li>Mon–Fri <span>8:00am–7:00pm</span></li>
                                    <li>Saturday <span>9:00am–5:00pm</span></li>
                                    <li>Sunday <span>9:00am–3:00pm</span></li>
                                </ul>
                                <h4>Emergency Cases</h4>
                                <div class="phone">Call us! <strong>+898 68679 575 09</strong></div>
                            </div>
                        </div>

                        <!-- Doctor Block -->
                        <div class="doctor-block col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <h3>Doctors Timetable</h3>
                                <div class="text">The following is for guidance only to help you plan your appointment
                                    with a preferred doctor or nurse. It does not guarantee availability as the doctors or
                                    nurses may sometimes be attending to other duties.</div>
                                <a href="#" class="detail">More Detail</a>
                            </div>
                        </div>

                        <!-- Doctor Block -->
                        <div class="doctor-block col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <h3>Primary Health Care</h3>
                                <div class="text">When you know you are using your best talents for something you love,
                                    you can’t it. Effective communication is the basis for building brands as solid as the
                                    relation-ships with build with our clients..</div>
                                <a href="#" class="detail">Contact Now</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- End Doctor Info Section -->

        <!-- News Section Two -->
        <section class="news-section-two">
            <div class="auto-container">
                <!-- Sec Title -->
                <div class="sec-title centered">
                    <h2>Latest News & Articals</h2>
                    <div class="separator style-three"></div>
                </div>
                <div class="row clearfix">

                    <!-- News Block Two -->
                    <div class="news-block-two col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box">
                            <div class="image">
                                <a href="blog-detail.html"><img src="images/resource/news-4.jpg" alt="" /></a>
                            </div>
                            <div class="lower-content">
                                <div class="content">
                                    <ul class="post-info">
                                        <li><span
                                                class="icon flaticon-chat-comment-oval-speech-bubble-with-text-lines"></span>
                                            02</li>
                                        <li><span class="icon flaticon-heart"></span> 126</li>
                                    </ul>
                                    <ul class="post-meta">
                                        <li>June 21, 2018 at 8:12pm</li>
                                        <li>Post By: Admin</li>
                                    </ul>
                                    <h3><a href="blog-detail.html">Diagnostic Services for Efficient Results Picking Right
                                        </a></h3>
                                    <div class="text">There are a lot of women that are unaware of the numerous risks
                                        associated with their health and eventually ignore the ...</div>
                                    <a href="blog-detail.html" class="theme-btn btn-style-five"><span class="txt">read
                                            more</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- News Block Two -->
                    <div class="news-block-two col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box">
                            <div class="image">
                                <a href="blog-detail.html"><img src="images/resource/news-5.jpg" alt="" /></a>
                            </div>
                            <div class="lower-content">
                                <div class="content">
                                    <ul class="post-info">
                                        <li><span
                                                class="icon flaticon-chat-comment-oval-speech-bubble-with-text-lines"></span>
                                            02</li>
                                        <li><span class="icon flaticon-heart"></span> 126</li>
                                    </ul>
                                    <ul class="post-meta">
                                        <li>June 21, 2018 at 8:12pm</li>
                                        <li>Post By: Admin</li>
                                    </ul>
                                    <h3><a href="blog-detail.html">Reasons to Visit for Heart Specialist Department.</a>
                                    </h3>
                                    <div class="text">There are a lot of women that are unaware of the numerous risks
                                        associated with their health and eventually ignore the ...</div>
                                    <a href="blog-detail.html" class="theme-btn btn-style-five"><span class="txt">read
                                            more</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!--Clients Section-->
        <section class="clients-section">
            <div class="outer-container">

                <div class="sponsors-outer">
                    <!--Sponsors Carousel-->
                    <ul class="sponsors-carousel owl-carousel owl-theme">
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img src="images/clients/1.png"
                                        alt=""></a></figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img src="images/clients/2.png"
                                        alt=""></a></figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img src="images/clients/3.png"
                                        alt=""></a></figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img src="images/clients/4.png"
                                        alt=""></a></figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img src="images/clients/5.png"
                                        alt=""></a></figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img src="images/clients/1.png"
                                        alt=""></a></figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img src="images/clients/2.png"
                                        alt=""></a></figure>
                        </li>
                    </ul>
                </div>

            </div>
        </section>
        <!--End Clients Section-->

        <!--Main Footer-->


    </div>
    <!--End pagewrapper-->

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

    <!--Search Popup-->
    <div id="search-popup" class="search-popup">
        <div class="close-search theme-btn"><span class="fas fa-window-close"></span></div>
        <div class="popup-inner">
            <div class="overlay-layer"></div>
            <div class="search-form">
                <form method="post" action="index.html">
                    <div class="form-group">
                        <fieldset>
                            <input type="search" class="form-control" name="search-input" value=""
                                placeholder="Search Here" required>
                            <input type="submit" value="Search Now!" class="theme-btn">
                        </fieldset>
                    </div>
                </form>

                <br>
                <h3>Recent Search Keywords</h3>
                <ul class="recent-searches">
                    <li><a href="#">Business</a></li>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">SEO</a></li>
                    <li><a href="#">Logistics</a></li>
                    <li><a href="#">Freedom</a></li>
                </ul>

            </div>

        </div>
    </div>

    <!-- sidebar cart item -->
    <div class="xs-sidebar-group info-group">
        <div class="xs-overlay xs-bg-black"></div>
        <div class="xs-sidebar-widget">
            <div class="sidebar-widget-container">
                <div class="widget-heading">
                    <a href="#" class="close-side-widget">
                        X
                    </a>
                </div>
                <div class="sidebar-textwidget">

                    <!-- Sidebar Info Content -->
                    <div class="sidebar-info-contents">
                        <div class="content-inner">
                            <div class="logo">
                                <a href="index.html"><img src="images/logo-3.png" alt="" /></a>
                            </div>
                            <div class="content-box">
                                <h2>About Us</h2>
                                <p class="text">Core values are the fundamental beliefs of a person or organization. The
                                    core values are the guiding prin ples that dictate behavior and action suas labore
                                    saperet has there any quote for write lorem percit latineu.</p>
                                <a href="#" class="theme-btn btn-style-two"><span
                                        class="txt">Consultation</span></a>
                            </div>
                            <div class="contact-info">
                                <h2>Contact Info</h2>
                                <ul class="list-style-two">
                                    <li><span class="icon flaticon-map"></span>Chicago 12, Melborne City, USA</li>
                                    <li><span class="icon flaticon-telephone"></span>(111) 111-111-1111</li>
                                    <li><span class="icon flaticon-message-1"></span>meditech@gmail.com</li>
                                    <li><span class="icon flaticon-timetable"></span>Week Days: 09.00 to 18.00 Sunday:
                                        Closed</li>
                                </ul>
                            </div>
                            <!-- Social Box -->
                            <ul class="social-box">
                                <li class="facebook"><a href="#" class="fab fa-facebook-f"></a></li>
                                <li class="twitter"><a href="#" class="fab fa-twitter"></a></li>
                                <li class="linkedin"><a href="#" class="fab fa-linkedin-in"></a></li>
                                <li class="instagram"><a href="#" class="fab fa-instagram"></a></li>
                                <li class="youtube"><a href="#" class="fab fa-youtube"></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END sidebar widget item -->

    <!-- Color Palate / Color Switcher -->
    <div class="color-palate">
        <div class="color-trigger">
            <i class="fas fa-cog"></i>
        </div>
        <div class="color-palate-head">
            <h6>Choose Your Color</h6>
        </div>
        <div class="various-color clearfix">
            <div class="colors-list">
                <span class="palate default-color active" data-theme-file="css/color-themes/default-theme.css"></span>
                <span class="palate green-color" data-theme-file="css/color-themes/green-theme.css"></span>
                <span class="palate olive-color" data-theme-file="css/color-themes/olive-theme.css"></span>
                <span class="palate orange-color" data-theme-file="css/color-themes/orange-theme.css"></span>
                <span class="palate purple-color" data-theme-file="css/color-themes/purple-theme.css"></span>
                <span class="palate teal-color" data-theme-file="css/color-themes/teal-theme.css"></span>
                <span class="palate brown-color" data-theme-file="css/color-themes/brown-theme.css"></span>
                <span class="palate redd-color" data-theme-file="css/color-themes/redd-color.css"></span>
            </div>
        </div>

        <ul class="rtl-version option-box">
            <li class="rtl">RTL Version</li>
            <li>LTR Version</li>
        </ul>

        <a href="#" class="purchase-btn">Purchase now $17</a>

        <div class="palate-foo">
            <span>You will find much more options for colors and styling in admin panel. This color picker is used only for
                demonstation purposes.</span>
        </div>

    </div>
@endsection

<!-- AI Chat Button -->
    <div class="ai-chat-button" id="aiChatButton">
        <button class="chat-toggle-btn" onclick="toggleChat()">
            <i class="fas fa-robot"></i> AI Chat
        </button>
        
        <div class="chat-container" id="chatContainer" style="display: none;">
            <div class="chat-header">
                <h4>Medical AI Assistant</h4>
                <button class="close-btn" onclick="toggleChat()">×</button>
            </div>
            <div class="chat-messages" id="chatMessages">
                <div class="message bot">
                    مرحباً! أنا مساعدك الطبي بالذكاء الاصطناعي. كيف يمكنني مساعدتك اليوم؟
                </div>
                <div class="typing-indicator" id="typingIndicator">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            
            </div>
            <div class="chat-input">
                <input type="text" id="userInput" placeholder="اكتب سؤالك الطبي هنا...">
                <button onclick="sendMessage()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>


    <style>
        /* ... existing styles ... */
        
        .typing-indicator {
            display: none;
            background-color: #f0f2f5;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            max-width: 80%;
            margin-right: auto;
        }
    
        .typing-indicator span {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #93959f;
            border-radius: 50%;
            margin-right: 5px;
            animation: typing 1s infinite;
        }
    
        .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
        .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }
    
        @keyframes typing {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>
    <style>
    .ai-chat-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }

    .chat-toggle-btn {
        background: #007bff;
        color: white;
        border: none;
        padding: 15px 25px;
        border-radius: 25px;
        cursor: pointer;
        font-size: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }

    .chat-toggle-btn:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }

    .chat-container {
        position: fixed;
        bottom: 100px;
        right: 30px;
        width: 350px;
        height: 500px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        display: flex;
        flex-direction: column;
    }

    .chat-header {
        padding: 15px;
        background: #007bff;
        color: white;
        border-radius: 10px 10px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-header h4 {
        margin: 0;
    }

    .close-btn {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
    }

    .chat-messages {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
    }

    .message {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 10px;
        max-width: 80%;
    }

    .message.bot {
        background: #f0f2f5;
        margin-right: auto;
    }

    .message.user {
        background: #007bff;
        color: white;
        margin-left: auto;
    }

    .chat-input {
        padding: 15px;
        border-top: 1px solid #eee;
        display: flex;
    }

    .chat-input input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 20px;
        margin-right: 10px;
    }

    .chat-input button {
        background: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 20px;
        cursor: pointer;
    }
    </style>
<script>
    document.getElementById('userInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    function toggleChat() {
        const container = document.getElementById('chatContainer');
        container.style.display = container.style.display === 'none' ? 'flex' : 'none';
    }
    
    function addMessage(message, type) {
        const messagesDiv = document.getElementById('chatMessages');
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', type);
        messageElement.textContent = message;
        messagesDiv.appendChild(messageElement);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    async function sendMessage() {
        const input = document.getElementById('userInput');
        const message = input.value.trim();
        if (!message) return;

        addMessage(message, 'user');
        input.value = '';

        const typingIndicator = document.getElementById('typingIndicator');
        typingIndicator.style.display = 'block';

        try {
            const response = await fetch('{{ route("chat.ai") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message })
            });

            typingIndicator.style.display = 'none';

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            
            if (data.response) {
                addMessage(data.response, 'bot');
            } else if (data.error) {
                throw new Error(data.error);
            } else {
                throw new Error('Invalid response format');
            }
        } catch (error) {
            typingIndicator.style.display = 'none';
            console.error('Error:', error);
            addMessage('عذراً، حدث خطأ. يرجى المحاولة مرة أخرى.', 'bot');
        }
    }
</script>