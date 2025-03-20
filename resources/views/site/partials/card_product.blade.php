<div class="header-action_dropdown" aria-labelledby="dropdownCartButton" ng-controller="CardProductController"
    ng-cloak>
    <div class="site-cart">
        <div class="header">
            <span>GIỎ HÀNG</span>
            <a href="javascript:;" onclick="initCart('close')"><i class="fal fa-times"></i></a>
        </div>
        <div class="cart-view">
            <div class="cart-view-scroll">
                <div id="clone-item-cart" class="table-clone-cart">
                    <div class="item_2 hidden">
                        <div class="img"><a href="" title=""><img
                                    src="//theme.hstatic.net/200000541929/1001190790/14/1x1.jpg?v=1803"
                                    alt="" /></a></div>
                        <div>
                            <p class="pro-title">
                                <a class="pro-title-view" href="" title=""></a>
                                <span class="variant"></span>
                            </p>
                            <div class="mini-cart_quantity">
                                <div class="pro-quantity-view"><span class="qty-value"></span></div>
                                <div class="pro-price-view"></div>
                            </div>
                            <div class="remove_link remove-cart"></div>
                        </div>
                    </div>
                </div>
                <div id="cart-view" ng-if="cart.count > 0">
                    <div class="item_2 " ng-repeat="item in cart.items">
                        <div class="img">
                            <a ng-href="/san-pham/<% item.attributes.slug %>.html">
                                <img ng-src="<% item.attributes.image %>" alt="<% item.name %>" />
                            </a>
                        </div>
                        <div>
                            <p class="pro-title">
                                <a class="pro-title-view" ng-href="/san-pham/<% item.attributes.slug %>.html"
                                    title="<% item.name %>">
                                    <% item.name %>
                                </a>
                                <span class="variant">
                                </span>
                            </p>
                            <div class="mini-cart_quantity">
                                <div class="pro-quantity-view">
                                    <span class="qty-value"><% item.quantity %></span>
                                </div>
                                <div class="pro-price-view"><% item.price | number %>₫</div>
                            </div>
                            <div class="remove_link remove-cart">
                                <a href='javascript:void(0);' ng-click='removeItem(item.id)'>
                                    <i class="fal fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="cart-view" ng-if="cart.count == 0">
                    <div class="item-cart_empty">
                        <div>
                            <div class="svgico-mini-cart">
                                <i class="fal fa-shopping-cart"></i>
                            </div>
                            Hiện chưa có sản phẩm
                        </div>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="cart-view-total" ng-if="cart.count > 0">
                <div class="text-left">TỔNG TIỀN:</div>
                <div class="text-right" id="total-view-cart"><% cart.total | number %>₫</div>
            </div>
            <div class="cart-view-btn" ng-if="cart.count > 0">
                <a href="{{ route('cart.index') }}" class="linktocart btn-custom"><span><span>Xem giỏ hàng</span></span></a>
                <a href="{{ route('cart.checkout') }}" class="linktocheckout btn-custom"><span><span>Thanh toán</span></span></a>
            </div>
        </div>
    </div>
</div>
<script>
    app.controller('CardProductController', function ($scope, cartItemSync, $interval, $rootScope) {
        $scope.cart = cartItemSync;

        // xóa item trong giỏ
        $scope.removeItem = function (product_id) {
            jQuery.ajax({
                type: 'GET',
                url: "{{route('cart.remove.item')}}",
                data: {
                    product_id: product_id
                },
                success: function (response) {
                    if (response.success) {
                        $scope.cart.items = response.items;
                        $scope.cart.count = Object.keys($scope.cart.items).length;
                        $scope.cart.totalCost = response.total;

                        $interval.cancel($rootScope.promise);

                        $rootScope.promise = $interval(function(){
                            cartItemSync.items = response.items;
                            cartItemSync.total = response.total;
                            cartItemSync.count = response.count;
                        }, 1000);

                        if ($scope.cart.count == 0) {
                            $scope.hasItemInCart = false;
                        }
                        $scope.$applyAsync();
                    }
                },
                error: function (e) {
                    jQuery.toast.error('Đã có lỗi xảy ra');
                },
                complete: function () {
                    $scope.$applyAsync();
                }
            });
        }
    });
</script>
