@extends('client.layouts.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->has('cart'))
                                    @foreach ($cart as $item)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    @if (!\Str::contains($item['img_thumbnail'], 'http'))
                                                        <img src="{{ \Storage::url($item['img_thumbnail']) }}"
                                                            width="100px" height="100px">
                                                    @else
                                                        <img src="{{ $item['img_thumbnail'] }}" width="100px"
                                                            height="100px">
                                                    @endif
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <a href="{{ route('product.detail', $item['slug']) }}">
                                                        <h6>{{ $item['name'] }}</h6>
                                                    </a>
                                                    <h5>${{ number_format($item['price_sale']) }}
                                                        <del
                                                            class="badge text-secondary">{{ number_format($item['price_regular']) }}</del>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input type="text" value="{{ $item['quatity'] }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">$
                                                {{ number_format($item['quatity'] * $item['price_sale']) }}
                                            </td>
                                            <td class="cart__close">
                                                <form action="{{ route('cart.deleteItem', $item) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="border-0 rounded-circle w-100 p-1"
                                                        onclick="return confirm('Chắc chắn chưa?')"><b>x</b></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('home') }}">Tiếp tục mua</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Xóa tất cả</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Mã giảm giá</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Áp dụng</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Tổng giỏ hàng</h6>
                        <ul>
                            <li>Tổng phụ <span>$ {{ number_format($totalAmount) }}</span></li>
                            <li>Tổng cộng <span>$ {{ number_format($totalAmount) }}</span></li>
                        </ul>
                        <a href="{{ route('order.check-out') }}" class="primary-btn">Mua hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
