@extends('site.layouts.master')
@section('title')
    {{ $config->web_title }}
@endsection

@section('css')
@endsection

@section('content')
    <section class="qts_head_banner">
        <div class="owl-carousel slider_main">

            @foreach($banners as $banner)
                <div class="item">
                    <div class="img_banner">
                        <a href="">
                            <img alt="{{ $banner->title }}" class="asyncImage w_100" data-src="{{ @$banner->image->path ?? '' }}"/>
                        </a>
                    </div>
                </div>

            @endforeach

        </div>
    </section>

    <div ng-controller="homePage">
        <div class="container">
            <div class="row_pc">
                <div class="buttonSlide">
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="pill" href="#home">Tìm tour</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="search">
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">

                            <div>
                                <div class="radioGroup">
                                    <span><input type="radio" name="rdoTourType" value="62" checked="checked">Tour trong nước</span>

                                    <span><input type="radio" name="rdoTourType" value="63">Tour nước ngoài</span>

                                </div>
                                <input type="text" name="name_tour" ng-model="tourName" value="" placeholder="Gợi ý tên tour">

                                <select name="departureID" class="departure"
                                        ng-model="selectedDeparture"
                                        ng-options="dep as dep.text for dep in departures">
                                    <option value="">Chọn điểm xuất phát</option>
                                </select>

                                <select name="destinationID" class="destination"
                                        ng-model="selectedDestination"
                                        ng-options="dest as dest.text for dest in destinations">
                                    <option value="">Chọn điểm đến</option>
                                </select>

                                <button ng-click="findTour()">Tìm tour</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <main>
        <h1 class="hidden">
            Vietland Travel, du lịch trọn gói trong nước và quốc tế    </h1>
        <div class="container" >
            <div class="row_pc">

                @foreach($categoriesSpecial as $cateSpecial)
                    <div class="tour">
                        <h2 class="titleH2"><a href="{{ route('front.tour-category', ['slug' => $cateSpecial->slug]) }}">
                                {{ $cateSpecial->name }}
                            </a></h2>
                        <div class="clearfix">
                            <div class="slide4 owl-carousel">
                            @foreach($cateSpecial->tours as $tour)
                                    @include('site.partials.item_carousel', ['item' => $tour])
                            @endforeach
                            </div>
                        </div>
                        <div class="clearfix-20 hidden-xs"></div>
                        <div class="text-center"> <a href="{{ route('front.tour-category', ['slug' => $cateSpecial->slug]) }}" class="view-more">Xem thêm >></a>
                        </div>
                        <div class="clearfix-20 hidden-xs"></div>
                    </div>
                @endforeach


                @foreach($categoryParents as $categoryParent)
                        <div class="tour">
                            <h2 class="titleH2">
                                <a href="{{ route('front.tour-category', ['slug' => $categoryParent->slug]) }}">{{ $categoryParent->name }}</a>
                            </h2>
                            <div class="clearfix">
                                <div class="slide4 owl-carousel">
                                    @foreach($categoryParent->tours as $tour)
                                        @include('site.partials.item_carousel', ['item' => $tour])
                                    @endforeach
                                </div>
                            </div>
                            <div class="clearfix-20 hidden-xs"></div>
                            <div class="text-center"> <a href="{{ route('front.tour-category', ['slug' => $categoryParent->slug]) }}" class="view-more">Xem thêm >></a>
                            </div>
                            <div class="clearfix-20 hidden-xs"></div>
                        </div>
                @endforeach



                <div class="bestTour--wrapper">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="titleH2 titleBestTour"><a href="{{ route('front.index-blog') }}">
                                    Tin tức
                                </a></h2>
                            <div class="bestTour">
                                <div class="row mg10">
                                        @foreach($newBlogs as $index => $newBlog)
                                            @if($index < 2)
                                                <div class="col-md-6 col-xs-6 col-480-12 pd5">
                                                    <div class="bestTourBox--big">
                                                        <a href="{{ route('front.detail-blog', ['slug' => $newBlog->slug]) }}">
                                                            <img title="{{ $newBlog->name }}" alt="{{ $newBlog->name }}" src="{{ @$newBlog->image->path ?? '' }}">
                                                        </a>
                                                        <h3><a href="{{ route('front.detail-blog', ['slug' => $newBlog->slug]) }}">{{ $newBlog->name }}</a></h3>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-4 col-xs-6 col-480-12 pd5">
                                                    <div class="bestTourBox--big">
                                                        <a href="{{ route('front.detail-blog', ['slug' => $newBlog->slug]) }}">
                                                            <img title="{{ $newBlog->name }}" alt="{{ $newBlog->name }}" src="{{ @$newBlog->image->path ?? '' }}">
                                                        </a>
                                                        <h3><a href="{{ route('front.detail-blog', ['slug' => $newBlog->slug]) }}">{{ $newBlog->name }}</a></h3>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="titleH2 titleBestTour"><a href="https://vietlandtravel.vn/thu-vien-anh.html">
                                    Thư viện ảnh                            </a></h2>
                            <div class="row mg10">
                                <div class="col-md-8 pd5">
                                    <div class="anh owl-carousel owl-theme">
                                        @foreach($galleries as $gallery)
                                            <div class="item">
                                                <!-- <iframe width="100%" height="245" src="https://www.youtube.com/embed/https://www.youtube.com/watch?v=https://www.youtube.com/watch?v=https://www.youtube.com/watch?v=http" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                                                <img src="{{ @$gallery->image->path ?? '' }}" alt="{{ $gallery->title }}"
                                                     style="width:100%; height:245px;">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <script>
                                    $('.anh.owl-carousel').owlCarousel({
                                        loop: true,
                                        margin: 10,
                                        nav: true,
                                        dots: false,
                                        responsive: {
                                            0: {
                                                items: 1
                                            },
                                            600: {
                                                items: 1
                                            },
                                            1000: {
                                                items: 1
                                            }
                                        }
                                    })
                                </script>
                                @foreach($galleries->take(5) as $gallery)
                                    <div class="col-md-4 col-xs-6 col-xs-2 col-xs-fix2 pd5 ">
                                        <div class="imageGallery img-photo"> <a class="view__img"
                                                                                href="{{ @$gallery->image->path ?? '' }}" title="{{ $gallery->title }}"><img
                                                    title="{{ $gallery->title }}" alt="{{ $gallery->title }}"
                                                    src="{{ @$gallery->image->path ?? '' }}"></a> </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="support">
                    <h2 class="titleH2"><a href=" ">Hỗ trợ trực tuyến</a></h2>
                    <div class="owl-carousel slideSuport">
                        @foreach($supportsStaff as $supportStaff)
                            <div class="item">
                                <a href=""><img src="{{ @$supportStaff->image->path ?? '' }}" class="w_100" title="{{ $supportStaff->name }}" alt="{{ $supportStaff->name }}"></a>
                                <div class="itemText">
                                    <p>{{ $supportStaff->name }}</p>
                                    <a href="tel:{{ $supportStaff->phone_number }}"><i class="fa fa-phone" aria-hidden="true"></i>
                                        {{ $supportStaff->phone_number }}</a>
                                    <p><a href="https://zalo.me/{{ $supportStaff->phone_number }}">zalo.me</a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <script type="text/javascript">
                    if (window.innerWidth > 482) {
                        $(".slideSuport").owlCarousel({
                            items: 5,
                            responsive: {
                                1200: {
                                    item: 4,
                                }, // breakpoint from 1200 up
                                982: {
                                    items: 3,
                                },
                                768: {
                                    items: 3,
                                },
                                482: {
                                    items: 2,
                                },
                                0: {
                                    items: 1,
                                }
                            },
                            rewind: false,
                            autoplay: true,
                            autoplayHoverPause: true,
                            autoplayTimeout: 5000,
                            smartSpeed: 1000, //slide speed smooth
                            dots: false,
                            margin: 45,
                            dotsEach: false,
                            loop: true,
                            nav: true,
                            navText: ['<i class="fa fa-angle-left icon_slider"></i>', '<i class="fa fa-angle-right icon_slider"></i>'],
                            margin: 10,
                        });
                    } else {
                        $('.vbmslideSuport').owlCarousel({
                            items: 4,
                            loop: true,
                            margin: 10,
                            merge: true,
                            responsive: {
                                678: {
                                    mergeFit: true
                                },
                                1000: {
                                    mergeFit: false
                                }
                            },
                            nav: true,
                            navText: ['<i class="fa fa-angle-left icon_slider"></i>', '<i class="fa fa-angle-right icon_slider"></i>'],
                            autoplay: true,
                            autoplayTimeout: 5000,
                        });
                    }
                    if (window.innerWidth < 481) {
                        $('.slideSuport').css('display: none');
                    }
                </script>        </div>
        </div>
    </main>


    <script type="text/javascript">
        var tag = document.createElement('script');
        tag.id = 'iframe-demo';
        tag.src = 'https://www.youtube.com/iframe_api';
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var PROPERTIES = ['yaw', 'pitch', 'roll', 'fov'];
        var updateButton = document.getElementById('spherical-properties-button');

        var ytplayer;

        function onYouTubeIframeAPIReady() {
            ytplayer = new YT.Player('spherical-video-player', {
                height: '245',
                width: '100%',
                videoId: 'https://www.youtube.com/watch?v=https://www.youtube.com/watch?v=https://www.youtube.com/watch?v=http',
            });
        }
    </script>
    <style>
        .owl-carousel .owl-nav {
            z-index: 2;

        }

        .owl-carousel .owl-nav [class*='owl-']:hover {
            background-color: #fff !important;
        }

        .owl-carousel .owl-nav [class*='owl-'] {
            background: #fff;
            width: 50px;
            font-size: 29px;
        }
    </style>

    <div class="icon_fixed visible-xs">
        <div class="fix_mb">


            <div class="mess">
                <a href="https://m.me/179153369290737" target="_blank">
                    <img src="https://vietlandtravel.vn/img/mess.png" alt="">
                </a>
            </div>


        </div>

    </div>




    <div class="icon_fixed hidden-sm hidden-xs">

        <div class="mess">
            <a href="https://m.me/179153369290737" target="_blank">
                <img src="https://vietlandtravel.vn/img/mess.png" alt="">
            </a>
        </div>


    </div>

    <style>
        .icon_fixed{position: fixed;z-index: 999;top: 82%;right: 30px}
        .icon_fixed img{width: 45px;height: 45px;margin-bottom: 20px}
        @media (max-width: 576px){
            .suntory-alo-phone{top: 89%}
            .call_pc{display: none}
            .suntory-alo-phone{position: relative !important;margin-top: -25px;width: 75px;margin-left: -20px}
            .fix_mb{position: fixed;display: flex;justify-content: space-between;top: 90%;width: 85%}
        }
        @media(min-width: 1500px){
            .icon_fixed{top: 68% !important;}
        }
    </style>
    <!--   -->
    <script type="text/javascript">
        (() => {
            'use strict';
            // Page is loaded
            const objects = document.getElementsByClassName('asyncImage');
            Array.from(objects).map((item) => {
                // Start loading image
                const img = new Image();
                img.src = item.dataset.src;
                // Once image is loaded replace the src of the HTML element
                img.onload = () => {
                    item.classList.remove('asyncImage');
                    return item.nodeName === 'IMG' ?
                        item.src = item.dataset.src :
                        item.style.backgroundImage = `url(${item.dataset.src})`;
                };
            });
        })();
    </script>
@endsection
@push('scripts')

    <script src="https://cdn.tutorialjinni.com/jquery-toast-plugin/1.3.2/jquery.toast.js"></script>
    <script src="https://cdn.tutorialjinni.com/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script>
        app.controller('homePage', function ($rootScope, $scope, $interval) {
            $scope.departures = [
                { value: '75', text: 'Hà Nội' },
                { value: '76', text: 'TP.Đà Nẵng' },
                { value: '77', text: 'TP.Hồ Chí Minh' },
                { value: '113', text: 'TP. Nha Trang' },
                { value: '144', text: 'Hải Phòng' }
            ];

            $scope.destinations = [
                { value: '64', text: 'Việt Nam' },
                { value: '133', text: '--Du lịch Biển - Đảo' },
                { value: '67', text: '--Miền Bắc' },
                { value: '132', text: '--Miền Nam' },
                { value: '131', text: '--Miền Trung' },
                { value: '139', text: '--Du thuyền' },
                { value: '65', text: 'Nước ngoài' },
                { value: '68', text: '--Đài Loan' },
                { value: '69', text: '--Singapore' },
                { value: '70', text: '--Hàn Quốc' },
                { value: '71', text: '--Trung Quốc' },
                { value: '72', text: '--Nhật Bản' },
                { value: '73', text: '--Thái Lan' },
                { value: '118', text: '--Châu Âu' },
                { value: '119', text: '--Malaysia - Singapore' },
                { value: '121', text: '--Lào' },
                { value: '122', text: '--Biển Maldives' },
                { value: '123', text: '--Úc' },
                { value: '124', text: '--Nam Phi' },
                { value: '125', text: '--Hoa Kỳ' },
                { value: '126', text: '--Nga' },
                { value: '127', text: '--Ấn Độ' },
                { value: '128', text: '--Dubai - Ả Rập' },
                { value: '129', text: '--Campuchia' },
                { value: '130', text: '--Indonesia' },
                { value: '137', text: '--Anh Quốc' },
                { value: '142', text: '--Thổ Nhĩ Ki' },
                { value: '146', text: '--Ai Cập' }
            ];

            $scope.findTour = function() {
                // Lấy text từ select nếu có chọn, nếu không sẽ trả về chuỗi rỗng
                var departureText = $scope.selectedDeparture ? $scope.selectedDeparture.text : '';
                var destinationText = $scope.selectedDestination ? $scope.selectedDestination.text : '';

                // Loại bỏ ký tự "--" nếu có (chỉ loại bỏ nếu nằm đầu chuỗi)
                var cleanDeparture = departureText.replace(/^--+/, '').trim();
                var cleanDestination = destinationText.replace(/^--+/, '').trim();

                // Lấy giá trị từ ô tìm kiếm tour
                var searchText = $scope.tourName || '';

                // Nếu cả 3 trường đều rỗng, hiển thị thông báo và dừng xử lý
                if (!cleanDeparture && !cleanDestination && !searchText) {
                    alert('Vui lòng nhập nội dung tìm kiếm');
                    return;
                }

                // Gửi dữ liệu lên backend Laravel qua $http (POST)
                // Xây dựng URL với các tham số truyền qua query string
                var url = '/search-tour?departure=' + encodeURIComponent(cleanDeparture) +
                    '&destination=' + encodeURIComponent(cleanDestination) +
                    '&tourName=' + encodeURIComponent(searchText);

                // Chuyển hướng sang URL mới
                window.location.href = url;

            };
        })

    </script>

@endpush

