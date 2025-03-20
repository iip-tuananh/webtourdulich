@extends('site.layouts.master')
@section('title')
    {{ $category->name }}
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
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-left">
                        <h1 class="titleH2 titleBestTour" style="padding-bottom: 10px"><a href="">
                                @if($category)
                                    {{ $category->name }}
                                @else
                                    Tin tức
                                @endif
                            </a></h1>
                        <article id="body_home">
                            <div class="clearfix main-new">
                                <ul class="list_sevice imgRow">
                                    @foreach($data['blogs'] as $blog)
                                        <li class="inner_news clearfix"> <a href="{{ route('front.detail-blog', ['slug' => $blog->slug]) }}" class="img_news reRenderImg">
                                                <img class="w_100"
                                                     src="{{ @$blog->image->path ?? '' }}"
                                                     title=" {{ $blog->name }}" alt="{{ $blog->name }}"> </a>
                                            <div class="sub_news">
                                                <h3><a href="{{ route('front.detail-blog', ['slug' => $blog->slug]) }}">
                                                        {{ $blog->name }}
                                                    </a></h3>
                                                <div class="des_news hidden-xs">
                                                    {{ Str::limit($blog->intro, 190, '...') }}
                                                </div>
                                                <a href="{{ route('front.detail-blog', ['slug' => $blog->slug]) }}" class="view_more">Xem thêm...</a> </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-sm-12 text-center">
                                {{ $data['blogs']->links('site.pagination.paginate2') }}
                            </div>
                        </article>
                    </div>
                    <div class="col-sm-3 col-right">
                        <div class="clearfix-25 visible-xs"></div>

                        <div class="detailSidebar">

                            <h2><a href="">Tin mới nhất</a></h2>

                            <div class="row">
                                @foreach($data['newBlogs'] as $blogNew)
                                    <div class="col-sm-12 col-xs-6 col-480-12">

                                        <div class="detailSidebar__item">

                                            <div class="detailSidebar__photo">

                                                <a href="{{ route('front.detail-blog', ['slug' => $blogNew->slug]) }}">

                                                    <img src="{{ @$blogNew->image->path ?? '' }}" title="{{ $blogNew->name }}" alt="{{ $blogNew->name }}">

                                                </a>

                                            </div>

                                            <div class="detailSidebar__text">

                                                <h3><a href="{{ route('front.detail-blog', ['slug' => $blogNew->slug]) }}">{{ $blogNew->name }}</a></h3>

                                                <div class="time">

                                                    <i class="fa fa-calendar" aria-hidden="true"></i>

                                                    {{ \Carbon\Carbon::parse($blogNew->created_at)->format('d/m/Y') }}
                                                </div>

                                                <div class="des">


                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>
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
        <!-- footer -->
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

