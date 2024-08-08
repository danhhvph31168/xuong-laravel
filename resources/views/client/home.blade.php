@extends('client.layouts.master')

@section('content')
    @include('client.layouts.partials.banner')
    {{-- <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="/theme/client/img/banner/banner-1.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Quần áo nam</h2>
                            <a href="#">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="/theme/client/img/banner/banner-2.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Phụ kiện</h2>
                            <a href="#">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="/theme/client/img/banner/banner-3.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Quần áo nữ</h2>
                            <a href="#">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End --> --}}

    <!-- Product Section Begin -->
    <section class="product spad mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">Best Sellers</li>
                        <li data-filter=".new-arrivals">New Arrivals</li>
                        <li data-filter=".hot-sales">Hot Sales</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                @foreach ($product as $item)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg"
                                @if (!\Str::contains($item->img_thumbnail, 'http')) data-setbg="{{ \Storage::url($item->img_thumbnail) }}" @else
                                    data-setbg="{{ $item->img_thumbnail }}" @endif>

                                @if ($item->is_new)
                                    <span class="label">New</span>
                                @elseif ($item->is_hot_deal)
                                    <span class="label">Hot</span>
                                @elseif ($item->is_good_deal)
                                    <span class="label">Good</span>
                                @endif

                                <ul class="product__hover">
                                    <li><a href="#"><img src="/theme/client/img/icon/heart.png" alt=""></a>
                                    </li>
                                    <li><a href="{{ route('product.detail', $item->slug) }}"><img width="37px"
                                                height="37px" src="/theme/client/img/icon/show2.png" alt="">
                                            <span>Show</span></a></li>
                                    <li><a href="#"><img src="/theme/client/img/icon/cart.png" alt=""></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product__item__text">
                                <h6>{{ $item->name }}</h6>
                                <a href="#" class="add-cart">+ Thêm giỏ hàng</a>
                                <div class="rating">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </div>
                                <h5>${{ number_format($item->price_sale) }}
                                    <del class="badge text-secondary">{{ number_format($item->price_regular) }}</del>
                                </h5>
                                <div class="product__color__select">
                                    @for ($i = 0; $i < 5; $i++)
                                        <label for="pc-{{ $i }}">
                                            <input type="radio" id="pc-{{ $i }}">
                                        </label>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="/theme/client/img/product-sale.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>$29.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>Multi-pocket Chest Bag Black</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Tin mới</span>
                        <h2>Thời trang Xu hướng mới</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="/theme/client/img/blog/blog-1.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="/theme/client/img/icon/calendar.png" alt=""> 16 February 2020</span>
                            <h5>What Curling Irons Are The Best Ones</h5>
                            <a href="#">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="/theme/client/img/blog/blog-2.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="/theme/client/img/icon/calendar.png" alt=""> 21 February 2020</span>
                            <h5>Eternity Bands Do Last Forever</h5>
                            <a href="#">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="/theme/client/img/blog/blog-3.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="/theme/client/img/icon/calendar.png" alt=""> 28 February 2020</span>
                            <h5>The Health Benefits Of Sunglasses</h5>
                            <a href="#">Đọc thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
@endsection
