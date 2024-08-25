@extends('client.layouts.master')

@section('content')
    <!-- Product Section Begin -->
    <section class="product spad mt-5">
        <div class="container">
            <div class="row product__filter">
                @foreach ($products as $item)
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
                {{ $products->links() }}

            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
