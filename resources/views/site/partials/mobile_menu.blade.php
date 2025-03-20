<div class="offcanvas offcanvas-top offcanvas-search-area" tabindex="-1" id="offcanvas-search">
    <div class="offcanvas-search-wrap">
        <div class="offcanvas-search-header">
            <div class="offcanvas-search-title">
                <span class="visually-hidden">Tìm kiếm sản phẩm</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-search-body">
            <div class="offcanvas-search-box">
                <form action="{{ route('front.search-product') }}" method="get" class="offcanvas-search-form">
                    <input type="text" placeholder="Tìm kiếm sản phẩm..." class="offcanvas-search-input" name="keyword">
                    <button type="submit" class="offcanvas-search-submit"> <i class="icon-rt-loupe"></i></button>
                </form>
                {{-- <div class="offcanvas-search-content">
                    <div class="offcanvas-search-keywords-list">
                        <p class="offcanvas-search-key-title">Popular searches :</p>
                        <ul class="offcanvas-search-popular d-flex gap-1">
                            <li><a href="#" class="btn btn-xs btn-gray btn-rounde-2">men</a></li>
                            <li><a href="#" class="btn btn-xs btn-gray btn-rounde-2">clothing</a></li>
                            <li><a href="#" class="btn btn-xs btn-gray btn-rounde-2">women</a></li>
                            <li><a href="#" class="btn btn-xs btn-gray btn-rounde-2">kids</a></li>
                            <li><a href="#" class="btn btn-xs btn-gray btn-rounde-2">new</a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<!-- Offcanvas Mobile Menu Start -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-mobile-menu">
    <div class="offcanvas-header">
        <h6>Menu</h6>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="navbar-mobile-menu">
            <ul class="mobile-menu">
                <li class="mobile-menu-item">
                    <a href="{{ route('front.home-page') }}" class="mobile-menu-link">
                        Trang chủ
                    </a>
                </li>
                <li class="mobile-menu-item">
                    <a href="{{ route('front.about-us') }}" class="mobile-menu-link">
                        Giới thiệu
                    </a>
                </li>
                <li class="mobile-menu-item">
                    <a href="{{ route('front.product-custom') }}" class="mobile-menu-link">
                        Tạo thiết kế
                    </a>
                </li>
                <li class="mobile-menu-item">
                    <a href="#" class="mobile-menu-link">Sản phẩm <span class="menu-expand"><i
                                class="icon-rt-arrow-down"></i></span></a>
                    <ul class="sub-menu">
                        @foreach ($productCategories as $category)
                        <li>
                            <a href="{{ route('front.show-product-category', $category->slug) }}" class="sub-menu-link">
                                {{ $category->name }}
                                @if ($category->childs->count() > 0)
                                <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                                @endif
                            </a>
                            @if ($category->childs->count() > 0)
                            <ul class="sub-menu">
                                @foreach ($category->childs as $child)
                                <li><a href="{{ route('front.show-product-category', $child->slug) }}" class="megamenu-link">{{ $child->name }}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </li>
                @foreach ($postCategories as $postCategory)
                <li class="mobile-menu-item">
                    <a href="{{ route('front.list-blog', $postCategory->slug) }}" class="mobile-menu-link">
                        {{ $postCategory->name }}
                        @if ($postCategory->getChilds()->count() > 0)
                        <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                        @endif
                    </a>
                    @if ($postCategory->getChilds()->count() > 0)
                    <ul class="mega-menu mobile-menu--mega">
                        @foreach ($postCategory->getChilds() as $child)
                        <li><a href="{{ route('front.list-blog', $child->slug) }}" class="sub-menu-link">{{ $child->name }}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
                <li class="mobile-menu-item">
                    <a href="{{ route('front.contact-us') }}" class="mobile-menu-link">
                        Liên hệ
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- Offcanvas Mobile Menu End -->
