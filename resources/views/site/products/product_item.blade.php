<div class="product-card">
    <div class="product-card-thumb-area">
        <a href="{{route('front.show-product-detail', $product->slug)}}" class="product-card-thumb">
            <img class="product-card-thumb-primary"
                src="{{$product->galleries ? $product->galleries[0]->image->path : ''}}" alt="{{$product->name}}"
                width="340" height="320" loading="lazy">
            @if ($product->galleries && count($product->galleries) > 1)
            <img class="product-card-thumb-secondary"
                src="{{$product->galleries ? $product->galleries[1]->image->path : ''}}" alt="{{$product->name}}"
                width="340" height="320" loading="lazy">
            @endif
        </a>
        <button class="product-card-action-quickview" ng-click="showQuickView('{{$product->slug}}')" data-bs-target="#product-modal-active"
            data-bs-toggle="modal">Xem nhanh</button>
    </div>
    <div class="product-card-content">
        <h4 class="product-card-title">
            <a href="{{route('front.show-product-detail', $product->slug)}}">{{$product->name}}</a>
        </h4>
        {{-- <div class="product-card-price">
            <span class="visually-hidden">Giá</span>
            @if ($product->base_price > 0)
            <span class="product-card-old-price"><del>{{formatCurrency($product->base_price)}}đ</del></span>
            @endif
            <span class="product-card-regular-price">{{formatCurrency($product->price)}}đ</span>
        </div>
        <a href="{{route('front.product-custom')}}?product_id={{$product->id}}" class="product-card-box-cart">Tạo thiết kế</a> --}}
    </div>
</div>
