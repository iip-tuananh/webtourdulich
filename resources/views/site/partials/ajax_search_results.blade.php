<div class="autocomplete-suggestions">
    @foreach ($products as $item)
    <a href="{{route('front.show-product-detail', $item->slug)}}">
        <div class="autocomplete-suggestion" style="cursor: pointer;">
            <img class="search-image" src="{{$item->image->path}}" loading="lazy">
            <div class="search-name">{{$item->name}}</div>
            <span class="search-price">
                @if ($item->base_price)
                <del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>{{formatCurrency($item->base_price)}}&nbsp;<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></del>
                @endif
                <ins><span class="woocommerce-Price-amount amount"><bdi>{{formatCurrency($item->price)}}&nbsp;<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></ins><span></span>
            </span>
        </div>
    </a>
    @endforeach
    <div class="autocomplete-suggestion">
    <div class="search-name"><a href="{{route('front.home-page')}}">Trang chủ</a></div>
    </div>
</div>
<style>
    .autocomplete-suggestion:last-child {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .autocomplete-suggestions a:hover .autocomplete-suggestion {
        background-color: rgba(0,0,0,0.05);
    }
</style>
