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
    <div class="clearfix-30"></div>
    <main >

        <div class="container" ng-controller="bookingTour">

            <div class="row_pc">



                <div class="bookTour--wrapper">

                    <h2 class="titleH2"><a href="">Đặt tour</a></h2>

                    <div class="clearfix-20"></div>

                    <div class="row">

                        <form name="form_booking" id="form-booking" action="https://vietlandtravel.vn/booking/book" method="post">

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
                                        <td><input type="text" name="name" id="name" value="" class="validate[required]" placeholder="Họ và tên"></td>
                                    </tr>

                                    <tr>

                                        <td>Địa chỉ</td>

                                        <td><input type="text" name="address" id="address" class="" placeholder="Địa chỉ"></td>

                                    </tr>



                                    <tr>

                                        <td>Số điện thoại <span style="color: #f01927">*</span> </td>

                                        <td><input type="text" class="validate[required,custom[phone]]" name="phone_number" id="phone" placeholder="Số điện thoại"></td>

                                    </tr>



                                    <tr>

                                        <td>Email <span style="color: #f01927">*</span> </td>

                                        <td><input type="text" class="validate[required,custom[email]]" id="email" name="email" placeholder="Email"></td>

                                    </tr>



                                    <tr>

                                        <td>Khởi hành</td>

                                        <td>  <input type="text" autocomplete="off" class="timepicker" id="time_picker" name="day_depart" placeholder="d/m/Y"></td>

                                    </tr>



                                    <tr>

                                        <td>Số vé</td>

                                        <td><input type="number" onblur="tinhtien($(this))" value="1" min="1" name="TourBooking_qty" id="TourBooking_qty" placeholder="Số vé"></td>

                                    </tr>



                                    <tr>

                                        <td>Nội dung đặt tour</td>

                                        <td><textarea name="note"></textarea></td>

                                    </tr>

                                    <tr>

                                        <td></td>

                                        <td> <button type="button" onclick="booking()">Đặt tour</button></td>

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
{{--                                    <label class="col-sm-2 control-label"></label>--}}
{{--                                    <div class="col-sm-10">--}}

{{--                                        <!-- <input class="hidden"  type='radio' name='type' onclick="filter()" value=''  checked>Tất cả tour &nbsp;&nbsp;&nbsp; -->--}}

{{--                                        <input type='radio' name='type' onclick="filter(62)" value='62' >--}}
{{--                                        Tour trong nước &nbsp;&nbsp;&nbsp;--}}


{{--                                        <input type='radio' name='type' onclick="filter(63)" value='63' >--}}
{{--                                        Tour nước ngoài &nbsp;&nbsp;&nbsp;--}}

{{--                                    </div>--}}
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

                </div>

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
        })

    </script>

@endpush

