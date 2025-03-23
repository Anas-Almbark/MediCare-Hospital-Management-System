@extends('layoutindex')
@section('content')


<div class="page-wrapper">
     <!-- Preloader -->
     <div class="preloader"></div>
 
     <header class= "main-header">
      
    
     
 
           <!--Sticky Header-->
         <div class="sticky-header">
              <div class="auto-container clearfix">
                  <!--Logo-->
                  <div class="logo pull-left">
                      <a href="index.html" class="img-responsive"><img src="images/logo-small.png" alt="" title=""></a>
                 </div>
                 
                     <!--Right Col-->
                 <div class="right-col pull-right">
                          <!-- Main Menu -->
                     <nav class="main-menu navbar-expand-md">
                         <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent1">
                             <ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
                         </div>
                     </nav><!-- Main Menu End-->
                 </div>
                 
             </div>
         </div>
         <!--End Sticky Header-->
           
          <!-- Mobile Menu  -->
         <div class="mobile-menu">
             <div class="menu-backdrop"></div>
             <div class="close-btn"><span class="icon far fa-window-close"></span></div>
             
             <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
             <nav class="menu-box">
                  <div class="nav-logo"><a href="index.html"><img src="images/nav-logo.png" alt="" title=""></a></div>
                 
                 <ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
             </nav>
         </div><!-- End Mobile Menu -->
 
     </header>
     <!-- End Main Header -->
      
      <!--Page Title-->
     <section class="page-title" style="background-image:url(images/background/7.jpg);">
         <div class="auto-container">
             <h1>About MediTech</h1>
                <div class="text">What We Actually Do?</div>
                <ul class="bread-crumb clearfix">
                     <li><a href="index.html"><span class="fas fa-home"></span> Home </a></li>
                     <li>About MediTech</li>
                </ul>
         </div>
     </section>
     <!--End Page Title-->
      
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
                                         <img src="images/resource/image-3.jpg" alt="" />
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
                                    <div class="text">The following is for guidance only to help you plan your appointment with a preferred doctor or nurse. It does not guarantee availability as the doctors or nurses may sometimes be attending to other duties.</div>
                                    <a href="#" class="detail">More Detail</a>
                               </div>
                          </div>
                          
                          <!-- Doctor Block -->
                          <div class="doctor-block col-lg-4 col-md-6 col-sm-12">
                               <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                                    <h3>Primary Health Care</h3>
                                    <div class="text">When you know you are using your best talents for something you love, you can’t it. Effective communication is the basis for building brands as solid as the relation-ships with build with our clients..</div>
                                    <a href="#" class="detail">Contact Now</a>
                               </div>
                          </div>
                          
                     </div>
                </div>
           </div>
      </section>
      <!-- End Doctor Info Section -->
      
      <!-- Team Section -->
      <section class="team-section">
           <div class="auto-container">
                
                <!-- Sec Title -->
                <div class="sec-title centered">
                     <h2>The Medical Specialists</h2>
                     <div class="separator"></div>
                </div>
                
                <div class="row clearfix">
                     
                     <!-- Team Block -->
                     <div class="team-block col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                               <div class="image">
                                    <img src="images/resource/team-1.jpg" alt="" />
                                    <div class="overlay-box">
                                         <ul class="social-icons">
                                              <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                              <li><a href="#"><span class="fab fa-google"></span></a></li>
                                              <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                              <li><a href="#"><span class="fab fa-skype"></span></a></li>
                                              <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                         </ul>
                                         <a href="#" class="appointment">Make Appointment</a>
                                    </div>
                               </div>
                               <div class="lower-content">
                                    <h3><a href="#">Dr. Andria Jonea</a></h3>
                                    <div class="designation">Cancer Specialist</div>
                               </div>
                          </div>
                     </div>
                     
                     <!-- Team Block -->
                     <div class="team-block col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <div class="inner-box wow fadeInLeft" data-wow-delay="250ms" data-wow-duration="1500ms">
                               <div class="image">
                                    <img src="images/resource/team-2.jpg" alt="" />
                                    <div class="overlay-box">
                                         <ul class="social-icons">
                                              <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                              <li><a href="#"><span class="fab fa-google"></span></a></li>
                                              <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                              <li><a href="#"><span class="fab fa-skype"></span></a></li>
                                              <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                         </ul>
                                         <a href="#" class="appointment">Make Appointment</a>
                                    </div>
                               </div>
                               <div class="lower-content">
                                    <h3><a href="#">Dr. Robet Samith</a></h3>
                                    <div class="designation">Heart Surgen</div>
                               </div>
                          </div>
                     </div>
                     
                     <!-- Team Block -->
                     <div class="team-block col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <div class="inner-box wow fadeInLeft" data-wow-delay="500ms" data-wow-duration="1500ms">
                               <div class="image">
                                    <img src="images/resource/team-3.jpg" alt="" />
                                    <div class="overlay-box">
                                         <ul class="social-icons">
                                              <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                              <li><a href="#"><span class="fab fa-google"></span></a></li>
                                              <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                              <li><a href="#"><span class="fab fa-skype"></span></a></li>
                                              <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                         </ul>
                                         <a href="#" class="appointment">Make Appointment</a>
                                    </div>
                               </div>
                               <div class="lower-content">
                                    <h3><a href="#">Dr. Sharon Laura</a></h3>
                                    <div class="designation">Family Physician</div>
                               </div>
                          </div>
                     </div>
                     
                     <!-- Team Block -->
                     <div class="team-block col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <div class="inner-box wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1500ms">
                               <div class="image">
                                    <img src="images/resource/team-4.jpg" alt="" />
                                    <div class="overlay-box">
                                         <ul class="social-icons">
                                              <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                              <li><a href="#"><span class="fab fa-google"></span></a></li>
                                              <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                              <li><a href="#"><span class="fab fa-skype"></span></a></li>
                                              <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                         </ul>
                                         <a href="#" class="appointment">Make Appointment</a>
                                    </div>
                               </div>
                               <div class="lower-content">
                                    <h3><a href="#">Dr. Alex Furgosen</a></h3>
                                    <div class="designation">Ortho Specialist</div>
                               </div>
                          </div>
                     </div>
                     
                </div>
                
           </div>
      </section>
      <!-- End Team Section -->
      
      <!-- Video Section -->
      <section class="video-section" style="background-image:url(images/background/5.jpg)">
           <div class="auto-container">
                <div class="content">
                     <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="lightbox-image play-box"><span class="flaticon-play-button"><i class="ripple"></i></span></a>
                     <div class="text">WE ARE CARE ABOUT YOUR HEALTH</div>
                     <h2>We Care About You</h2>
                </div>
           </div>
      </section>
      <!-- End Video Section -->
      
      <!-- Appointment Section Two -->
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
                                                        <input type="tel" name="phone" placeholder="Phone No" required="">
                                                        <span class="icon fas fa-phone"></span>
                                                   </div>
 
                                                   <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                        <input type="text" name="department" placeholder="Department" required="">
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
                                                        <button class="theme-btn btn-style-two" type="submit" name="submit-form"><span class="txt">Book Appointment</span></button>
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
      
      <!-- Testimonial Section -->
     <section class="testimonial-section style-two">
          <div class="auto-container">
                <!-- Sec Title -->
                <div class="sec-title centered">
                     <h2>What Patients Saying</h2>
                     <div class="separator"></div>
                </div>
              <div class="testimonial-outer" style="background-image: url(images/background/pattern-4.png)">
             
                  <!--Client Testimonial Carousel-->
                 <div class="client-testimonial-carousel owl-carousel owl-theme">
                 
                     <!--Testimonial Block -->
                     <div class="testimonial-block">
                         <div class="inner-box">
                                    <div class="quote-icon flaticon-quote"></div>
                             <div class="text">Medical Centre is a great place to get all of your medical needs. I came in for a check up and did not wait more than 5 minutes before I was seen. I can only imagine the type of service you get for more serious issues. Thanks!</div>
                         </div>
                     </div>
                     
                     <!--Testimonial Block -->
                     <div class="testimonial-block">
                         <div class="inner-box">
                                    <div class="quote-icon flaticon-quote"></div>
                             <div class="text">Medical Centre is a great place to get all of your medical needs. I came in for a check up and did not wait more than 5 minutes before I was seen. I can only imagine the type of service you get for more serious issues. Thanks!</div>
                         </div>
                     </div>
                          
                          <!--Testimonial Block -->
                     <div class="testimonial-block">
                         <div class="inner-box">
                                    <div class="quote-icon flaticon-quote"></div>
                             <div class="text">Medical Centre is a great place to get all of your medical needs. I came in for a check up and did not wait more than 5 minutes before I was seen. I can only imagine the type of service you get for more serious issues. Thanks!</div>
                         </div>
                     </div>
                     
                     <!--Testimonial Block -->
                     <div class="testimonial-block">
                         <div class="inner-box">
                                    <div class="quote-icon flaticon-quote"></div>
                             <div class="text">Medical Centre is a great place to get all of your medical needs. I came in for a check up and did not wait more than 5 minutes before I was seen. I can only imagine the type of service you get for more serious issues. Thanks!</div>
                         </div>
                     </div>
                          
                          <!--Testimonial Block -->
                     <div class="testimonial-block">
                         <div class="inner-box">
                                    <div class="quote-icon flaticon-quote"></div>
                             <div class="text">Medical Centre is a great place to get all of your medical needs. I came in for a check up and did not wait more than 5 minutes before I was seen. I can only imagine the type of service you get for more serious issues. Thanks!</div>
                         </div>
                     </div>
                          
                          <!--Testimonial Block -->
                     <div class="testimonial-block">
                         <div class="inner-box">
                                    <div class="quote-icon flaticon-quote"></div>
                             <div class="text">Medical Centre is a great place to get all of your medical needs. I came in for a check up and did not wait more than 5 minutes before I was seen. I can only imagine the type of service you get for more serious issues. Thanks!</div>
                         </div>
                     </div>
                     
                 </div>
                     
                     <!--Product Thumbs Carousel-->
                 <div class="client-thumb-outer">
                     <div class="client-thumbs-carousel owl-carousel owl-theme">
                         <div class="thumb-item">
                             <figure class="thumb-box"><img src="images/resource/author-1.jpg" alt=""></figure>
                                    <div class="author-info">
                                         <div class="author-name">Max Winchester</div>
                                         <div class="designation">Kidny Patient</div>
                                    </div>
                         </div>
                         <div class="thumb-item">
                             <figure class="thumb-box"><img src="images/resource/author-2.jpg" alt=""></figure>
                                    <div class="author-info">
                                         <div class="author-name">Max Winchester</div>
                                         <div class="designation">Kidny Patient</div>
                                    </div>
                         </div>
                         <div class="thumb-item">
                             <figure class="thumb-box"><img src="images/resource/author-3.jpg" alt=""></figure>
                                    <div class="author-info">
                                         <div class="author-name">Max Winchester</div>
                                         <div class="designation">Kidny Patient</div>
                                    </div>
                         </div>
                         <div class="thumb-item">
                             <figure class="thumb-box"><img src="images/resource/author-1.jpg" alt=""></figure>
                                    <div class="author-info">
                                         <div class="author-name">Max Winchester</div>
                                         <div class="designation">Kidny Patient</div>
                                    </div>
                         </div>
                         <div class="thumb-item">
                             <figure class="thumb-box"><img src="images/resource/author-2.jpg" alt=""></figure>
                                    <div class="author-info">
                                         <div class="author-name">Max Winchester</div>
                                         <div class="designation">Kidny Patient</div>
                                    </div>
                         </div>
                         <div class="thumb-item">
                             <figure class="thumb-box"><img src="images/resource/author-3.jpg" alt=""></figure>
                                    <div class="author-info">
                                         <div class="author-name">Max Winchester</div>
                                         <div class="designation">Kidny Patient</div>
                                    </div>
                         </div>
                     </div>
                 </div>
                     
                 
             </div>
         </div>
     </section>
     <!-- End Testimonial Section Two -->
      
      <!--Main Footer-->
     <footer class="main-footer style-two">
           <div class="auto-container">
              <!--Widgets Section-->
             <div class="widgets-section">
                  <div class="row clearfix">
                      
                     <!--big column-->
                     <div class="big-column col-lg-6 col-md-12 col-sm-12">
                         <div class="row clearfix">
                                    
                                    <!--Footer Column-->
                             <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                                 <div class="footer-widget logo-widget">
                                              <div class="logo">
                                          <a href="index.html"><img src="images/logo-3.png" alt="" /></a>
                                     </div>
                                     <div class="text">Meditech is a library of health and medical templates with predefined web elements which helps you to build your medical templates best site Provide Comprehensive Quality Care About Medical Care Health Suspendisse metus turpis.</div>
                                              <ul class="social-icons">
                                                   <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                                   <li><a href="#"><span class="fab fa-google"></span></a></li>
                                                   <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                                   <li><a href="#"><span class="fab fa-skype"></span></a></li>
                                                   <li><a href="#"><span class="fab fa-linkedin"></span></a></li>
                                              </ul>
                                         </div>
                                    </div>
                                    
                                    <!--Footer Column-->
                             <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                                 <div class="footer-widget links-widget">
                                              <div class="footer-title  clearfix">
                                                   <h2>Departments</h2>
                                                   <div class="separator"></div>
                                              </div>
                                              <ul class="footer-list">
                                                   <li><a href="#">Surgery & Radiology</a></li>
                                                   <li><a href="#">Family Medicine</a></li>
                                                   <li><a href="#">Women’s Health</a></li>
                                                   <li><a href="#">Optician</a></li>
                                                   <li><a href="#">Pediatrics</a></li>
                                                   <li><a href="#">Dermatology</a></li>
                                              </ul>
                                         </div>
                                    </div>
                                    
                               </div>
                          </div>
                          
                          <!--big column-->
                     <div class="big-column col-lg-6 col-md-12 col-sm-12">
                         <div class="row clearfix">
                                    
                                    <!--Footer Column-->
                             <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                 <div class="footer-widget news-widget">
                                              <div class="footer-title  clearfix">
                                                   <h2>News Update</h2>
                                                   <div class="separator"></div>
                                              </div>
                                              
                                              <!--News Widget Block-->
                                     <div class="news-widget-block">
                                         <div class="widget-inner">
                                             <div class="image">
                                                 <img src="images/resource/news-image-1.jpg" alt="" />
                                             </div>
                                             <h3><a href="blog-detail.html">Integrative Medicine And Cancer Treatment</a></h3>
                                             <div class="post-date">July 11, 2017</div>
                                         </div>
                                     </div>
                                              
                                              <!--News Widget Block-->
                                     <div class="news-widget-block">
                                         <div class="widget-inner">
                                             <div class="image">
                                                 <img src="images/resource/news-image-2.jpg" alt="" />
                                             </div>
                                             <h3><a href="blog-detail.html">Achieving Better Health Care One Patient  Time</a></h3>
                                             <div class="post-date">July 11, 2018</div>
                                         </div>
                                     </div>
                                              
                                         </div>
                                    </div>
                                    
                                    <!--Footer Column-->
                             <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                 <div class="footer-widget contact-widget">
                                              <div class="footer-title  clearfix">
                                                   <h2>Contact Us</h2>
                                                   <div class="separator"></div>
                                              </div>
                                              
                                              <ul class="contact-list">
                                                   <li><span class="icon flaticon-placeholder"></span>2130 Fulton Street San Diego <br> CA 94117-1080 USA</li>
                                                   <li><span class="icon flaticon-call"></span>Mon to Fri : 08:30 - 18:00 <br> <a href="tel:+898-68679-575-09">+898 68679 575 09</a></li>
                                                   <li><span class="icon flaticon-message"></span>Do you have a Question? <a href="mailto:info@gmail.com">info@gmail.com</a></li>
                                              </ul>
                                              
                                         </div>
                                    </div>
                                    
                               </div>
                          </div>
                          
                     </div>
                </div>
           </div>
      
           <!-- Footer Bottom -->
           <div class="footer-bottom">
                <div class="auto-container">
                     <div class="copyright">MediTech Helth Care &copy; All Rights Reserved By Expertthemes</div>
                </div>
           </div>
      
      </footer>
      
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
                         <input type="search" class="form-control" name="search-input" value="" placeholder="Search Here" required >
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
      
      <ul class="rtl-version option-box"> <li class="rtl">RTL Version</li> <li>LTR Version</li> </ul>
 
     <a href="#" class="purchase-btn">Purchase now $17</a>
     
     <div class="palate-foo">
         <span>You will find much more options for colors and styling in admin panel. This color picker is used only for demonstation purposes.</span>
     </div>
 
 </div>
 
@endsection 