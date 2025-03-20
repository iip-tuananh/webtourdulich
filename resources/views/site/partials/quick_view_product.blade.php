
<div class="col-12 col-md-6">
    <div class="image-zoom">
        <img id="p-product-image-feature" class="p-product-image-feature"
            src="{{ $product->image->path }}"
            alt="">
        <div id="p-sliderproduct">
            <ul class="owl-carousel inline-list owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage"
                        style="transform: translate3d(0px, 0px, 0px); transition: all; width: 985px;">
                        @foreach ($product->galleries as $gallery)
                        <div class="owl-item active" style="width: 123.067px;">
                            <li class="item active"><a href="#"
                                    data-image="{{$gallery->image->path}}"
                                    data-zoom-image="{{$gallery->image->path}}"><img
                                    data-image="{{$gallery->image->path}}"
                                    data-zoom-image="{{$gallery->image->path}}"
                                    src="{{$gallery->image->path}}"></a>
                            </li>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span
                            aria-label="Previous">‹</span></button><button type="button" role="presentation"
                        class="owl-next"><span aria-label="Next">›</span></button></div>
                <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button
                        role="button" class="owl-dot"><span></span></button><button role="button"
                        class="owl-dot"><span></span></button></div>
            </ul>
        </div>
    </div>
</div>
<div class="col-12 col-md-6">
    <h4 class="p-title modal-title" id="">{{ $product->name }}</h4>
    <p class="product-more-info">
        <span class="product-sku" style="display: none;">
            Mã sản phẩm: <span id="ProductSku">01923123</span>
        </span>
    </p>
    <div class="form-input product-price-wrapper">
        <div class="product-price">
            <span class="p-price ">{{ formatCurrency($product->price) }}₫</span>
            <del>{{ formatCurrency($product->base_price) }}₫</del>
        </div>
        <em id="PriceSaving">(Bạn đã tiết kiệm được {{ formatCurrency($product->base_price - $product->price) }}₫)</em>
    </div>
    {{-- <div class="p-option-wrapper" style="">
        <div class="selector-wrapper">
            <label>Màu sắc</label>
            <span class="custom-dropdown custom-dropdown--white">
                <select class="single-option-selector custom-dropdown__select custom-dropdown__select--white"
                    data-option="option1" id="p-select-quickview-option-0">
                    <option value="Xuân Vũ">Xuân Vũ</option>
                    <option value="Phong Hoa">Phong Hoa</option>
                </select>
            </span>
        </div>
        <select name="id" class="" id="p-select-quickview" style="display: none;">
            <option value="1116017191">Xuân Vũ - 23800000</option>
            <option value="1116017192">Phong Hoa - 23800000</option>
        </select>
    </div>
    <div id="swatch-quick-view" class="select-swatch">
        <div id="variant-swatch-0-quickview" class="swatch swatch-quick-view clearfix" data-option="option1"
            data-option-index="0">
            <div class="header"> Màu sắc </div>
            <div class="select-swap">
                <div data-value="Xuân Vũ" class="n-sd swatch-element color xuan-vu"><input
                        class="variant-0 input-quickview" id="qv-swatch-0-xuan-vu" type="radio" name="option1"
                        value="Xuân Vũ" checked="" data-gtm-form-interact-field-id="5"><label
                        class="xuan-vu has-thumb sd" for="qv-swatch-0-xuan-vu"
                        style="background: url(//product.hstatic.net/200000541929/product/44_f99de3132a1a45bfbe5b8a00ef1774ab_thumb.jpg) top left no-repeat">
                        <span>Xuân Vũ</span><img class="crossed-out"
                            src="//theme.hstatic.net/200000541929/1001190790/14/soldout.png"><img
                            class="img-check"
                            src="//theme.hstatic.net/200000541929/1001190790/14/select-pro.png"></label></div>
                <div data-value="Phong Hoa" class="n-sd swatch-element color phong-hoa"><input
                        class="variant-0 input-quickview" id="qv-swatch-0-phong-hoa" type="radio"
                        name="option1" value="Phong Hoa" checked=""><label class="phong-hoa has-thumb"
                        for="qv-swatch-0-phong-hoa"
                        style="background: url(//product.hstatic.net/200000541929/product/45_ecff2feac2184717a928746e18aaec4d_thumb.jpg) top left no-repeat">
                        <span>Phong Hoa</span><img class="crossed-out"
                            src="//theme.hstatic.net/200000541929/1001190790/14/soldout.png"><img
                            class="img-check"
                            src="//theme.hstatic.net/200000541929/1001190790/14/select-pro.png"></label></div>
            </div>
        </div>
    </div> --}}
    <div class="intro">{!! $product->intro !!}</div>
    <div class="form-input hidden">
        <label>Số lượng</label>
        <input name="quantity" type="number" min="1" value="1">
    </div>
    <div class="form-input" style="width: 100%">
        <button type="submit" class="btn btn-addcart" id="AddToCardQuickView" style="display: block;">Thêm vào
            giỏ</button>
        <button disabled="" class="btn btn-soldout" style="display: none;">Hết hàng</button>
        <div class="qv-readmore">
            <span> hoặc </span><a class="read-more p-url" href="{{ route('front.show-product-detail', $product->slug) }}" role="button">Xem chi tiết</a>
        </div>
    </div>
</div>
