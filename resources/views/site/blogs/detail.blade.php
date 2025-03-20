@extends('site.layouts.master')
@section('title')
    {{ $data['blog']->name ?? $blog->name }}
@endsection
@section('description')
    {{ $data['blog']->intro ?? $blog->intro }}
@endsection
@section('image')
    {{ $data['blog']->image->path ?? $blog->image->path }}
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
                    <div class="col-md-9 col-left">
                        <h1 class="titleH2 titleBestTour" style="padding-bottom: 10px">
                            <a href="">{{ $data['blog']->name }}</a>
                        </h1>
                        <article id="body_home">
                            <div class="page-content fixcontent">
                                {!! $data['blog']->body !!}
                            </div>
                            <div class="clearfix-15"></div>
                            {{-- <div class="p-share">
                                <div class="clearfix-15"></div>
                                <div class="social-button">
                                    <div class="fb-like fb_iframe_widget" style="margin-left:5px;" data-href="https://vietlandtravel.vn/du-thuyen-star-scorpio-tin-vui-cho-khach-du-lich-viet-nam-duoc-xuat-canh-chu-du-bang-duong-bien-ra-nuoc-ngoai.html" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=126821687974504&amp;container_width=51&amp;href=https%3A%2F%2Fvietlandtravel.vn%2Fdu-thuyen-star-scorpio-tin-vui-cho-khach-du-lich-viet-nam-duoc-xuat-canh-chu-du-bang-duong-bien-ra-nuoc-ngoai.html&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small"><span style="vertical-align: bottom; width: 90px; height: 28px;"><iframe name="f46faccc629248699" width="1000px" height="1000px" data-testid="fb:like Facebook Social Plugin" title="fb:like Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v2.10/plugins/like.php?action=like&amp;app_id=126821687974504&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dfc97068d84e4a0e27%26domain%3Dvietlandtravel.vn%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fvietlandtravel.vn%252Ff2861dd23f419e4b6%26relation%3Dparent.parent&amp;container_width=51&amp;href=https%3A%2F%2Fvietlandtravel.vn%2Fdu-thuyen-star-scorpio-tin-vui-cho-khach-du-lich-viet-nam-duoc-xuat-canh-chu-du-bang-duong-bien-ra-nuoc-ngoai.html&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small" style="border: none; visibility: visible; width: 90px; height: 28px;" class=""></iframe></span></div>
                                    <div class="fb-share-button fb_iframe_widget" style="margin-left:5px;" data-href="https://vietlandtravel.vn/du-thuyen-star-scorpio-tin-vui-cho-khach-du-lich-viet-nam-duoc-xuat-canh-chu-du-bang-duong-bien-ra-nuoc-ngoai.html" data-layout="button_count" data-size="small" data-mobile-iframe="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=126821687974504&amp;container_width=51&amp;href=https%3A%2F%2Fvietlandtravel.vn%2Fdu-thuyen-star-scorpio-tin-vui-cho-khach-du-lich-viet-nam-duoc-xuat-canh-chu-du-bang-duong-bien-ra-nuoc-ngoai.html&amp;layout=button_count&amp;locale=vi_VN&amp;mobile_iframe=true&amp;sdk=joey&amp;size=small"><span style="vertical-align: bottom; width: 86px; height: 20px;"><iframe name="ffd82eea48250c17b" width="1000px" height="1000px" data-testid="fb:share_button Facebook Social Plugin" title="fb:share_button Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v2.10/plugins/share_button.php?app_id=126821687974504&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df7d865d561d60c297%26domain%3Dvietlandtravel.vn%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fvietlandtravel.vn%252Ff2861dd23f419e4b6%26relation%3Dparent.parent&amp;container_width=51&amp;href=https%3A%2F%2Fvietlandtravel.vn%2Fdu-thuyen-star-scorpio-tin-vui-cho-khach-du-lich-viet-nam-duoc-xuat-canh-chu-du-bang-duong-bien-ra-nuoc-ngoai.html&amp;layout=button_count&amp;locale=vi_VN&amp;mobile_iframe=true&amp;sdk=joey&amp;size=small" style="border: none; visibility: visible; width: 86px; height: 20px;" class=""></iframe></span></div>
                                    <div class="fb-send" style="margin-left:5px;" data-href="https://www.facebook.com/VietlandTravel.vn/"></div>
                                </div>
                                <div class="social-button " style="margin-left:5px;margin-top: 7px;">
                                    <div class="g-plusone" data-size="medium" data-annotation="none" style="margin-left:5px;"></div>
                                </div>
                                <div class="social-button " style="margin-left:5px;margin-top: 7px;">
                                    <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" class="twitter-share-button twitter-share-button-rendered twitter-tweet-button" title="X Post Button" src="https://platform.twitter.com/widgets/tweet_button.2f70fb173b9000da126c79afe2098f02.vi.html#dnt=false&amp;id=twitter-widget-0&amp;lang=vi&amp;original_referer=https%3A%2F%2Fvietlandtravel.vn%2Fdu-thuyen-star-scorpio-tin-vui-cho-khach-du-lich-viet-nam-duoc-xuat-canh-chu-du-bang-duong-bien-ra-nuoc-ngoai.html&amp;size=m&amp;text=Du%20thuy%E1%BB%81n%20Star%20Scorpio%2C%20tin%20vui%20cho%20kh%C3%A1ch%20du%20l%E1%BB%8Bch%20Vi%E1%BB%87t%20Nam%20%C4%91%C6%B0%E1%BB%A3c%20xu%E1%BA%A5t%20c%E1%BA%A3nh%20chu%20du%20b%E1%BA%B1ng%20%C4%91%C6%B0%E1%BB%9Dng%20bi%E1%BB%83n%20ra%20n%C6%B0%E1%BB%9Bc%20ngo%C3%A0i!&amp;time=1742453562241&amp;type=share&amp;url=https%3A%2F%2Fvietlandtravel.vn%2Fdu-thuyen-star-scorpio-tin-vui-cho-khach-du-lich-viet-nam-duoc-xuat-canh-chu-du-bang-duong-bien-ra-nuoc-ngoai.html" style="position: static; visibility: visible; width: 88px; height: 20px;"></iframe><script async="" src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                                </div>
                                <div class="clearfix-15"></div>
                            </div> --}}
                            <div class="clearfix-30"></div>
                            <section id="title"><!-- TITLE -->
                                <div class="container">
                                    <div class="row">
                                        <h2 class="titleH2 titleBestTour" style="padding-bottom: 10px"><a href="">Bài viết liên quan</a></h2>
                                    </div>
                                </div>
                            </section>
                            <div class="clearfix-10"></div>
                            <ul class="list_sevice imgRow">
                                @foreach($data['other_blogs'] as $otherBlog)
                                    <li class="inner_news clearfix">
                                        <a href="{{ route('front.detail-blog', ['slug' => $otherBlog->slug]) }}" class="img_news reRenderImg">
                                            <img class="w_100" src="{{ @$otherBlog->image->path ?? '' }}" title=" {{ $otherBlog->name }}"
                                                 alt="{{ $otherBlog->name }}">
                                        </a>
                                        <div class="sub_news">
                                            <h3><a href="{{ route('front.detail-blog', ['slug' => $otherBlog->slug]) }}">{{ $otherBlog->name }}</a></h3>
                                            <div class="des_news hidden-xs">
                                                {{ Str::limit($otherBlog->intro, 190, '...') }}
                                            </div>
                                            <a href="{{ route('front.detail-blog', ['slug' => $otherBlog->slug]) }}" class="view_more">Xem thêm...</a>
                                        </div>
                                    </li>

                                @endforeach
                                <div class="clearfix-20 visible-xs"></div>
                            </ul>
                        </article>
                    </div>

                    <div class="col-md-3 col-right">

                        <div class="detailSidebar">

                            <h2><a href="#">Tin mới nhất</a></h2>

                            <div class="row">
                                @foreach($data['newBlogs'] as $blogNew)
                                    <div class="col-sm-12 col-xs-6 col-480-12">

                                        <div class="detailSidebar__item">

                                            <div class="detailSidebar__photo">

                                                <a href="https://vietlandtravel.vn/uu-da-cuc-soc-khi-dang-ky-theo-nhom.html">

                                                    <img src="{{ @$blogNew->image->path ?? '' }}" title="{{ $blogNew->name }}" alt="{{ $blogNew->name }}">

                                                </a>

                                            </div>

                                            <div class="detailSidebar__text">

                                                <h3><a href="https://vietlandtravel.vn/uu-da-cuc-soc-khi-dang-ky-theo-nhom.html">{{ $blogNew->name }}</a></h3>

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

