@extends('site.layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('description')
    {{ $short_des }}
@endsection
@section('css')
<style>
    .text-limit-3-line {
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

@section('content')
<main>
    <section class="breadcrumb-section section-space-ptb section-space-pb border-bottom-1 border-top-1" style="background-color: #f6f6f6;">
        <div class="breadcrumb-content text-center">
            <h2 class="mb-2">{{ $title }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{route('front.home-page')}}">Trang chủ</a></li>
                    @if(isset($category) && $category->parent_id)
                        <li class="breadcrumb-item"><a href="{{route('front.show-product-category', $category->parentSlug())}}">{{ $category->getParent()->name }}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $title_sub }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="shop-page section-space-ptb border-bottom-1">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3">
                @foreach ($products as $product)
                <div class="col">
                    @include('site.products.product_item', ['product' => $product])
                </div>
                @endforeach
            </div>
            <!-- Shop Pagination Area Start -->
            <div class="pagination-area">
                <nav aria-label="Page navigation">
                    {{ $products->links() }}
                </nav>
            </div>
            <!-- Shop Pagination Area End -->
        </div>
    </section>
</main>
@endsection

@push('script')
@endpush
