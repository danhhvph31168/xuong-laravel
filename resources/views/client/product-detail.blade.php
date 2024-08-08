@extends('client.layouts.master')

@section('content')
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($product->galleries as $item)
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                        <div class="product__thumb__pic set-bg"
                                            @if (!\Str::contains($item->image, 'http')) data-setbg="{{ \Storage::url($item->image) }}"
                                            @else data-setbg="{{ $item->image }}" @endif>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    @if (!\Str::contains($product->img_thumbnail, 'http'))
                                        <img src="{{ \Storage::url($product->img_thumbnail) }}" alt="">
                                    @else
                                        <img src="{{ $product->img_thumbnail }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product->name }}</h4>
                            <div class="rating">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                <span> - 5 Reviews</span>
                            </div>
                            <h3>${{ number_format($product->price_sale) }}
                                <span>{{ number_format($product->price_regular) }}</span>
                            </h3>
                            <p>{{ $product->description }}</p>

                            <form action="{{ route('cart.add') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="product__details__option">
                                    <div class="product__details__option__size">
                                        <span>Size:</span>
                                        @foreach ($sizes as $id => $name)
                                            <label for="radio_size_{{ $id }}">{{ $name }}
                                                <input type="radio" id="radio_size_{{ $id }}" name="product_size_id" value="{{ $id }}">
                                            </label>
                                        @endforeach
                                    </div>
                                    <div class="product__details__option__color">
                                        <span>Color:</span>
                                        @foreach ($colors as $id => $name)
                                            <input type="radio" id="radio_color_{{ $id }}" name="product_color_id" value="{{ $id }}">
                                            <label style="background: {{ $name }};"></label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="product__details__cart__option">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" name="quatity">
                                        </div>
                                    </div>
                                    <button type="submit" class="primary-btn border-0">Thêm giỏ hàng</button>
                                </div>
                            </form>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="/theme/client/img/shop-details/details-payment.png" alt="">
                                <ul>
                                    <li><span>SKU:</span> {{ $product->sku }}</li>
                                    <li><span>Danh mục:</span> {{ $product->catelogue->name }}</li>
                                    <li><span>Tag:</span>
                                        @foreach ($product->tags as $item)
                                            {{ $item->name }}
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                        role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                        information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="/theme/client/img/product/product-1.jpg">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="/theme/client/img/icon/heart.png" alt=""></a>
                                </li>
                                <li><a href="#"><img src="/theme/client/img/icon/compare.png" alt="">
                                        <span>Compare</span></a></li>
                                <li><a href="#"><img src="/theme/client/img/icon/search.png" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Piqué Biker Jacket</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$67.24</h5>
                            <div class="product__color__select">
                                <label for="pc-1">
                                    <input type="radio" id="pc-1">
                                </label>
                                <label class="active black" for="pc-2">
                                    <input type="radio" id="pc-2">
                                </label>
                                <label class="grey" for="pc-3">
                                    <input type="radio" id="pc-3">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="/theme/client/img/product/product-2.jpg">
                            <ul class="product__hover">
                                <li><a href="#"><img src="/theme/client/img/icon/heart.png" alt=""></a>
                                </li>
                                <li><a href="#"><img src="/theme/client/img/icon/compare.png" alt="">
                                        <span>Compare</span></a></li>
                                <li><a href="#"><img src="/theme/client/img/icon/search.png" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Piqué Biker Jacket</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$67.24</h5>
                            <div class="product__color__select">
                                <label for="pc-4">
                                    <input type="radio" id="pc-4">
                                </label>
                                <label class="active black" for="pc-5">
                                    <input type="radio" id="pc-5">
                                </label>
                                <label class="grey" for="pc-6">
                                    <input type="radio" id="pc-6">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item sale">
                        <div class="product__item__pic set-bg" data-setbg="/theme/client/img/product/product-3.jpg">
                            <span class="label">Sale</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="/theme/client/img/icon/heart.png" alt=""></a>
                                </li>
                                <li><a href="#"><img src="/theme/client/img/icon/compare.png" alt="">
                                        <span>Compare</span></a></li>
                                <li><a href="#"><img src="/theme/client/img/icon/search.png" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Multi-pocket Chest Bag</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$43.48</h5>
                            <div class="product__color__select">
                                <label for="pc-7">
                                    <input type="radio" id="pc-7">
                                </label>
                                <label class="active black" for="pc-8">
                                    <input type="radio" id="pc-8">
                                </label>
                                <label class="grey" for="pc-9">
                                    <input type="radio" id="pc-9">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="/theme/client/img/product/product-4.jpg">
                            <ul class="product__hover">
                                <li><a href="#"><img src="/theme/client/img/icon/heart.png" alt=""></a>
                                </li>
                                <li><a href="#"><img src="/theme/client/img/icon/compare.png" alt="">
                                        <span>Compare</span></a></li>
                                <li><a href="#"><img src="/theme/client/img/icon/search.png" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Diagonal Textured Cap</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$60.9</h5>
                            <div class="product__color__select">
                                <label for="pc-10">
                                    <input type="radio" id="pc-10">
                                </label>
                                <label class="active black" for="pc-11">
                                    <input type="radio" id="pc-11">
                                </label>
                                <label class="grey" for="pc-12">
                                    <input type="radio" id="pc-12">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related Section End -->
@endsection
