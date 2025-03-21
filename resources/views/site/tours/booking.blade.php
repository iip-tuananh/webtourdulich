@extends('site.layouts.master')
@section('title')
    Trang đặt tour
@endsection
@section('description')
    {{$config->web_des}}
@endsection
@section('image')
    {{url(''. $banners[0]->image->path)}}
@endsection
@section('css')
@endsection
@section('content')
    <style>
        .invalid-feedback {
            width: 100%;
            margin-top: 0.25rem;
            font-size: 80%;
            color: #e3342f;
        }

        .loading-spin {
            display: none;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
    <div class="clearfix-30"></div>
    <main >

        <div class="container" ng-controller="bookingTour" ng-cloak >

            <div class="row_pc">



                <div class="bookTour--wrapper">

                    <h2 class="titleH2">
                        <a href="" ng-if="! isOk">Đặt tour</a>
                        <a href="" ng-if="isOk">Đặt tour thành công</a>
                    </h2>

                    <div class="clearfix-20"></div>

                    <div class="row" ng-if="! isOk">

                        <form name="form_booking" id="form-booking" action="#">

                            <div class="col-md-6">

                                <div class="title-steps">

                                    <h3>Thông tin liên hệ</h3>

                                    <div class="icon-steps">

                                        <h4>1</h4>

                                    </div>

                                </div>

                                <table>
                                    <tr>
                                        <td>Họ và tên <span style="color: #f01927">*</span> </td>
                                        <td><input type="text" name="booking[Tên khách hàng]" id="name" value=""
                                                   class="validate[required]" ng-model="form.customer_name" placeholder="Họ và tên">
                                            <span class="invalid-feedback d-block" role="alert">
                                                                        <strong><% errors.customer_name[0] %></strong>
                                                                  </span>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td>Địa chỉ</td>

                                        <td><input type="text" name="booking[Địa chỉ khách hàng]" ng-model="form.customer_address" id="address" class="" placeholder="Địa chỉ">
                                            <span class="invalid-feedback d-block" role="alert">
                                                                        <strong><% errors.customer_address[0] %></strong>
                                                                  </span>
                                        </td>

                                    </tr>



                                    <tr>

                                        <td>Số điện thoại <span style="color: #f01927">*</span> </td>

                                        <td><input type="text" class="validate[required,custom[phone]]" name="booking[SĐT khách hàng]"
                                                   ng-model="form.customer_phone"
                                                   id="phone" placeholder="Số điện thoại">
                                            <span class="invalid-feedback d-block" role="alert">
                                                                        <strong><% errors.customer_phone[0] %></strong>
                                                                  </span>
                                        </td>

                                    </tr>



                                    <tr>

                                        <td>Email <span style="color: #f01927">*</span> </td>

                                        <td><input type="text"  id="email" name="booking[Email khách hàng]" ng-model="form.customer_email" placeholder="Email">
                                            <span class="invalid-feedback d-block" role="alert">
                                                                        <strong><% errors.customer_email[0] %></strong>
                                                                  </span>
                                        </td>

                                    </tr>



                                    <tr>

                                        <td>Khởi hành</td>

                                        <td>  <input type="text" autocomplete="off" class="timepicker" id="time_picker"
                                                     ng-model="form.customer_time"
                                                     name="booking[Ngày khởi hành]" placeholder="d/m/Y">
                                            <span class="invalid-feedback d-block" role="alert">
                                                                        <strong><% errors.customer_time[0] %></strong>
                                                                  </span>
                                        </td>

                                    </tr>



                                    <tr>

                                        <td>Số vé</td>

                                        <td><input type="number" value="1" min="1"
                                                   ng-model="form.customer_ticket"
                                                   name="booking[Số vé]" id="TourBooking_qty" placeholder="Số vé">
                                            <span class="invalid-feedback d-block" role="alert">
                                                                        <strong><% errors.customer_ticket[0] %></strong>
                                                                  </span>
                                            </td>

                                    </tr>



                                    <tr>

                                        <td>Nội dung đặt tour</td>

                                        <td><textarea name="booking[Nội dung đặt tour]" ng-model="form.customer_content"></textarea>
                                            <span class="invalid-feedback d-block" role="alert">
                                                                        <strong><% errors.customer_content[0] %></strong>
                                                                  </span>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td></td>

                                        <td> <button type="button" ng-click="booking()" ng-disabled = "loading.submit">Đặt tour</button></td>

                                    </tr>

                                    <input type="hidden" name="token" value="JGDLJG342684023864" />



                                </table>



                            </div>

                            <div class="col-md-6">

                                <div class="title-steps info-tour">

                                    <h3>Thông tin đặt tour</h3>

                                    <div class="icon-steps">

                                        <h4>2</h4>

                                    </div>

                                </div>
                                <div class="form-group">
                                </div>
                                <label class="col-sm-2 control-label">Chọn tour</label>
                                <div class="col-sm-10">


                                    <select name="tour" class="form-control select2-in-modal" ng-model="tour_id" ng-change="getInfoTour()">
                                        <option value="">Chọn tour</option>
                                        <option ng-repeat="tour in tours" value="<% tour.id %>" ng-selected="tour.id == tour_id"><% tour.title_short %></option>
                                    </select>

                                </div>
                                <div class="fixtour" id="kq2" ng-if="tour_id">
                                    <div class="detail--left">

                                        <img  ng-src="<% tour.image.path %>" title="<% tour.title_short %>" alt="<% tour.title_short %>">

                                    </div>
                                    <div class="detail--right">

                                        <h2 style="margin: 15px 0;color: #009247"><% tour.title_short %></h2>
                                        <p><i class="fa fa-calendar"></i><span>Khởi hành : </span><% tour.schedule %></p>
                                        <p><i class="fa fa-clock-o"></i><span>Thời gian : </span><% tour.times %></p>
                                        <p><i class="fa fa-usd" aria-hidden="true"></i><span>Giá tour : </span><span class="price"><% tour.price | number %> đ</span>
                                        </p>

                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                    <div class="row" ng-if="isOk">
                        <p style="font-size: 20px">
                            Cảm ơn Quý khách đã đặt tour thành công. Chúng tôi sẽ liên hệ với Quý khách sớm để cung cấp thông tin chi tiết, mong rằng Quý khách sẽ có một hành trình du lịch an toàn và thú vị.
                        </p>
                    </div>

                </div>

            </div>

            <div class="overlay" id="overlay">
                <div class="loading-spin large centered"></div>
            </div>

        </div>

    </main>




@endsection
@push('scripts')
    <script>
        app.controller('bookingTour', function ($rootScope, $scope, $interval) {
            $scope.form = {};
            $scope.tours = @json($tours);
            $scope.tour_id = {{ $tour ? $tour->id : 0 }};
            $scope.loading = {};
            $scope.isOk = false;
            $scope.loading.submit = false;

            $scope.getInfoTour = function () {
                if($scope.tour_id) {
                    $.ajax({
                        type: 'GET',
                        url: "/get-info-tour/" + $scope.tour_id,
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        },
                        success: function(response) {
                            if (response.success) {
                                $scope.tour = response.data;
                                console.log( $scope.tour )
                            } else {
                                toastr.warning('error');
                            }
                        },
                        error: function(e) {
                            toastr.error('Đã có lỗi xảy ra');
                        },
                        complete: function() {
                            $scope.$applyAsync();
                        }
                    });
                } else {
                    $scope.tour_id = null;
                }
            }

            if($scope.tour_id){
                $scope.getInfoTour();
            }

            // $scope.booking = function () {
            //     jQuery.ajax({
            //         url: "https://script.google.com/macros/s/AKfycbzFBoal8EziEdd8CbHCMjZr-dgjKlIzIuH8SXBD68ticWSo0cZhvMJgMS9GwhuMzlNhAg/exec",
            //         type: "post",
            //         data: jQuery("#contact").serializeArray(),
            //         success: function() {
            //             toastr.success("Gửi thông tin thành công");
            //         },
            //         error: function() {
            //             toastr.error("Gửi thông tin thất bại");
            //         }
            //     });
            // }

            $scope.booking = function () {
                $scope.loading.submit = true;
                jQuery.ajax({
                    type: "POST",
                    url: "{{route('front.submit-booking')}}",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        customer_name: $scope.form.customer_name,
                        customer_phone: $scope.form.customer_phone,
                        customer_email: $scope.form.customer_email,
                        customer_time: $scope.form.customer_time,
                        customer_address: $scope.form.customer_address,
                        customer_ticket: $scope.form.customer_ticket,
                        customer_content: $scope.form.customer_content,
                    },
                    beforeSend: function () {
                        jQuery('.loading-spin').show();
                        showOverlay();

                    },
                    success: function (response) {
                        if (response.success) {
                            $scope.errors = null;
                            toastr.success("Gửi thông tin thành công");
                            $scope.isOk = true;
                            // window.location.href = "/dat-hang-thanh-cong/";
                        } else {
                            toastr.error("Gửi thông tin thất bại");
                            $scope.errors = response.errors;
                        }
                    },
                    error: function () {
                    },
                    complete: function () {
                        jQuery('.loading-spin').hide();
                        hideOverlay();
                        $scope.loading.submit = false;
                        $scope.$applyAsync();
                    },
                });
            }

            function showOverlay() {
                var overlay = document.getElementById('overlay');
                overlay.style.display = 'flex';
            }

            function hideOverlay() {
                var overlay = document.getElementById('overlay');
                overlay.style.display = 'none';
            }
        })

    </script>

@endpush

