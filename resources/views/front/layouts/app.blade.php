<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Sip & Snug">
      <meta name="description" content="Sip & Snug - Coffee House, Fresh Drinks & Cozy Vibes">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Sip & Snug Cafe - Coffee House</title>
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet"/>
      <!-- Bootstrap 5.3 -->
      <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet"/>
      <!-- AOS Animate on Scroll -->
      <link href="{{ asset('front/css/aos.css') }}" rel="stylesheet"/>
      <!-- Swiper -->
      <link href="{{ asset('front/css/swiper-bundle.min.css') }}" rel="stylesheet"/>
      <!-- all min css -->
      <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}"/>
      <!-- magnific CSS -->
      <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}"/>
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
   </head>
   <body>
      <!-- ============================================================
         TOP BAR
         ============================================================ -->
      <div id="topbar">
         <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
               <div class="top-contact d-flex flex-wrap">
                  <span><i class="fas fa-phone-alt"></i>19696</span>
                  <span><i class="fas fa-envelope"></i>SipnSnug@gmail.com</span>
                  <span><i class="fas fa-map-marker-alt"></i>Nasrcity, cairo</span>
               </div>
               <div class="d-flex align-items-center gap-3">
                  <span class="ttag"><i class="fas fa-fire me-1"></i>Free Delivery Today!</span>
                  <div class="tsoc">
                     <a href="#"><i class="fab fa-facebook-f"></i></a>
                     <a href="#"><i class="fab fa-instagram"></i></a>
                     <a href="#"><i class="fab fa-tiktok"></i></a>
                     <a href="#"><i class="fab fa-youtube"></i></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- ============================================================
         NAVBAR
         ============================================================ -->
      <nav class="navbar navbar-expand-lg" id="nav">
         <div class="container">
            <a class="navbar-brand" href="#">
               <div class="blogo">
                  <div class="bico"><i class="fas fa-mug-hot"></i></div>
                  <div>
                     <div class="bname">Sip&<span>Snug</span></div>
                     <div class="bsub">Coffee House & Cafe</div>
                  </div>
               </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <i class="fas fa-bars" style="color:var(--primary);font-size:1.35rem;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
               <ul class="navbar-nav mx-auto">
                  <li class="nav-item"><a class="nav-link active" href="{{ url('/#hero') }}">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#about') }}">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#menu') }}">Menu</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#chefs') }}">Baristas</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#reservation') }}">Visit</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#testimonials') }}">Reviews</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#contact-section') }}">Contact</a></li>
               </ul>
               <div class="d-flex align-items-center gap-2">
                  <!-- FIX 1: Search button -->
                  <button id="navSearchBtn" title="Search" class="btn" style="color:var(--primary);"><i class="fas fa-search"></i></button>
                  
                  @guest
                      <a href="{{ route('login') }}" class="nav-link" style="color:var(--primary); font-weight:600;"><i class="fas fa-user"></i> Login</a>
                  @else
                      <div class="dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" style="color:var(--primary); font-weight:600;">
                              <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end" style="border:none; box-shadow:0 10px 30px rgba(0,0,0,0.08); border-radius:12px;">
                              <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li>
                                  <form method="POST" action="{{ route('logout') }}">
                                      @csrf
                                      <button type="submit" class="dropdown-item text-danger">Logout</button>
                                  </form>
                              </li>
                          </ul>
                      </div>
                  @endguest

                  <a href="{{ url('/#menu') }}" class="nav-link nav-cta"><i class="fas fa-shopping-bag me-1"></i>Order Now</a>
               </div>
            </div>
         </div>
      </nav>
      <!-- ============================================================
         FIX 1 � SEARCH OVERLAY POPUP
         ============================================================ -->
      <div id="searchOv">
         <button class="sovclose" id="searchClose"><i class="fas fa-times"></i></button>
         <div class="sovbox">
            <h4>What would you like to sip today?</h4>
            <div class="sovinput">
               <input type="text" id="searchInput" placeholder="Search coffee, matcha, smoothies..." autocomplete="off"/>
               <button><i class="fas fa-search"></i></button>
            </div>
            <div class="sovcats">
               <div class="sovcat active" data-cat="all">
                  <img src="{{ asset('front/photos/coffee/esspresso.jpg') }}" alt=""/>All Drinks
               </div>
               <div class="sovcat" data-cat="coffee">
                  <img src="{{ asset('front/photos/coffee/hot latte.jpg') }}" alt=""/>Coffee
               </div>
               <div class="sovcat" data-cat="matcha">
                  <img src="{{ asset('front/photos/matcha/iced matcha .jpg') }}" alt=""/>Matcha
               </div>
               <div class="sovcat" data-cat="fresh juice">
                  <img src="{{ asset('front/photos/fresh juice/orange juice.jpg') }}" alt=""/>Fresh Juice
               </div>
               <div class="sovcat" data-cat="refreshers">
                  <img src="{{ asset('front/photos/refreshers/refreshers.jpg') }}" alt=""/>Refreshers
               </div>
               <div class="sovcat" data-cat="smoothies">
                  <img src="{{ asset('front/photos/smoothies/mango smoothie.jpg') }}" alt=""/>Smoothies
               </div>
            </div>
            <div class="sovtrend">
               <p><i class="fas fa-fire me-1" style="color:var(--secondary);"></i>Trending Searches</p>
               <span class="ttag">Caramel Latte</span>
               <span class="ttag">Iced Matcha</span>
               <span class="ttag">Berry Refresher</span>
               <span class="ttag">Mango Smoothie</span>
               <span class="ttag">Orange Juice</span>
               <span class="ttag">Cold Brew</span>
            </div>
         </div>
      </div>
      
        @yield('content')
<!-- FOOTER -->
      <footer>
         <div class="container">
            <div class="row g-5">
               <div class="col-lg-4">
                  <div class="fnm">Sip&<span>Snug</span></div>
                  <p class="fdesc">We bring cozy comfort and crafted drinks together in a warm, welcoming space. Every cup is made with care.</p>
                  <div class="fsoc">
                     <a href="#"><i class="fab fa-facebook-f"></i></a>
                     <a href="#"><i class="fab fa-instagram"></i></a>
                     <a href="#"><i class="fab fa-twitter"></i></a>
                     <a href="#"><i class="fab fa-youtube"></i></a>
                     <a href="#"><i class="fab fa-tiktok"></i></a>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-2">
                  <div class="ftit">Quick Links</div>
                  <ul class="flinks ps-0">
                     <li><a href="{{ url('/#hero') }}"><i class="fas fa-chevron-right"></i>Home</a></li>
                     <li><a href="{{ url('/#about') }}"><i class="fas fa-chevron-right"></i>About Us</a></li>
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Our Menu</a></li>
                     <li><a href="{{ url('/#reservation') }}"><i class="fas fa-chevron-right"></i>Reservation</a></li>
                     <li><a href="#blog"><i class="fas fa-chevron-right"></i>Blog</a></li>
                     <li><a href="{{ url('/#contact-section') }}"><i class="fas fa-chevron-right"></i>Contact</a></li>
                  </ul>
               </div>
               <div class="col-sm-6 col-lg-2">
                  <div class="ftit">Our Menu</div>
                  <ul class="flinks ps-0">
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Coffee</a></li>
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Matcha</a></li>
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Fresh Juice</a></li>
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Refreshers</a></li>
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Smoothies</a></li>
                  </ul>
               </div>
               <div class="col-lg-4">
                  <div class="ftit">Get In Touch</div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-map-marker-alt"></i></div>
                     <div class="fciinfo"><strong>Address</strong>Nasrcity, EG</div>
                  </div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-phone-alt"></i></div>
                     <div class="fciinfo"><strong>Phone</strong>19696</div>
                  </div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-envelope"></i></div>
                     <div class="fciinfo"><strong>Email</strong>SipnSnug@gmail.com</div>
                  </div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-clock"></i></div>
                     <div class="fciinfo"><strong>Hours</strong>Wed - Sun: 09 AM - 11 PM</div>
                  </div>
               </div>
            </div>
         </div>
         <div class="fbot">
            <div class="container">
               <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                  <p>&copy 2026 <span>Sip & Snug Cafe</span>. All Rights Reserved by <a target="_blank" class="mx-0 fw-bold text-success" href="https://bestwpware.com/">Bestwpware</a>. Made with <span><i class="fas fa-heart"></i></span>  <br>Distributed by <a target="_blank" class="mx-0 fw-bold text-success" href="https://themewagon.com">ThemeWagon</a></p>
                  <div><a href="#">Privacy Policy</a><a href="#">Terms</a><a href="#">Cookies</a></div>
               </div>
            </div>
         </div>
      </footer>
      <!-- Floating cart -->
      @auth
      <a href="{{ route('cart.index') }}" class="cartfl text-decoration-none">
          <i class="fas fa-shopping-cart"></i>
          <span>My Cart</span>
          <div class="ccount" id="cartCount">0</div>
      </a>
      @else
      <a href="{{ route('login') }}" class="cartfl text-decoration-none">
          <i class="fas fa-shopping-cart"></i>
          <span>My Cart</span>
      </a>
      @endauth
      <!-- Back to top -->
      <button id="btt" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="fas fa-chevron-up"></i></button>
    
	<!-- jQuery -->
      <script src="{{ asset('front/js/jquery-3.7.1.min.js') }}"></script>
      <!-- Bootstrap 5 -->
      <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AOS -->
      <script src="{{ asset('front/js/aos.js') }}"></script>
      <!-- Swiper -->
      <script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
      <!-- CounterUp -->
      <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
      <!-- Main js -->
      <script src="{{ asset('front/js/main.js') }}"></script>
      
      @auth
      <script>
        function updateGlobalCartCount() {
            fetch('/api/v1/cart', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.data && data.data.items) {
                    let totalQty = 0;
                    data.data.items.forEach(item => totalQty += parseInt(item.quantity));
                    document.getElementById('cartCount').textContent = totalQty;
                }
            })
            .catch(console.error);
        }
        
        document.addEventListener('DOMContentLoaded', updateGlobalCartCount);
      </script>
      @endauth
   </body>
</html>
