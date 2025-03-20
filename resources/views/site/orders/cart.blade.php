@extends('site.layouts.master')
@section('title')
    Giỏ hàng
@endsection

@section('css')
@endsection

@section('content')
    <main id="main" class="">
        <div class="checkout-page-title page-title">
            <div class="page-title-inner flex-row medium-flex-wrap container">
                <div class="flex-col flex-grow medium-text-center">
                    <nav
                        class="breadcrumbs flex-row flex-row-center heading-font checkout-breadcrumbs text-center strong h2 uppercase">
                        <a href="{{ route('cart.index') }}" class="current">
                            <span class="breadcrumb-step hide-for-small">1</span> Giỏ hàng </a>
                        <span class="divider hide-for-small"><i class="icon-angle-right"></i></span>
                        <a href="{{ route('cart.checkout') }}" class="hide-for-small">
                            <span class="breadcrumb-step hide-for-small">2</span> Đặt hàng </a>
                        <span class="divider hide-for-small"><i class="icon-angle-right"></i></span>
                        <a href="#" class="no-click hide-for-small">
                            <span class="breadcrumb-step hide-for-small">3</span> Hoàn thành </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="cart-container container page-wrapper page-checkout">
            <div class="woocommerce">
                <div class="woocommerce-notices-wrapper"></div>
                <div class="woocommerce row row-large row-divided">
                    <div class="col large-7 pb-0 cart-auto-refresh">
                        <form class="woocommerce-cart-form">
                            <div class="cart-wrapper sm-touch-scroll">
                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="product-name" colspan="3">Sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Tạm tính</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="woocommerce-cart-form__cart-item cart_item" ng-repeat="item in cart.items">
                                            <td class="product-remove">
                                                <a href="javascript:void(0)"
                                                    class="remove"
                                                    ng-click="removeItem(item.id)"
                                                    >&times;</a>
                                            </td>
                                            <td class="product-thumbnail">
                                                <a
                                                    href="/san-pham/<% item.attributes.slug %>.html"><img
                                                        decoding="async" width="300" height="400"
                                                        ng-src="<% item.attributes.image %>"
                                                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                        alt="<% item.name %>" /></a>
                                            </td>
                                            <td class="product-name" data-title="Sản phẩm">
                                                <a
                                                    href="/san-pham/<% item.attributes.slug %>.html"><% item.name %></a>
                                                <div ng-if="item.attributes.attribute_name" style="font-size: 12px; color: #666;">Phân loại: <span style="font-weight: 500; font-size: 14px; color: #056839;"><% item.attributes.attribute_name %></span></div>
                                                <div class="show-for-small mobile-product-price">
                                                    <span class="mobile-product-price__qty"><% item.quantity %> x </span>
                                                    <span class="woocommerce-Price-amount amount"><bdi><% item.price | number %>&nbsp;<span
                                                                class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span>
                                                </div>
                                            </td>
                                            <td class="product-price" data-title="Giá">
                                                <span class="woocommerce-Price-amount amount"><bdi><% (item.price) | number %>&nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span>
                                            </td>
                                            <td class="product-quantity" data-title="Số lượng">
                                                <div class="ux-quantity quantity buttons_added">
                                                    <input type="button" value="-"
                                                        class="ux-quantity__button ux-quantity__button--minus button minus is-form" ng-click="changeQty(item.quantity, item.id)">
                                                    <input type="number"
                                                        class="input-text qty text"
                                                        value="<% item.quantity %>"
                                                        aria-label="Số lượng sản phẩm" size="4" min="0"
                                                        max="" step="1" placeholder="" inputmode="numeric"
                                                        autocomplete="off" ng-model="item.quantity" ng-change="changeQty(item.quantity, item.id)" />
                                                    <input type="button" value="+"
                                                        class="ux-quantity__button ux-quantity__button--plus button plus is-form" ng-click="changeQty(item.quantity, item.id)">
                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Tạm tính">
                                                <span class="woocommerce-Price-amount amount"><bdi><% (item.price * item.quantity) | number %>&nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="actions clear">
                                                <div class="continue-shopping pull-left text-left">
                                                    <a class="button-continue-shopping button primary is-outline"
                                                        href="{{route('front.home-page')}}">
                                                        &#8592;&nbsp;Tiếp tục xem sản phẩm </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="cart-collaterals large-5 col pb-0">
                        <div class="cart-sidebar col-inner ">
                            <div class="cart_totals ">
                                <table cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="product-name" colspan="2">Cộng giỏ hàng</th>
                                        </tr>
                                    </thead>
                                </table>
                                <h2>Cộng giỏ hàng</h2>
                                <table cellspacing="0" class="shop_table shop_table_responsive">
                                    {{-- <tr class="cart-subtotal">
                                        <th>Tạm tính</th>
                                        <td data-title="Tạm tính"><span
                                                class="woocommerce-Price-amount amount"><bdi><% cart.total | number %>&nbsp;<span
                                                        class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span>
                                        </td>
                                    </tr> --}}
                                    <tr class="order-total">
                                        <th>Tổng</th>
                                        <td data-title="Tổng"><strong><span
                                                    class="woocommerce-Price-amount amount"><bdi><% cart.total | number %>&nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></strong>
                                        </td>
                                    </tr>
                                </table>
                                <div class="wc-proceed-to-checkout">
                                    <a href="{{route('cart.checkout')}}"
                                        class="checkout-button button alt wc-forward">
                                        Tiến hành thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-footer-content after-cart-content relative"></div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    {{-- <script>
        app.controller('CartController', function($scope, cartItemSync, $interval, $rootScope) {
            $scope.items = @json($cartCollection);
            $scope.total = "{{ $total_price }}";
            $scope.total_qty = "{{ $total_qty }}";
            $scope.checkCart = true;

            $scope.countItem = Object.keys($scope.items).length;

            jQuery(document).ready(function() {
                if ($scope.total == 0) {
                    $scope.checkCart = false;
                    $scope.$applyAsync();
                }
            })

            $scope.changeQty = function(qty, product_id) {
                updateCart(qty, product_id)
            }

            $scope.incrementQuantity = function(product) {
                product.quantity = Math.min(product.quantity + 1, 9999);
            };

            $scope.decrementQuantity = function(product) {
                product.quantity = Math.max(product.quantity - 1, 0);
            };

            function updateCart(qty, product_id) {
                jQuery.ajax({
                    type: 'POST',
                    url: "{{ route('cart.update.item') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        product_id: product_id,
                        qty: qty
                    },
                    success: function(response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.total_qty = response.count;
                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $scope.$applyAsync();
                        }
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.removeItem = function(product_id) {
                jQuery.ajax({
                    type: 'GET',
                    url: "{{ route('cart.remove.item') }}",
                    data: {
                        product_id: product_id
                    },
                    success: function(response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.total_qty = response.count;
                            if ($scope.total == 0) {
                                $scope.checkCart = false;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $scope.countItem = Object.keys($scope.items).length;

                            $scope.$applyAsync();
                        }
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }
        });
    </script> --}}
@endpush
