<div class="nav-outer clearfix">
    <!--Mobile Navigation Toggler For Mobile--><div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
    <nav class="main-menu navbar-expand-md navbar-light">
        <div class="navbar-header">
            <!-- Togg le Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon flaticon-menu"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
            <ul class="navigation clearfix">
                <li class="current dropdown"><a href="#">الرئيسية</a>
                    <ul>
                        <li><a href="index.html">Home page 01</a></li>
                        <li><a href="index-2.html">Home page 02</a></li>
                        <li><a href="index-3.html">Home page 03</a></li>
                        <li><a href="index-4.html">Home page 04</a></li>
                        <li class="dropdown"><a href="#">Header Styles</a>
                            <ul>
                                <li><a href="index.html">Header Style One</a></li>
                                <li><a href="index-2.html">Header Style Two</a></li>
                                <li><a href="index-3.html">Header Style Three</a></li>
                                <li><a href="index-4.html">Header Style Four</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#">من نحن</a>
                    <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="team.html">Our Team</a></li>
                        <li><a href="faq.html">Faq</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="comming-soon.html">Comming Soon</a></li>
                    </ul>
                </li>
                <li class="dropdown has-mega-menu"><a href="#">الصفحات</a>
                    <div class="mega-menu">
                        <div class="mega-menu-bar row clearfix">
                            <div class="column col-md-3 col-xs-12">
                                <h3>About Us</h3>
                                <ul>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="team.html">Our Team</a></li>
                                    <li><a href="faq.html">Faq</a></li>
                                    <li><a href="services.html">Services</a></li>
                                </ul>
                            </div>
                            <div class="column col-md-3 col-xs-12">
                                <h3>Doctors</h3>
                                <ul>
                                    <li><a href="doctors.html">Doctors</a></li>
                                    <li><a href="doctors-detail.html">Doctors Detail</a></li>
                                </ul>
                            </div>
                            <div class="column col-md-3 col-xs-12">
                                <h3>Blog</h3>
                                <ul>
                                    <li><a href="blog.html">Our Blog</a></li>
                                    <li><a href="blog-classic.html">Blog Classic</a></li>
                                    <li><a href="blog-detail.html">Blog Detail</a></li>
                                </ul>
                            </div>
                            <div class="column col-md-3 col-xs-12">
                                <h3>Shops</h3>
                                <ul>
                                    <li><a href="shop.html">Shop</a></li>
                                    <li><a href="shop-single.html">Shop Details</a></li>
                                    <li><a href="shoping-cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout Page</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown"><a href="#">الاطباء</a>
                    <ul>
                        <li><a href="doctors.html">Doctors</a></li>
                        <li><a href="doctors-detail.html">Doctors Detail</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#">الاقسام</a>
                    <ul>
                        <li><a href="department.html">Department</a></li>
                        <li><a href="department-detail.html">Department Detail</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#">المقالات</a>
                    <ul>
                        <li><a href="blog.html">Our Blog</a></li>
                        <li><a href="blog-classic.html">Blog Classic</a></li>
                        <li><a href="blog-detail.html">Blog Detail</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#">المتجر</a>
                    <ul>
                        <li><a href="shop.html">Shop</a></li>
                        <li><a href="shop-single.html">Shop Details</a></li>
                        <li><a href="shoping-cart.html">Cart Page</a></li>
                        <li><a href="checkout.html">Checkout Page</a></li>
                    </ul>
                </li>

                <li><a href="contact.html">تواصل معانا</a></li>

                <li class="dropdown"><a href="#">{{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                    <ul>
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
    <!-- Main Menu End-->

    <!-- Main Menu End-->
    <div class="outer-box clearfix">
        <!-- Main Menu End-->
        <div class="nav-box">
            <div class="nav-btn nav-toggler navSidebar-button"><span class="icon flaticon-menu-1"></span></div>
        </div>

        <!-- Social Box -->
        <ul class="social-box clearfix">
            <li><a href="#"><span class="fab fa-facebook-f fa-spin" style="animation-duration: 10s;"></span></a></li>
            <li><a href="#"><span class="fab fa-twitter fa-spin" style="animation-duration: 10s;"></span></a></li>
            <li><a href="#"><span class="fab fa-linkedin-in fa-spin"style="animation-duration: 10s;"></span></a></li>
            @if (Auth::check())
                @if(auth()->user()->role_id==1)
                    &nbsp;&nbsp;
                    <li class="fa-duotone  fa-beat ">&nbsp;&nbsp;<a href="{{ route('dashboard-overview-1') }}" style="background-color: rgb(34, 217, 190) ; color:white ;width:100px"><span><i class="fa-sharp-duotone fa-solid fa-gauge fa-1x" style="--fa-primary-color: #474582; --fa-secondary-color: #327b33;"></i>&nbsp;&nbsp;dashboard</span></a>&nbsp;&nbsp; </li>
                @elseif(auth()->user()->role_id==2)
                <li class="fa-duotone  fa-beat ">&nbsp;&nbsp;<a href="{{ route('alert1') }}" style="background-color: rgb(34, 217, 190) ; color:white ;width:100px"><span><i class="fa-sharp-duotone fa-solid fa-gauge fa-1x" style="--fa-primary-color: #474582; --fa-secondary-color: #327b33;"></i>&nbsp;&nbsp;dashboard</span></a>&nbsp;&nbsp; </li>
                @elseif(auth()->user()->role_id==3)
                <li class="fa-duotone  fa-beat ">&nbsp;&nbsp;<a href="{{ route('dashboard-overview-Patient') }}" style="background-color: rgb(34, 217, 190) ; color:white ;width:100px"><span><i class="fa-sharp-duotone fa-solid fa-gauge fa-1x" style="--fa-primary-color: #474582; --fa-secondary-color: #327b33;"></i>&nbsp;&nbsp;dashboard</span></a>&nbsp;&nbsp; </li>
                @elseif(auth()->user()->role_id==4)
                <li class="fa-duotone  fa-beat ">&nbsp;&nbsp;<a href="{{ route('dashboard-ray-emplyee') }}" style="background-color: rgb(34, 217, 190) ; color:white ;width:100px"><span><i class="fa-sharp-duotone fa-solid fa-gauge fa-1x" style="--fa-primary-color: #474582; --fa-secondary-color: #327b33;"></i>&nbsp;&nbsp;dashboard</span></a>&nbsp;&nbsp; </li>
                @elseif(auth()->user()->role_id==5)
                <li class="fa-duotone  fa-beat ">&nbsp;&nbsp;<a href="{{ route('dashboard-lab-emplyee') }}" style="background-color: rgb(34, 217, 190) ; color:white ;width:100px"><span><i class="fa-sharp-duotone fa-solid fa-gauge fa-1x" style="--fa-primary-color: #474582; --fa-secondary-color: #327b33;"></i>&nbsp;&nbsp;dashboard</span></a>&nbsp;&nbsp; </li>
                @endif
            @endif

            @if (Auth::check())
            <li>
                <a style="width:100px" title="تسجيل الخروج" href="{{ route('logout') }}"><span style="font-size: 15px">logout &nbsp;&nbsp;</span></span><i class="fa-duotone fa-left-from-bracket fa-beat fa-1x" style="--fa-primary-color: #5cb450; --fa-secondary-color: #327b33;"></i>
                </span></a>
            </li>
            {{-- <a style="width:100px" title="تسجيل الخروج" href="{{ route('logout') }}"><span class="fas fa-user">&nbsp;&nbsp;<span style="font-size: 10px">logout</span></span></a> --}}

            <li><p style="color:white"> &nbsp;&nbsp; <span class="fa-duotone  fa-beat fa-1x" style="color:rgb(34, 217, 190)">{{ Auth::user()->name }} &nbsp;</span>&nbsp;&nbsp;مرحباً&nbsp;&nbsp;</p></li>
                
            @else
            <li  >
                <a style="width:100px" title="تسجيل دخول" href="{{ route('login') }}"><span class="fa-duotone  fa-beat fa-1x" style="font-size: 15px">login &nbsp;&nbsp;</span></span><i class="fa-duotone fa-right-to-bracket fa-beat fa-1x" style="--fa-primary-color: #27cf91; --fa-secondary-color: #272968;"></i>
            </li>
            @endif



        </ul>

        <!-- Search Btn -->
        

    </div>
</div>
