@extends('client.layouts.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('order.save') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <h6 class="checkout__title">Chi tiết thanh toán</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Họ và tên<span>*</span></p>
                                        <input type="text" name="user_name" value="{{ auth()->user()?->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="user_email" value="{{ auth()->user()?->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Địa chỉ<span>*</span></p>
                                        <input type="text" name="user_phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text" name="user_address">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span>*</span></p>
                                <textarea class="form-control" name="user_note" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Sản phẩm của bạn</h4>
                                <div class="checkout__order__products">Thông tin sản phẩm</div>

                                @foreach ($cart as $item)
                                    <ul class="checkout__total__products d-flex">
                                        <li style="margin-right: 10px">
                                            @if (!\Str::contains($item['img_thumbnail'], 'http'))
                                                <img src="{{ \Storage::url($item['img_thumbnail']) }}" width="100px"
                                                    height="100px">
                                            @else
                                                <img src="{{ $item['img_thumbnail'] }}" width="100px" height="100px">
                                            @endif
                                        </li>

                                        <li>{{ \Str::limit($item['name'], 30) }}
                                            <br>Giá: <span>${{ number_format($item['price_sale']) }}</span>
                                            <br>Số lượng: <span> {{ $item['quatity'] }}</span>
                                            <br>Tổng tiền:
                                            <span>${{ number_format($item['quatity'] * $item['price_sale']) }}</span>
                                        </li>
                                    </ul>
                                @endforeach

                                <ul class="checkout__total__all">
                                    <li>Tổng cộng <span>${{ number_format($totalAmount) }}</span></li>
                                </ul>

                                <button type="submit" class="site-btn">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
