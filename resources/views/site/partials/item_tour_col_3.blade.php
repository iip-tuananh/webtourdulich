<div class="col-md-3 col-xs-6 col-480-12">
    <div class="tourBox">
        <div class="tourPhoto"> <a href="{{route('front.tour-detail', ['slug' => $item->slug])}}">
                <img data-src="{{ @$item->image->path ?? '' }}"
                     title=" {{ $item->title_short }}      "
                     class="asyncImage"> </a>
            <div class="tourBox__title">
                <h3><a href="{{route('front.tour-detail', ['slug' => $item->slug])}}">
                        {{ $item->title_short }}                   </a></h3>
            </div>
        </div>
        <p class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> Thời gian:
            {{ $item->times }}              </p>
        <p><i class="fa fa-bus"></i> {{ $item->start_off }}      </p>
        <div class="span_dete"><i class="fa fa-calendar"></i>
            {{ $item->schedule }}                                   </div>
        <p class="price"><i class="fa fa-usd" aria-hidden="true"></i> <span>Giá:
                                {{ number_format($item->price) }}                đ
                                </span> </p>
        <div class="voteList">
            <ul>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
            </ul>
            <a href="{{ route('front.booking-tour', ['slug' => $item->slug]) }}" class="bookTour">Đặt tour</a> </div>
    </div>
</div>
