@extends('layouts.main')

@section('page_title')
    Thêm mới tour
@endsection

@section('title')
    Thêm mới tour
@endsection

@section('title')
    Thêm mới tour
@endsection
@section('content')
    <div ng-controller="CreateTour" ng-cloak>
        @include('admin.tours.form')
    </div>
@endsection
@section('script')
    @include('admin.tours.Tour')

    <script>
        app.controller('CreateTour', function ($scope, $http) {
            $scope.arrayInclude = arrayInclude;
            $scope.loading = {};

            $scope.form = new Tour({}, {scope: $scope});

            @include('admin.tours.formJs')
                $scope.submit = function () {
                $scope.loading.submit = true;
                let data = $scope.form.submit_data;

                $.ajax({
                    type: 'POST',
                    url: "/admin/tours",
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = "{{ route('Tour.index') }}";
                        } else {
                            toastr.warning(response.message);
                            $scope.errors = response.errors;
                        }
                    },
                    error: function (e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function () {
                        $scope.loading.submit = false;
                        $scope.$applyAsync();
                    }
                });
            }

        });
    </script>
@endsection
