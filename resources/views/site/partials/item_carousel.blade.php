<div class="item">
    <div class="tourBox">
        <div class="tourPhoto"> <a href="{{route('front.tour-detail', ['slug' => $item->slug])}}"><img
                        title="{{ $item->title ?? $item->title_short }}"
                        src="{{ @$item->image->path ?? '' }}"></a>
            <div class="tourBox__title">
                <h3><a href="{{route('front.tour-detail', ['slug' => $item->slug])}}">
                        {{ $item->title_short }}
                    </a></h3>
            </div>
        </div>
        <p class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> Thời gian:
            {{ $item->times }}                               </p>
        <p><i class="fa fa-bus"></i>  {{ $item->start_off }}                               </p>
        <span><i class="fa fa-calendar"></i>
                                                                        {{ $item->schedule }}                                                                    </span>
        <p class="price"><i class="fa fa-usd" aria-hidden="true"></i> <span>Giá:
                                                                                {{ number_format($item->price) }}                                       đ
                                                                            </span> </p>
        <div class="voteList">
            <ul>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
            </ul>
            <a href="{{ route('front.booking-tour', ['slug' => $item->slug]) }}" class="bookTour">Đặt tour</a>
        </div>
    </div>
</div>
