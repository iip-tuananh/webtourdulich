@extends('site.layouts.master')
@section('title')
    Về chúng tôi
@endsection

@section('css')
@endsection

@section('content')
    <main>
        <!-- About Us Section Start -->
        <section class="about-us-section section-space-ptb border-top-1">
            <div class="container">
                <div class="about-us-section-header text-center mb-50">
                    <h2 class="about-us-title mb-6">Về chúng tôi</h2>
                    {!! $config->introduction !!}
                </div>
            </div>
        </section>
        <!-- About Us Section End -->
        <!-- Product Section Start -->
        <section class="product-section section-space-ptb bg-dark">
            <div class="container">
                <!-- Section Title Area Start -->
                <div class="section-title-area text-center">
                    <h2 class="section-title text-white">Đánh giá của khách hàng</h2>
                </div>
                <!-- Section Title Area End -->
                <!-- Swiper Slider Main Start -->
                <div class="swiper product-slider-active position-relative">
                    <!-- Swiper Wrapper Start -->
                    <div class="swiper-wrapper">
                        <!-- Swiper Slide Item Start -->
                        @foreach ($reviews as $review)
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p class="testimonial-content text-white">
                                    {{$review->message}}
                                </p>
                                <div class="testimonial-author-box justify-content-center">
                                    <div class="testimonial-author-thum">
                                        <img src="{{$review->image ? $review->image->path : ''}}" width="100"
                                            height="100" alt="Testimonial 01" loading="lazy">
                                    </div>
                                    <div class="testimonial-author">
                                        <p class="testimonial-author-name text-white">{{$review->name}}</p>
                                        <p class="testimonial-author-designation text-white">{{$review->position}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- Swiper Slide Item End -->
                    </div>
                    <div class="product-navigation-bottom-wrap">
                        <!-- swiper Navigation -->
                        <div class="product-swiper-button-prev swiper-navigation-bottom-prev z-1"><i
                                class="icon-rt-arrow-left"></i></div>
                        <div class="product-swiper-button-next swiper-navigation-bottom-next z-1"><i
                                class="icon-rt-arrow-right"></i></div>
                    </div>
                </div>
                <!-- Swiper Slider Main End -->
            </div>
        </section>
        <!-- Product Section End -->
        <!-- Patner Brand Section Start -->
        <section class="patner-brand-section section-space-ptb border-top-1">
            <div class="container">
                <h2 class="visually-hidden">Đối tác</h2>
                <!-- Swiper Slider Main Start -->
                <div class="swiper patner-brand-slider-active">
                    <!-- Swiper Wrapper Start -->
                    <div class="swiper-wrapper">
                        <!-- Swiper Slide Item Start -->
                        @foreach ($partners as $partner)
                        <div class="swiper-slide">
                            <a href="{{$partner->link}}" class="single-patner-brand" target="_blank">
                                <img src="{{$partner->image ? $partner->image->path : ''}}" width="207" height="46" alt="{{$partner->name}}"
                                    loading="lazy">
                            </a>
                        </div>
                        @endforeach
                        <!-- Swiper Slide Item End -->
                    </div>
                    <!-- Swiper Wrapper End -->
                </div>
                <!-- Swiper Slider Main End -->
            </div>
        </section>
        <!-- Patner Brand Section End -->
    </main>
@endsection

@push('script')
@endpush
