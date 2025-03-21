@extends('site.layouts.master')
@section('title')
    {{$tour->title ?? $tour->title_short}}
@endsection
@section('description')
    {{$tour->description}}
@endsection
@section('image')
    {{ $tour->image->path ?? '' }}
@endsection
@section('css')
@endsection
@section('content')
    <main>
        <div class="bannerDetail" style="background: url('{{  @$tour->category->image->path ?? '' }}') no-repeat; ">
            <div class="container">
                <div class="row_pc">
                    <div class="banner--wrapper">
                        <h2>{{ $tour->category->name }}</h2>
                        <span class="hidden">Hôm nay, 19/03 <img data-src="{{ @$item->image->path ?? '' }}" alt="Thời tiết" class="asyncImage"> 19°C</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row_pc">
                <div class="page--detail">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="{{ route('front.home-page') }}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
                            </li>
                            @if($tour->category->parent)
                                <li><a href="{{ route('front.tour-category', ['slug' => $tour->category->parent->slug]) }}"> {{ $tour->category->parent->name }}  </a>
                             @endif
                            </li><li><a href="{{ route('front.tour-category', ['slug' => $tour->category->parent->slug, 'childSlug' => $tour->category->slug]) }}">  {{ $tour->category->name }} </a></li>
                            <li><a>{{ $tour->title ?? $tour->title_short }} </a></li>
                        </ul>
                    </div>
                    <div class="detailTour">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail--left">
                                    <img data-src="{{ @$tour->image->path ?? '' }}" title="{{ $tour->title ?? $tour->title_short }} " alt="{{ $tour->title ?? $tour->title_short }} " class="asyncImage">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail--right">
                                    <h2>{{ $tour->category->name }} : {{ $tour->title ?? $tour->title_short }}  </h2>
                                    <p><i class="fa fa-usd" aria-hidden="true"></i><span>Giá tour : </span><span class="price">{{ number_format($tour->price) }} đ</span>
                                    </p>
                                    <p><i class="fa fa-clock-o"></i><span>Thời gian : </span> {{ $tour->times }}                             </p>
                                    <p><i class="fa fa-bus" aria-hidden="true"></i><span>Phương tiện :</span>
                                        {{ $tour->vehicle }}                                                                                                                                                             Xe bus,                                                                                                                                        </p>
                                    <p><i class="fa fa-bus"></i><span>Khởi hành từ :</span> {{ $tour->start_off }}</p>
                                    <p><i class="fa fa-map-marker"></i><span>Điểm đến :</span> {{ $tour->destination }}</p>
                                    <p class="bookNow">Số lượng có hạn. Đăng ký ngay để giữ chỗ!</p>
                                    <div class="row_btnbook">
                                        <i class="fa fa-hand-o-right fa1"></i><a href="{{ route('front.booking-tour', ['slug' => $tour->slug]) }}" class="btn__book">Đặt tour</a>
                                    </div>
                                    <div class="hotline"><i class="fa fa-phone-square"></i><a href="tel:{{str_replace(' ','', $config->hotline)}}">{{$config->hotline}}</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="info__detail--add">
                                <h3>Giới thiệu</h3>
                                <div class="text__detail--add fixcontent">
                                    <p style="text-align:center"><span style="font-size:14px"><strong>CHƯƠNG TR&Igrave;NH THAM QUAN DU LỊCH</strong><br />
                                    <span style="color:#c0392b"><strong>{{ $tour->title ?? $tour->title_short }}</strong></span><br />
                                    <strong>Thời gian: </strong> {{ $tour->times }} <br />
                                    <strong>Khởi h&agrave;nh:&nbsp; {{ $tour->start_off }}</strong></span></p>
                                </div>
                            </div>


                            <div class="schedule">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Lịch trình </a></li>
                                    <li><a data-toggle="tab" href="#menu1">Chú ý</a></li>
                                    <li onclick="get_image($(this))" data-id="158"><a data-toggle="tab"  href="#menu2">Hình ảnh</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <!--                            <h4>Lịch trình</h4>-->
                                        <div class="lichtrinh fixcontent">
                                           {!! $tour->itinerary !!}
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <div class="content-note fixcontent">
                                            {!! $tour->beware !!}
                                        </div>
                                        <div class="clearfix-30"></div>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        <div class="clearfix-30">
                                            {!! $tour->photos !!}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="thongtin__lienhe">
                                <div class="row">
                                    <div class="col-sm-8 col-xs-12">
                                        <p><span style="color:#ff0000"><span style="font-size:14px"><strong>TH&Ocirc;NG TIN LI&Ecirc;N HỆ</strong></span></span></p>

                                        <p><span style="color:#003300"><span style="font-size:14px"><strong>{{ $config->short_name_company }}</strong></span></span></p>

                                        <p><span style="font-size:14px"><strong>Địa Chỉ:&nbsp;</strong> {{ $config->address_company }}<br />
                                        <strong>Hotline:&nbsp;</strong> <a href="tel:{{ str_replace(' ', '', $config->hotline) }}" style="color: #ff0000; text-decoration: none;" title="{{ $config->hotline }}">{{ $config->hotline }}</a> <br />
                                        <strong>Email:</strong>&nbsp;{{ $config->email }}<br />
                                        <strong>Website:&nbsp;</strong> {{ url('/') }}</span></p>
                                    </div>
                                    <div class="col-sm-4 col-xs-12 detail--right">

                                        <div class="row_btnbook text-center">
                                            <i class="fa fa-hand-o-right fa1"></i><a href="{{ route('front.booking-tour', ['slug' => $tour->slug]) }}" class="btn__book">Đặt tour</a> <i class="fa fa-hand-o-left fa2"></i>
                                        </div>
                                        <div class="hotline text-center"><i class="fa fa-phone-square"></i><a href="">{{ $config->hotline }}</a></div>
                                    </div>
                                </div>

                            </div>
                            {{-- <div class="p-share">
                                <div class="clearfix-30"></div>
                                <div class="social-button " style="margin-left:5px;">
                                    <div class="g-plusone" data-size="medium" data-annotation="none" style="margin-left:5px;"></div>
                                </div>
                                <div class="social-button">
                                    <i data-toggle="modal" data-target="#myModal" class="fa fa-envelope-o icon-p-detail"></i>
                                    <i onclick="print(158)"  class="fa fa-print icon-p-detail"></i> In bài viết này
                                </div>
                            </div>
                            <div class="fb-comments" data-href="https://vietlandtravel.vn/ha-noi-da-nang-ba-na-hoi-an-ha-noi.html" data-width="100%"
                                 data-numposts="10"
                                 data-colorscheme="light">
                            </div> --}}

                            {{-- <style>
                                .fb-comments iframe{
                                    width: 100% !important;
                                }
                            </style>                <div class="p-share">
                                <div class="clearfix-15"></div>
                                <div class="social-button">
                                    <div class="fb-like" style="margin-left:5px;" data-href="https://vietlandtravel.vn/ha-noi-da-nang-ba-na-hoi-an-ha-noi.html" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
                                    <div class="fb-share-button" style="margin-left:5px;" data-href="https://vietlandtravel.vn/ha-noi-da-nang-ba-na-hoi-an-ha-noi.html" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://vietlandtravel.vn/ha-noi-da-nang-ba-na-hoi-an-ha-noi.html">Chia sẻ</a></div>
                                    <div class="fb-send" style="margin-left:5px;" data-href="https://www.facebook.com/VietlandTravel.vn/"></div>
                                </div>
                                <div class="social-button " style="margin-left:5px;margin-top: 7px;">
                                    <div class="g-plusone" data-size="medium" data-annotation="none" style="margin-left:5px;"></div>
                                </div>
                                <div class="social-button " style="margin-left:5px;margin-top: 7px;">
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="js/widgets.js" charset="utf-8"></script>
                                </div>
                                <div class="clearfix-15"></div>
                            </div> --}}
                        </div>
                        <div class="col-md-4">
                            <div class="detailSidebar">
                                <h2><a href="">Tour liên quan</a></h2>
                                <div class="row row-flex">
                                    @foreach($tourSuggest as $item)
                                        <div class="col-md-12 col-sm-6 col-xs-6 col-480-12 col-child">
                                            <div class="detailSidebar__item">
                                                <div class="detailSidebar__photo">
                                                    <a href="{{route('front.tour-detail', ['slug' => $item->slug])}}">
                                                        <img data-src="{{ @$item->image->path ?? '' }}" title="{{ $item->title_short }}" alt="{{ $item->title_short }} " class="asyncImage"></a>
                                                </div>
                                                <div class="detailSidebar__text">
                                                    <h3><a href="{{route('front.tour-detail', ['slug' => $item->slug])}}">{{ $item->title_short }}</a></h3>
                                                    <p class="diemden"><span>Điểm đến </span>: {{ $item->destination }}</p>
                                                    <p class="thoigian"><span>Thời gian:</span>{{ $item->times }}</p>
                                                    <span class="price__new">{{ number_format($item->price )}} đ</span>
                                                </div>
                                            </div>
                                        </div>


                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>




@endsection
@push('scripts')
    <script>
        app.controller('homePage', function ($rootScope, $scope, $interval) {
            $(document).ready(function() {
            });
        })

    </script>

@endpush

