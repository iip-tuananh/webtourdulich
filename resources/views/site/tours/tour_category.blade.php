@extends('site.layouts.master')
@section('title')
    {{ $category->name }}
@endsection
@section('css')
@endsection
@section('content')
    <main>
        <div class="bannerDetail" style="background: url('{{  @$category->image->path ?? '' }}') no-repeat; ">
            <div class="container">
                <div class="row_pc">
                    <div class="banner--wrapper">
                        <h2>{{ $category->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row_pc">
                <div class="breadcrumb">
                    <ul>
                        <li> <a href="{{ route('front.home-page') }}"><i class="fa fa-home"></i>Trang chủ</a> </li>
                        <li><a href="#">  {{ $category->name }} </a></li>        </ul>
                </div>
                <div class="tour tour--page">
                    <h1 class="titleH2 pd10"><a href="">{{ $category->name }}</a></h1>
                    <div class="titleP">
                    </div>

                    <div class="row row-flex">
                        @foreach($tours as $item)
                            @include('site.partials.item_tour_col_3', ['item' => $item])
                        @endforeach
                    </div>

                    <div class="row text-right">
                        {{ $tours->links('site.pagination.paginate2') }}
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

