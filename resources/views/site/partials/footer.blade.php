<footer id="footer">
    <div class="container">
        <div class="row_pc">
            <div class="colMenuft" style="padding: 20px 0">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-6">
                            <h2 class="footer__title">
                                {{ $category->name }}
                            </h2>
                            <ul class="listFooter">
                                @foreach ($category->childs as $child)
                                    <li class="menu-item">
                                        <a href="{{ route('front.tour-category', ['slug' => $category->slug, 'childSlug' => $child->slug]) }}"
                                            class="menu-link">
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="footer--bottom">
        <div class="container">
            <div class="row_pc">
                <div class="row">
                    <div class="col-md-6">
                        <div class="company--top">
                            <p style="text-align:center"><strong><span style="font-size:14px">{{$config->short_name_company}}</span></strong></p>
                            <p>{{$config->web_des}}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6 col-480-12">
                                <div class="footerAddress">
                                    <p><span style="font-size:14px"><span
                                                style="font-family:Arial,Helvetica,sans-serif"><strong>VĂN PH&Ograve;NG
                                                    TẠI H&Agrave; NỘI</strong></span></span></p>

                                    <p><span style="font-family:Arial,Helvetica,sans-serif"><span
                                                style="font-size:14px"><strong>Địa chỉ: </strong>{{$config->address_company}}</span></span></p>

                                    <p><span style="font-family:Arial,Helvetica,sans-serif"><span
                                                style="font-size:14px"><strong>Hotline</strong> :&nbsp; <a
                                                    href="tel:{{str_replace(' ','',$config->hotline)}}">{{$config->hotline}}</a></span></span></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6 col-480-12">
                                <div class="footerAddress">
                                    <p><span style="font-family:Arial,Helvetica,sans-serif"><span
                                                style="font-size:14px"><strong>Email</strong> : {{$config->email}}</span></span></p>

                                    <p><span style="font-family:Arial,Helvetica,sans-serif"><span
                                                style="font-size:14px"><strong>Website</strong>: <a
                                                    href="{{route('front.home-page')}}">www.dulichgotrip.vn</a></span></span></p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footerPhotoList">
                            <div class="giayphep">
                                <p><strong><span style="font-size:14px">Danh mục menu</span></strong></p>
                                <ul>
                                    <li><a style="text-transform:capitalize; font-weight: bold;" href="{{ route('front.home-page') }}">Trang chủ</a></li>
                                    <li><a style="text-transform:capitalize; font-weight: bold;" href="{{ route('front.home-page') }}">Giới thiệu</a></li>
                                    @foreach ($categories as $category)
                                        <li><a style="text-transform:capitalize; font-weight: bold;" href="{{ route('front.tour-category', ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                    @foreach ($postCategories as $item)
                                        <li><a style="text-transform:capitalize; font-weight: bold;" href="{{ route('front.index-blog', ['slug' => $item->slug]) }}">{{ $item->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                                <div class="fb-page"
                                data-href="{{ $config->facebook }}"
                                data-tabs="timeline"
                                data-height="200"
                                data-width="380"
                                data-hide-cover="false"
                                data-show-facepile="false"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footerHotline">
        <div class="box"> <a id="callnowbutton" class="animate__swing animate__animated animate__infinite" href="tel:{{ str_replace(' ', '', $config->hotline) }}">
                <div class="call-mobile"> <i class="fa fa-phone"></i> </div>
            </a>
            <div class="call-mobile1"> <a data-animate="fadeInDown" rel="noopener noreferrer"
                    href="https://zalo.me/{{ $config->zalo }}" target="_blank" class="button success" data-animated="true">
                    <span>Tư vấn qua Zalo</span></a></div>
        </div>
    </div>
    </div>
    </div>
    <a href="#top" id="go_top"><i class="fa fa-angles-up animate__animated animate__infinite animate__fadeOutUp"></i></a>
</footer>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v22.0"></script>
<div class="icon_fixed visible-xs animate__zoomIn animate__animated  animate__infinite">
    <div class="fix_mb">
        <div class="mess">
            <a href="{{$config->facebook}}" target="_blank">
                <img src="/site/images/mess.png" alt="">
            </a>
        </div>
    </div>
</div>
<div class="icon_fixed hidden-sm hidden-xs animate__zoomIn animate__animated  animate__infinite">
    <div class="mess">
        <a href="{{$config->facebook}}" target="_blank">
            <img src="/site/images/mess.png" alt="">
        </a>
    </div>
</div>

<style>
    .animate__zoomIn {
        animation-duration: 2s;
    }
    .icon_fixed {
        position: fixed;
        z-index: 999;
        top: 82%;
        left: 30px
    }

    .icon_fixed img {
        width: 80px;
        height: 80px;
        margin-bottom: 20px
    }

    @media (max-width: 576px) {
        .suntory-alo-phone {
            top: 89%
        }

        .call_pc {
            display: none
        }

        .suntory-alo-phone {
            position: relative !important;
            margin-top: -25px;
            width: 75px;
            margin-left: -20px
        }

        .fix_mb {
            position: fixed;
            display: flex;
            justify-content: space-between;
            top: 90%;
            width: 85%
        }
    }

    @media(min-width: 1500px) {
        .icon_fixed {
            top: 75% !important;
        }
    }
</style>
