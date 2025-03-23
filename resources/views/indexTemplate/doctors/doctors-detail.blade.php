@extends('layoutindex')
@section('content')
<div class="page-wrapper">
     <!-- Preloader -->
     <div class="preloader"></div>
 

      <!--Page Title-->
     <section class="page-title" style="background-image:url(images/background/7.jpg);">
         <div class="auto-container">
             <h1>Dr. Detail For MediTech</h1>
                <div class="text">What We Actually Do?</div>
                <ul class="bread-crumb clearfix">
                     <li><a href="index.html"><span class="fas fa-home"></span> Home </a></li>
                     <li>Doctor Detail</li>
                </ul>
         </div>
     </section>
     <!--End Page Title-->
      
      <!-- Doctor Detail Section -->
     <section class="doctor-detail">
         <div class="auto-container">
             <!-- Upper Box -->
             <div class="upper-box">
                 <div class="row clearfix">
                     
                     <div class="detail-column col-lg-8 col-md-12 col-sm-12">
                         <div class="inner-box">
                             <div class="info-header">
                                 <p>Provide Comprehensive Quality Care</p>
                                 <h3>I‘m Dr. Johan Doe</h3>
                                 <span class="designation">Neurosurgeon</span>
                             </div>
                             <ul class="info-list">
                                 <li>
                                     <strong>Expertise</strong>
                                     <p>Cardiology</p>
                                     <p>Heart Specialist</p>
                                 </li>
                                 <li>
                                     <strong>Education</strong>
                                     <p>Doctor of Medicine, University of Texas, USA (1990) Medical Orientation Program, St. Louis University (St. Louis, Missouri 1996)</p>
                                 </li>
                                 <li>
                                     <strong>Experience</strong>
                                     <p>15 years of Experience in Medicine</p>
                                 </li>
                                 <li>
                                     <strong>Profession</strong>
                                     <p>MD Dean and Executive Vice President for Medical Affairs School of Medicine and Graduate School of Biomedical Sciences University of Texas Health Science Center at San Antonio</p>
                                 </li>
                             </ul>
                         </div>
                     </div>
                          
                          <div class="image-box col-lg-4 col-md-12 col-sm-12">
                         <div class="image"><a href="images/resource/doctor-3.jpg" class="lightbox-image"><img src="images/resource/doctor-3.jpg" alt=""></a></div>
                     </div>
                          
                 </div>
             </div>
 
             <!-- Lower Content -->
             <div class="lower-content">
                 <div class="row clearfix">
                          
                          <!-- Form Column -->
                     <div class="form-column col-lg-8 col-md-12 col-sm-12">
                         <div class="inner-box">
                             <div class="appointment-form">
                                         <div class="sec-title centered">
                                              <h2>Appointment Form</h2>
                                              <p>Get to Book Your Appointment Now</p>
                                         </div>
                                 
                                 <form method="post" action="appointment.html">
                                     <div class="row clearfix">
                                         <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                             <input type="text" name="username" placeholder="Name" required="">
                                             <span class="icon fa fa-user"></span>
                                         </div>
                                         
                                         <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                             <input type="email" name="email" placeholder="Email" required="">
                                             <span class="icon fa fa-envelope"></span>
                                         </div>
 
                                         <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                             <input type="tel" name="phone" placeholder="Phone No" required="">
                                             <span class="icon fas fa-phone"></span>
                                         </div>
 
                                         <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                             <select class="custom-select-box">
                                                 <option>Cardiology Department</option>
                                                 <option>Neurology Department</option>
                                                 <option>Urology Department</option>
                                                 <option>Gynecological Conditions</option>
                                                 <option>Pediatric Department</option>
                                                 <option>Laboratory Department</option>
                                             </select>
                                         </div>
 
                                         <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                             <input type="text" name="day" placeholder="Day">
                                             <span class="icon fa fa-calendar"></span>
                                         </div>
 
                                         <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                             <input type="text" name="time" placeholder="Time" class="">
                                             <span class="icon far fa-clock"></span>
                                         </div>
                                         
                                         <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                             <textarea name="message" placeholder="Message"></textarea>
                                         </div>
 
                                         <div class="col-md-12 col-sm-12 col-xs-12 form-group text-center">
                                             <button class="theme-btn btn-style-two" type="submit" name="submit-form"><span class="txt">Book Appointment</span></button>
                                         </div>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                          
                     <!-- Info Column -->
                     <div class="info-column col-lg-4 col-md-12 col-sm-12">
                         <div class="inner-box">
                             <ul class="contact-list">
                                 <li><span>E-mail:</span> example@company.com</li>
                                 <li><span>Phone: </span> +000 000 0000</li>
                                 <li><span>Timming:</span> 9:00am -5:00pm</li>
                                         <li class="clearfix">
                                              <a href="#" class="clearfix theme-btn btn-style-two"><span class="txt btn-txt">On Vacation</span></a>
                                              <span class="pull-right time">12:00pm -3:00pm</span>
                                         </li>
                             </ul>
 
                             <ul class="social-icon-one">
                                 <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                 <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                 <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                 <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                             </ul>
 
                             <div class="timetable">
                                 <h3><small>Check Our</small> Weekly Timetable</h3>
                                 <p>Suspendisse potenti. Maecenas dapibus ac tellus sed pulvinar. Vestibulum bib volutpat accumsan non laoreet nulla luctus...</p>
                                 <ul>
                                     <li>Monday - Friday <span>8.00 - 18.00</span></li>
                                     <li>Saturday <span>9.00 - 16.00</span></li>
                                     <li>Sunday <span>9.00 - 16.00</span></li>
                                 </ul>
                                 <a href="#" class="theme-btn doctor-btn"><i class="fa fa-user-md"></i> See Doctors Time Table</a>
                             </div>
                         </div>
                     </div>
 
                 </div>
             </div>
         </div>
     </section>
     <!-- End Doctor Detail Section -->
      
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