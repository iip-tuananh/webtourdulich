@extends('site.layouts.master')
@section('title')
    Liên hệ
@endsection

@section('css')
@endsection

@section('content')
    <main ng-controller="ContactUsController" ng-cloak>
        <!-- Contact Us Section Start -->
        <section class="contact-us-section section-space-ptb border-top-1">
            <div class="container">
                <div class="contact-us-section-header text-center mb-50">
                    <h2 class="contact-us-title mb-6">Liên hệ</h2>
                    <p class="contact-us-subtitle fs-5">Liên hệ chúng tôi qua form dưới đây, hoặc đến tại văn phòng của chúng tôi và chúng tôi sẽ liên hệ lại sớm và tư vấn cho bạn</p>
                </div>
                <div class="google-map-area mt-10">
                    {!! $config->location !!}
                </div>
            </div>
        </section>
        <!-- Contact Us Section End -->
        <!-- Contact Form Section Start -->
        <section class="contact-form-section section-space-pb border-bottom-1">
            <div class="container">
                <div class="row gy-10">
                    <div class="col-12 col-md-6">
                        <div class="contact-form-title mb-50">
                            <h3 class="contact-form-title">Thông tin liên hệ</h3>
                            <p class="fs-16">Bạn cần chúng tôi hỗ trợ gì? Hãy liên hệ với chúng tôi!</p>
                        </div>
                        <ul class="contact-info mt-8">
                            <li class="contact-info-item">
                                <div class="contact-info-item-icon">
                                    <i class="icon-rt-call-outline"></i>
                                </div>
                                <div class="contact-info-item-content">
                                    <span class="contact-info-item-title">Phone: <a href="tel:{{ str_replace(' ', '', $config->hotline) }}">{{ $config->hotline }}</a></span>
                                </div>
                            </li>
                            <li class="contact-info-item">
                                <div class="contact-info-item-icon">
                                    <i class="icon-rt-mail-outline"></i>
                                </div>
                                <div class="contact-info-item-content">
                                    <span class="contact-info-item-title"><a
                                            href="mailto:{{ $config->email }}">{{ $config->email }}</a></span>
                                </div>
                            </li>
                            <li class="contact-info-item">
                                <div class="contact-info-item-icon">
                                    <i class="icon-rt-map-marked-alt-solid"></i>
                                </div>
                                <div class="contact-info-item-content">
                                    <span class="contact-info-item-title">{{ $config->address_company }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="contact-form-title mb-50">
                            <h3 class="contact-form-title">Form liên hệ</h3>
                            <p class="fs-16">* Tất cả các trường được đánh dấu bằng dấu * là bắt buộc</p>
                        </div>
                        <form id="contact-form" class="contact-form mt-8">
                            <div class="contact-form-item">
                                <input type="text" name="name" class="contact-form-input" placeholder="Họ tên*" ng-model="your_name">
                                <div class="invalid-feedback d-block error" role="alert">
                                    <span ng-if="errors && errors.your_name">
                                        <% errors.your_name[0] %>
                                    </span>
                                </div>
                            </div>
                            <div class="contact-form-item">
                                <input type="email" name="email" class="contact-form-input" placeholder="Email*" ng-model="your_email">
                                <div class="invalid-feedback d-block error" role="alert">
                                    <span ng-if="errors && errors.your_email">
                                        <% errors.your_email[0] %>
                                    </span>
                                </div>
                            </div>
                            <div class="contact-form-item">
                                <input type="text" name="phone" class="contact-form-input" placeholder="Số điện thoại*" ng-model="your_phone" pattern="^\d{10}$" ng-required="true">
                                <div class="invalid-feedback d-block error" role="alert">
                                    <span ng-if="errors && errors.your_phone">
                                        <% errors.your_phone[0] %>
                                    </span>
                                </div>
                            </div>
                            <div class="contact-form-item">
                                <textarea class="contact-form-input" name="message" placeholder="Nội dung*" ng-model="your_message"></textarea>
                                <div class="invalid-feedback d-block error" role="alert">
                                    <span ng-if="errors && errors.your_message">
                                        <% errors.your_message[0] %>
                                    </span>
                                </div>
                            </div>
                            <div class="contact-form-item">
                                <button type="submit" class="btn btn-primary btn-md" ng-click="submitContact()" ng-disabled="loading">
                                    <span ng-show="!loading"><i class="icon-rt-send"></i> Gửi liên hệ</span>
                                    <span ng-show="loading"><i class="fa fa-spinner fa-spin"></i> Đang gửi liên hệ...</span>
                                </button>
                            </div>
                        </form>
                        {{-- <p class="form-messege" ng-show="loading">Đang gửi liên hệ...</p> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Form Section End -->
    </main>
@endsection

@push('script')
    <script>
        app.controller('ContactUsController', function($scope, $http) {
            $scope.loading = false;
            $scope.your_name = '';
            $scope.your_email = '';
            $scope.your_message = '';
            $scope.your_phone = '';
            $scope.errors = {};
            $scope.submitContact = function() {
                if ($scope.your_name == '' || $scope.your_email == '' || $scope.your_message == '' || $scope.your_phone == '') {
                    toastr.error('Vui lòng nhập đầy đủ thông tin !')
                    return;
                }

                $scope.loading = true;
                $scope.errors = {};
                let data = {
                    your_name: $scope.your_name,
                    your_email: $scope.your_email,
                    your_phone: $scope.your_phone,
                    your_message: $scope.your_message
                };
                jQuery.ajax({
                    url: '{{ route('front.post-contact') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Thao tác thành công !')
                        } else {
                            $scope.errors = response.errors;
                            toastr.error('Thao tác thất bại !')
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                        $scope.loading = false;
                    }
                });
            };
        });
    </script>
@endpush
