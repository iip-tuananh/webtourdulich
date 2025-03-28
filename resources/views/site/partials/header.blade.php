<header class="header">
    <div class="menu_mb visible-xs visible-sm clearfix">
        <button class="nav-toggle">
            <div class="icon-menu"> <span class="line line-1"></span> <span class="line line-2"></span> <span
                    class="line line-3"></span> </div>
        </button>
        <div class="mb-head"> <a href="{{ route('front.home-page') }}" class="img_logo_mb"><img
                    data-src="{{ $config->image->path }}" title="{{ $config->web_title }}" class="asyncImage" /></a>
            {{-- <div class="lang_mb">
                <a class="language_link" href="www.vietlandholiday.com" target="_blank"><img
                        data-src="https://vietlandtravel.vn/upload/img/menus/vi.png" alt="Việt nam" style="width: 22px"
                        title="Việt nam" class="asyncImage"></a>
                <a class="language_link" href="http://www.vietlandholiday.com/" target="_blank"><img
                        data-src="https://vietlandtravel.vn/upload/img/menus/en.png" alt="Tiếng anh" style="width: 22px"
                        title="Tiếng anh" class="asyncImage"></a>
            </div> --}}
        </div>
        <!-- search mobile -->
        <div class="search_drop"> <a href="" class="btn_search"><i class="fa fa-search"></i></a>
            <form class="form_search" action="" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="s" placeholder="Tìm kiếm...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Tìm kiếm</button>
                    </span>
                </div>
            </form>
        </div>
        <!-- /search mobile -->
    </div>
    <!-- /menu_mb -->
    <div class="clearfix clearfix-60 visible-sm visible-xs"></div>
    <div class="menu_header hidden-sm hidden-xs">
        <div class="container">
            <div class="row_pc">
                {{-- <div class="header--top"> <a href="https://youtu.be/jdFM6GL8sHk" target="_blank" rel="nofollow" class="fa fa-youtube"></a> <a href="https://plus.google.com/u/1/112624525068620531240" target="_blank" rel="nofollow" class="fa fa-google-plus"></a> <a href="https://twitter.com/" target="_blank" rel="nofollow" class="fa fa-twitter"></a> <a href="https://www.facebook.com/VietlandTravel.vn/" target="_blank" rel="nofollow" class="fa fa-facebook"></a>
                    <a href="www.vietlandholiday.com" target="_blank"><img data-src="https://vietlandtravel.vn/upload/img/menus/vi.png" alt="Việt nam" style="width: 20px" title="Việt nam" class="asyncImage"></a>
                    <a href="http://www.vietlandholiday.com/" target="_blank"><img data-src="https://vietlandtravel.vn/upload/img/menus/en.png" alt="Tiếng anh" style="width: 20px" title="Tiếng anh" class="asyncImage"></a>
                </div> --}}
                <div class="clearfix"></div>
                <div class="row">
                    <div class="header--mid">
                        <div class="col-md-4 hidden-sm hidden-xs"> <a href="{{ route('front.home-page') }}"
                                class="logo_pc"> <img data-src="{{ $config->image->path }}"
                                    title="{{ $config->web_title }}" class="asyncImage"> </a> </div>
                        <div class="col-md-5 col-xs-6">
                            <div class="imfoCompany"> <img data-src="/site/images/icon-support.png" alt="suport"
                                    class="asyncImage">
                                <div class="imfoCompany__text"> <a
                                        href="tel: {{ str_replace(' ', '', $config->hotline) }}" class="hotline"><i
                                            class="fa fa-phone-square" aria-hidden="true"></i>
                                        {{ $config->hotline }} </a>
                                    <p class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        {{ $config->address_company }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6 text-right" style="padding-top: 20px;">
                            <a href="{{ route('front.booking-tour') }}" class="btn btn-booking animate__animated  animate__infinite animate__flipInY">Đặt Tour</a>
                        </div>
                        <style>
                            .btn-booking {
                                background: linear-gradient(135deg, #fc4700, #fd6809, #fe9d18) !important;
                                color: #fff;
                                padding: 10px 20px;
                                border-radius: 50px;
                                font-size: 16px;
                                font-weight: 600;
                                text-transform: uppercase;
                                animation-duration: 2s !important;
                            }
                        </style>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="mainMenu sticky-header">
        <div class="container">
            <div class="row_pc">
                <div class="menu_main">
                    <nav class="nav is-fixed">
                        <div class="nav-container">
                            <ul class="nav-menu menu clearfix">
                                <li class="menu-item is-active"><a href="{{ route('front.home-page') }}"
                                        class="menu-link"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                                <li class="menu-item"><a href="{{ route('front.about-us') }}" class="menu-link">Giới thiệu</a></li>
                                @foreach ($categories as $category)
                                    <li class="menu-item has-dropdown">
                                        <a href="{{ route('front.tour-category', ['slug' => $category->slug]) }}"
                                            class="menu-link">
                                            {{ $category->name }}
                                        </a>
                                        <ul class="nav-dropdown menu megaMenu"
                                            style="column-count: 4;-webkit-column-count: 4; -moz-column-count: 4; ">
                                            @foreach ($category->childs as $child)
                                                <li class="menu-item"><a
                                                        href="{{ route('front.tour-category', ['slug' => $category->slug, 'childSlug' => $child->slug]) }}"
                                                        class="menu-link">
                                                        {{ $child->name }} </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                @foreach ($postCategories as $category)
                                    <li class="menu-item has-dropdown">
                                        <a href="{{ route('front.index-blog', ['slug' => $category->slug]) }}"
                                            class="menu-link">
                                            {{ $category->name }}
                                        </a>
                                        @if (count($category->getChilds()) > 0)
                                            <ul class="nav-dropdown menu megaMenu"
                                                style="column-count: 4;-webkit-column-count: 4; -moz-column-count: 4; ">
                                                @foreach ($category->getChilds() as $child)
                                                    <li class="menu-item"><a
                                                            href="{{ route('front.index-blog', ['slug' => $category->slug, 'childSlug' => $child->slug]) }}"
                                                            class="menu-link">
                                                            {{ $child->name }} </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach

                                {{-- <li class="menu-item has-dropdown"> <a href="{{ route('front.index-blog') }}" class="menu-link">
                                        TIN TỨC                  </a>
                                    <ul class="nav-dropdown menu megaMenu" style="column-count: 1;-webkit-column-count: 1; -moz-column-count: 1; ">
                                        @foreach($postCategories as $postCategory)
                                            <li class="menu-item">
                                                <a href="{{ route('front.index-blog', ['slug' => $postCategory->slug]) }}"
                                                    class="menu-link"> {{ $postCategory->name }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li> --}}
                                <li class="menu-item"><a href="{{ route('front.booking-tour') }}" class="menu-link"><i class="fa fa-location-arrow" aria-hidden="true"></i> Đặt tour</a> </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--slide-->
    <div class="hotline_sp visible-sm visible-xs hidden-md hidden-xs">
        <a href="tel: {{ str_replace(' ', '', $config->hotline) }}" class="hotline"><i class="fa fa-phone-square"
                aria-hidden="true"></i> Hotline: {{ $config->hotline }}</a>
    </div>
</header>
