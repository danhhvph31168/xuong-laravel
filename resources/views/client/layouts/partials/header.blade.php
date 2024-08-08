<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Mua Sắm Thả Ga - Giảm Giá Cực Sốc, Không Thể Bỏ Lỡ!</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__hover">
                            <span>Tài khoản <i class="arrow_carrot-down"></i></span>
                            <ul class="text-center">
                                @if (Route::has('login'))
                                    @auth
                                        <a href="{{ url('/') }}"><li class="my-1">{{ \Auth::user()->name }}</li></a>
                                        <a href="{{ route('logout') }}"><li class="my-1">Đăng xuất</li></a>
                                    @else
                                        <a href="{{ route('login') }}">
                                            <li class="my-1">Đăng nhập</li>
                                        </a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}">
                                                <li class="my-1">Đăng ký</li>
                                            </a>
                                        @endif
                                    @endauth
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="/theme/client/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="active"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="./shop.html">Nam</a></li>
                        <li><a href="./shop.html">Nữ</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./about.html">About Us</a></li>
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Tin tức</a></li>
                        <li><a href="./contact.html">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src="/theme/client/img/icon/search.png"
                            alt=""></a>
                    <a href="#"><img src="/theme/client/img/icon/heart.png" alt=""></a>
                    <a href="{{ route('cart.list') }}"><img src="/theme/client/img/icon/cart.png" alt=""> <span>0</span></a>
                    <div class="price">$0.00</div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->
