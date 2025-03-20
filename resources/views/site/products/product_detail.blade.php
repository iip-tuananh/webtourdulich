@extends('site.layouts.master')
@section('title')
    {{ $product->name }}
@endsection
@section('description')
    {{ strip_tags($product->intro) }}
@endsection

@section('css')
    <style>
        .text-limit-3-line {
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <main ng-controller="ProductDetailController" ng-cloak>
        <section class="breadcrumb-section section-space-ptb section-space-pb border-bottom-1 border-top-1" style="background-color: #f6f6f6;">
            <div class="breadcrumb-content text-center">
                <h2 class="mb-2">{{ $product->name }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{route('front.home-page')}}">Trang chủ</a></li>
                        @if($product->cate_id)
                            <li class="breadcrumb-item"><a href="{{route('front.show-product-category', $product->category->slug)}}">{{ $product->category->name }}</a></li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
        </section>
        <!-- Product Details Section Start -->
        <section class="product-details-section section-space-ptb">
            <div class="container">
                <div class="row  gy-5">
                    <div class="col-md-6">
                        <div class="swiper product-details-lg-active">
                            <div class="swiper-wrapper">
                                @foreach ($product->galleries as $item)
                                    <div class="swiper-slide">
                                        <img class="w-full" src="{{$item->image->path}}" loading="lazy"/>
                                    </div>
                                @endforeach
                                @if($product->image)
                                    <div class="swiper-slide">
                                        <img class="w-full" src="{{$product->image->path}}" loading="lazy"/>
                                    </div>
                                @endif
                                @if($product->image_back)
                                    <div class="swiper-slide">
                                        <img class="w-full" src="{{$product->image_back->path}}" loading="lazy"/>
                                    </div>
                                @endif
                            </div>
                            <div class="product-details-button-next product-details-navigation-next"><i
                                    class="icon-rt-arrow-right"></i></div>
                            <div class="product-details-button-prev product-details-navigation-prev"><i
                                    class="icon-rt-arrow-left"></i></div>
                        </div>
                        <div class="swiper product-details-sm-thum-active mt-2">
                            <div class="swiper-wrapper">
                                @foreach ($product->galleries as $item)
                                    <div class="swiper-slide">
                                        <img src="{{$item->image->path}}" loading="lazy"/>
                                    </div>
                                @endforeach
                                @if($product->image)
                                    <div class="swiper-slide">
                                        <img src="{{$product->image->path}}" loading="lazy"/>
                                    </div>
                                @endif
                                @if($product->image_back)
                                    <div class="swiper-slide">
                                        <img src="{{$product->image_back->path}}" loading="lazy"/>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-item-details-box">
                            <h4 class="product-item-details-title">{{$product->name}}</h4>
                            <div class="product-item-details-rating d-flex align-items-center gap-2 text-black">
                                <div class="product-item-details-rating-list d-flex">
                                    <i class="icon-rt-star-solid"></i>
                                    <i class="icon-rt-star-solid"></i>
                                    <i class="icon-rt-star-solid"></i>
                                    <i class="icon-rt-star-solid"></i>
                                    <i class="icon-rt-star-solid"></i>
                                </div>
                                <a href="#">(Đánh giá sản phẩm 5 sao)</a>
                            </div>
                            {{-- <div class="product-card-price mt-2">
                                @if($product->base_price > 0)
                                    <span class="product-card-old-price"><del>{{number_format($product->base_price)}}đ</del></span>
                                @endif
                                <span class="product-card-regular-price">{{number_format($product->price)}}đ</span>
                            </div> --}}
                            <p class="product-item-details-description mt-2">
                                {!! $product->intro !!}
                            </p>
                            @if(isset($product->attributes) && count($product->attributes) > 0)
                            @foreach ($product->attributes as $index => $attribute)
                                <div class="mt-2 product-attributes">
                                    <label>{{ $attribute['name'] }}</label>
                                    <div class="product-attribute-values">
                                        @foreach ($attribute['values'] as $value)
                                            <div class="badge badge-primary" data-value="{{ $value }}" data-name="{{ $attribute['name'] }}" data-index="{{ $index }}">{{ $value }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            @endif
                            <div class="product-item-action-box d-flex gap-2 align-items-center">
                                {{-- <form class="product-item-quantity">
                                    <button class="product-item-quantity-decrement product-item-quantity-button"
                                        type="button">-</button>
                                    <input type="text" class="product-item-quantity-input" name="quantity" ng-model="form.quantity"
                                        min="1" max="100" id="qty-input">
                                    <button class="product-item-quantity-increment product-item-quantity-button"
                                        type="button">+</button>
                                </form> --}}
                                {{-- <button class="btn btn-primary btn-lg" ng-click="addToCartFromProductDetail()">Thêm vào giỏ hàng</button> --}}
                                <a class="btn btn-primary btn-lg" href="{{route('front.product-custom')}}?product_id={{ $product->id }}">Tạo thiết kế</a>
                            </div>
                            <div class="social-share-wrap d-flex gap-1 mt-3">
                                <p class="fs-16">SHARE: </p>
                                <div class="social-share social-share-in-color d-flex gap-2">
                                    <a class="social-share-link facebook" href="https://www.facebook.com/"
                                        target="_blank" aria-label="facebook">
                                        <i class="icon-rt-4-facebook-f"></i>
                                    </a>
                                    <a class="social-share-link twitter" href="https://twitter.com/" target="_blank"
                                        aria-label="twitter">
                                        <i class="icon-rt-logo-twitter"></i>
                                    </a>
                                    <a class="social-share-link instagram" href="https://instagram.com/"
                                        target="_blank" aria-label="instagram">
                                        <i class="icon-rt-logo-instagram"></i>
                                    </a>
                                    <a class="social-share-link pinterest" href="https://www.pinterest.com/"
                                        target="_blank" aria-label="pinterest">
                                        <i class="icon-rt-6-pinterest-p"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Details Section End -->
        <!-- product Info Section Start -->
        <section class="product-info-wrapper section-space-ptb">
            <div class="container">
                <div class="nav product-tab-info justify-content-center" role="tablist">
                    <button class="product-tab-info-link active" data-bs-toggle="tab"
                        data-bs-target="#nav-description" type="button" role="tab">Thông tin chi tiết</button>
                </div>
                <div class="tab-content mt-6">
                    <div class="tab-pane fade show active" id="nav-description" role="tabpanel" tabindex="0">
                        {!! $product->body !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- product Info Section End -->
        <!-- Related Products Section Start -->
        @if($productsRelated->count() > 0)
        <section class="related-products-section section-space-pb border-bottom-1">
            <div class="container">
                <div class="section-title text-center">
                    <h2 class="title">Sản phẩm tương tự</h2>
                </div>
                <!-- Swiper Slider Main Start -->
                <div class="swiper product-slider-two-active position-relative">
                    <!-- Swiper Wrapper Start -->
                    <div class="swiper-wrapper">
                        <!-- Swiper Slide Item Start -->
                        @foreach ($productsRelated as $item)
                        <div class="swiper-slide">
                            <!-- Product Card Start -->
                            @include('site.products.product_item', ['product' => $item])
                            <!-- Product Card End -->
                        </div>
                        @endforeach
                        <!-- Swiper Slide Item End -->
                    </div>
                    <!-- swiper Navigation -->
                    <div class="product-swiper-button-next swiper-navigation-next"><i class="icon-rt-arrow-right"></i>
                    </div>
                    <div class="product-swiper-button-prev swiper-navigation-prev"><i class="icon-rt-arrow-left"></i>
                    </div>
                </div>
                <!-- Swiper Slider Main End -->
            </div>
        </section>
        @endif
        <!-- Related Products Section End -->
    </main>
@endsection

@push('script')
    <script>
        app.controller('ProductDetailController', function($scope, $http, $interval, cartItemSync, $rootScope, $compile) {
            $scope.product = @json($product);

            $scope.selectedAttributes = [];
            jQuery('.product-attribute-values .badge').click(function() {
                if(!jQuery(this).hasClass('active')) {
                    jQuery(this).parent().find('.badge').removeClass('active');
                    jQuery(this).addClass('active');
                    if ($scope.selectedAttributes.length > 0 && $scope.selectedAttributes.find(item => item.index == jQuery(this).data('index'))) {
                        $scope.selectedAttributes.find(item => item.index == jQuery(this).data('index')).value = jQuery(this).data('value');
                    } else {
                        let index = jQuery(this).data('index');
                        $scope.selectedAttributes.push({
                            index: index,
                            name: jQuery(this).data('name'),
                            value: jQuery(this).data('value'),
                        });
                    }
                } else {
                    jQuery(this).parent().find('.badge').removeClass('active');
                    jQuery(this).removeClass('active');
                    $scope.selectedAttributes = $scope.selectedAttributes.filter(item => item.index != jQuery(this).data('index'));
                }
                $scope.$apply();
            });

            $scope.form = {
                quantity: 1
            };

            $scope.addToCartFromProductDetail = function() {
                let quantity = jQuery('form input[name="quantity"]').val();
                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', $scope.product.id);

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(quantity),
                        'attributes': $scope.selectedAttributes
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.count > 0) {
                                $scope.hasItemInCart = true;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            toastr.success('Thao tác thành công !')
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }
        });
    </script>
@endpush
