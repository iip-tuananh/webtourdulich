@extends('site.layouts.master')
@section('title')
    Tạo thiết kế
@endsection
@section('description')
    Tạo thiết kế
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
{{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=42dot+Sans:wght@300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> --}}
<style>
    .design .container{
        max-width: 1200px;
    }
    @media (max-width: 768px) {
        .design .container{
            max-width: 100%;
        }
        .design-area {
            padding: 0 !important;
        }
        .design-area #konva-container {
            max-width: 100% !important;
            width: calc(100vw - 30px) !important;
            height: calc(100vw - 30px) !important;
        }
        #edit-text {
            top: -100px !important;
            left: 0 !important;
            width: 100% !important;
        }
    }
    .sidebar {
        width: 100%;
        /* padding: 10px; */
        /* background: #f4f4f4; */
    }
    .sidebar ul {
        list-style: none;
        padding: 0;
        border: 1px solid #8e8e8e;
        border-radius: 5px;
    }
    .sidebar ul li {
        display: block;
        padding: 10px;
        cursor: pointer;
        border-bottom: 1px solid #8e8e8e;
        font-size: 14px;
    }
    .sidebar ul li:hover {
        background-color: #f6f6f6;
    }
    .sidebar ul li:last-child {
        border-bottom: none;
    }
    .sidebar ul li a {
        display: block;
    }
    .sidebar ul li i {
        margin-right: 6px;
        font-size: 16px;
    }
    .sidebar ul li span {
        font-size: 14px;
    }
    .design-area {
        flex: 1;
        padding: 0 35px;
    }
    .design-area #konva-container {
        width: 500px;
        height: 500px;
        border-radius: 5px;
        /* border: 1px solid #8e8e8e; */
    }
    .sidebar .menu-left li.item_text {
        position: relative;
    }
    #edit-text {
        position: absolute;
        top: -30px;
        left: 20%;
        width: 120%;
        height: auto;
        background: #fff;
        display: none;
        border: 1px solid #8e8e8e;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 100;
    }
    #edit-text:after {
        bottom: -10px;
        left: 28px;
        border-right-color: #fff;
        border-left-width: 0;
        content: " ";
    }
    #edit-text.active {
        display: block;
    }
    #edit-text .modal-header {
        padding: 8px 14px;
        margin: 0;
        background-color: #f7f7f7;
        border-bottom: 1px solid #ebebeb;
        border-radius: 5px 5px 0 0;
    }
    #edit-text .modal-header .modal-title {
        font-size: 14px;
        font-weight: 400;
        line-height: 18px;
    }
    #edit-text .modal-header .btn-close {
        color: #000;
        opacity: 1;
        font-size: 12px;
    }
    #edit-text .modal-body {
        padding: 8px 14px;
        font-size: 14px;
    }
    #edit-text .modal-body .form-group {
        margin-bottom: 12px;
    }
    #edit-text .modal-body .form-group .form-control {
        height: 30px;
        padding: 0 10px;
        border: 1px solid #8e8e8e;
        border-radius: 5px;
        font-size: 14px;
    }
    #edit-text .modal-body .input-form-group {
        display: flex;
        gap: 8px;
        justify-content: space-between;
    }
    #edit-text .modal-body .input-form-group .form-group #font-color,
    #edit-text .modal-body .input-form-group .form-group #border-color {
        height: 30px;
        padding: 0;
        border: 1px solid #8e8e8e;
        border-radius: 5px;
        font-size: 14px;
    }
    #edit-text .modal-body .input-form-group .form-group #font-family {
        display: block;
        width: 70%;
        height: 30px;
        padding: 0 10px;
        border: 1px solid #8e8e8e;
        border-radius: 5px;
        font-size: 14px;
    }
    #edit-text .width-70,
    .sidebar .width-70 {
        width: 70%;
    }
    #edit-text .width-50,
    .sidebar .width-50 {
        width: 50%;
    }
    #edit-text .width-45,
    .sidebar .width-45 {
        width: 45%;
    }
    #edit-text .width-40,
    .sidebar .width-40 {
        width: 40%;
    }
    #edit-text .width-30,
    .sidebar .width-30 {
        width: 30%;
    }
    #edit-text #text-style .btn,
    #edit-text #text-align .btn {
        padding: 2px;
        border: 1px solid #8e8e8e;
        border-radius: 5px;
        background: none;
        color: #757575;
        font-size: 14px;
        width: 30px;
        height: 30px;
    }
    #edit-text #text-style .btn i,
    #edit-text #text-align .btn i {
        font-size: 14px;
        margin: 0;
    }
    #edit-text #text-style .btn:hover,
    #edit-text #text-align .btn:hover {
        background-color: #f6f6f6;
        border: 1px solid #000;
    }
    #edit-text #text-style .btn:hover i,
    #edit-text #text-align .btn:hover i {
        color: #000;
    }
    #edit-text #text-style .btn.active,
    #edit-text #text-align .btn.active {
        background-color: #f6f6f6;
        border: 1px solid #000;
    }
    #edit-text #text-style .btn.active i,
    #edit-text #text-align .btn.active i {
        color: #000;
    }
    #select-font .box-font {
        border: 1px solid #8e8e8e;
        border-radius: 4px;
        color: #666;
        cursor: pointer;
        display: inline-block;
        float: left;
        font-size: 11px;
        margin: 4px;
        min-height: 62px;
        padding: 4px 0;
        text-align: center;
        width: 145px;
    }
    #select-font .box-font:hover {
        background-color: #f6f6f6;
        border: 1px solid #007aff;
    }
    .list-layer {
        border: 1px solid #8e8e8e;
        border-radius: 5px;
    }
    .list-layer h5, .sidebar-right-info h5 {
        font-size: 14px;
        font-weight: 400;
        line-height: 18px;
        padding: 10px;
        background-color: #FCFCFC;
        margin-bottom: 0;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }
    .list-layer h5 i {
        float: right;
    }
    .list-layer ul {
        padding: 0;
        margin: 0;
        border-radius: 0;
        border: none !important;
    }
    .list-layer ul li {
        border-right: none !important;
        border-left: none !important;
        cursor: move;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .list-layer ul li:first-child {
        border-top: 1px solid #8e8e8e !important;
    }
    .list-layer ul li:last-child {
        border-bottom: none !important;
    }
    .list-layer ul li:hover {
        background-color: #f6f6f6;
    }
    .list-layer ul li i {
        cursor: pointer;
    }
    .list-layer ul li:hover i {
        color: #000;
    }
    .btn-view-product {
        width: 100%;
        background-color: #fff;
        border: 1px solid #8e8e8e;
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
        font-weight: 400;
        text-decoration: underline;
    }
    .btn-view-product:hover {
        background-color: #f6f6f6;
        border: 1px solid #000;
    }
    .sidebar ul.sidebar-right-action li {
        padding: 5px 9px;
    }
    .sidebar ul.sidebar-right-action li a i {
        font-size: 15px;
        margin-right: 0;
    }
    .sidebar ul.sidebar-right-action li a {
        text-align: center;
    }
    .group-color-box {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .group-color-box .color-box {
        cursor: pointer;
        position: relative;
    }
    .group-color-box .color-box.active:after {
        content: '\f00c';
        position: absolute;
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 12px;
        color: green;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        text-align: center;
        border: 1px solid green;
        width: 80%;
        height: 80%;
    }
    .sidebar-right-info {
        border: 1px solid #8e8e8e;
        border-radius: 5px;
    }
    .btn-buy-product-now {
        width: 100%;
        background-color: #055f92;
        border: 1px solid #055f92;
        border-radius: 5px;
        color: #fff;
        font-weight: 400;
    }
    .btn-buy-product-now:hover {
        /* background-color: #055f92; */
        border: 1px solid #055f92;
    }
    .sidebar-right-info input {
        height: 30px;
    }
    .btn-toggle-side {
        width: 30%;
        background-color: #fff;
        border: 1px solid #8e8e8e;
        border-radius: 5px;
    }
    .btn-toggle-side:hover {
        background-color: #000;
        border: 1px solid #000;
        color: #fff;
    }
    .btn-toggle-side.active {
        background-color: #000;
        border: 1px solid #000;
        color: #fff;
    }
    #modal-export-file .btn-export-file {
        background-color: #055f92;
        border: 1px solid #055f92;
        color: #fff;
        border-radius: 5px;
        font-weight: 400;
    }
    #modal-export-file .btn-export-file:hover {
        background-color: #fff;
        border: 1px solid #055f92;
        color: #055f92;
    }
</style>
@endsection

@section('content')
<main class="design" ng-controller="DesignController">
    <section class="contact-us-section section-space-ptb border-top-1">
        <div class="container">
            <div class="contact-us-section-header text-center mb-50">
                <h2 class="contact-us-title mb-6">Tạo thiết kế</h2>
                <p class="contact-us-subtitle fs-5">Tự tạo thiết kế sản phẩm theo ý muốn của bạn</p>
            </div>
        </div>
    </section>
    <div class="container section-space-pb border-bottom-1">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="sidebar">
                    <button ng-click="uploadImage()" class="btn btn-default btn-view-product" ng-disabled="!product_id">Thông tin sản phẩm</button>
                    <div class="dg-box width-100 mt-3">
                        <ul class="menu-left">
                            <li>
                                <a href="javascript:void(0);" class="view_change_products" title="" ng-click="changeProduct()">
                                    <i class="fa-solid fa-shirt"></i> <span>Chọn sản phẩm</span>
                                </a>
                            </li>

                            <li class="item_text">
                                <a href="javascript:void(0);" class="add_item_text" title="" ng-click="addText()">
                                    <i class="fa-solid fa-text-height"></i> <span>Thêm Text</span>
                                </a>
                                <div id="edit-text">
                                    <div>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="edit-text-title">Chỉnh sửa chữ</h5>
                                                <button type="button" class="btn-close" aria-label="Close" ng-click="closeModal()"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <textarea type="text" placeholder="Nhập nội dung ..." class="form-control" ng-model="inputText" ng-change="updateText()"></textarea>
                                                </div>
                                                <div class="input-form-group">
                                                    <div class="form-group width-70">
                                                        <label for="font-family">Chọn font</label>
                                                        <select id="font-family" ng-model="selectedFont" ng-click="selectFontFamily()">
                                                            <option value="">Chọn font</option>
                                                            <option ng-repeat="font in fonts" value="<%font%>" ng-selected="selectedFont == '<%font%>'"><%font%></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="font-color">Màu sắc</label>
                                                        <input type="color" id="font-color" class="form-control" ng-model="textColor" ng-change="updateTextColor()" />
                                                    </div>
                                                </div>
                                                <div class="input-form-group">
                                                    <div class="form-group width-50">
                                                        <label for="font-size">Kích thước</label>
                                                        <input type="number" id="font-size" class="form-control width-70" ng-model="fontSize" ng-change="updateFontSize()" />
                                                    </div>
                                                    <div class="form-group width-50">
                                                        <label for="border-color">Viền ngoài</label>
                                                        <div class="input-form-group">
                                                            <input type="color" id="border-color" class="form-control" ng-model="borderColor" ng-change="updateBorderColor()" />
                                                            <input type="number" id="border-width" class="form-control" ng-model="borderWidth" ng-change="updateBorderWidth()" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-form-group">
                                                    <div class="form-group width-50">
                                                        <label for="text-align">Kiểu ký tự</label>
                                                        <div id="text-style">
                                                            <span id="text-style-i" class="btn btn-default" ng-class="{'active': textStyle == 'italic'}" ng-click="updateTextStyle('italic')"><i class="fa-solid fa-italic"></i></span>
                                                            <span id="text-style-b" class="btn btn-default" ng-class="{'active': textStyle == 'bold'}" ng-click="updateTextStyle('bold')"><i class="fa-solid fa-bold"></i></span>
                                                            <span id="text-style-u" class="btn btn-default" ng-class="{'active': textStyle == 'underline'}" ng-click="updateTextStyle('underline')"><i class="fa-solid fa-underline"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group width-50">
                                                        <label for="text-align">Căn chỉnh</label>
                                                        <div id="text-align">
                                                            <span id="text-align-left" class="btn btn-default" ng-class="{'active': textAlign == 'left'}" ng-click="updateTextAlign('left')"><i class="fa-solid fa-align-left"></i></span>
                                                            <span id="text-align-center" class="btn btn-default" ng-class="{'active': textAlign == 'center'}" ng-click="updateTextAlign('center')"><i class="fa-solid fa-align-center"></i></span>
                                                            <span id="text-align-right" class="btn btn-default" ng-class="{'active': textAlign == 'right'}" ng-click="updateTextAlign('right')"><i class="fa-solid fa-align-right"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-form-group">
                                                    <div class="form-group width-50">
                                                        <label for="text-align">Xóa chữ</label>
                                                        <div id="text-align">
                                                            <span id="delete-text" class="btn btn-default" ng-click="deleteText()"><i class="fa-solid fa-trash"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group width-50">
                                                        <label for="text-align">Xoay </label>
                                                        <div id="text-align">
                                                            <input type="number" id="text-align-rotate" class="form-control width-50" style="display: inline-block;" ng-model="rotateText" ng-change="updateRotateText()" />°
                                                            <span id="reset-rotate" class="btn btn-default" ng-click="resetRotateText()"><i class="fa-solid fa-rotate-left"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="add_item_clipart" title="" ng-click="uploadImage()">
                                    <i class="fa-solid fa-cloud-arrow-up"></i> <span>Tải hình ảnh lên</span>
                                </a>
                            </li>
                        </ul>
                        <div class="mt-3 list-layer">
                            <h5>Danh sách lớp <i class="fa-solid fa-arrow-down-short-wide"></i></h5>
                            <ul id="layer-list">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="design-area">
                    <div id="konva-container"></div>
                </div>
                <div class="design-area-footer text-center d-flex mt-2" style="gap: 10px; justify-content: center;">
                    <button class="btn btn-default btn-toggle-side" ng-click="toggleSide()" ng-class="{'active': isFrontLayer}"> Mặt trước</button>
                    <button class="btn btn-default btn-toggle-side" ng-click="toggleSide()" ng-class="{'active': !isFrontLayer}"> Mặt sau</button>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="sidebar-right sidebar">
                    <div class="row">
                        <div class="col-2 col-md-2 p-0">
                            <ul class="sidebar-right-action width-70">
                                <li>
                                    <a href="javascript:void(0);" ng-click="flipHorizontalLayerSelected()" title="Lật ngang" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-left-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" ng-click="flipVerticalLayerSelected()" title="Lật dọc" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-up-down"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" ng-click="rotateRightLayerSelected()" title="Xoay phải" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-rotate-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" ng-click="rotateLeftLayerSelected()" title="Xoay trái" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" title="Di chuyển sang trái" ng-click="moveLeftLayerSelected()" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-angles-left"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" title="Di chuyển sang phải" ng-click="moveRightLayerSelected()" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-angles-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" title="Di chuyển lên trên" ng-click="moveUpLayerSelected()" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-angles-up"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" title="Di chuyển xuống dưới" ng-click="moveDownLayerSelected()" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-angles-down"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" title="Xóa" ng-click="deleteLayerSelected()" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" title="Thiết lập lại" ng-click="resetLayerSelected()" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-repeat"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" title="Sao chép" ng-click="copyLayerSelected()" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fa-solid fa-copy"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-10 col-md-10" style="padding-left: 0;">
                            <div class="d-flex" style="gap: 10px">
                                <button class="btn btn-default btn-view-product" ng-disabled="!product_id">Xem thiết kế</button>
                                <button ng-click="exportFile()" class="btn btn-default btn-view-product" ng-disabled="!product_id">Xuất file</button>
                            </div>
                            <div class="sidebar-right-info mt-2">
                                <h5 style="border-bottom: 1px solid #8e8e8e;">Lựa chọn sản phẩm</h5>
                                <div class="p-2" >
                                    <div class="title-color-product mb-2">
                                        <span><span class="text-danger">(*)</span> Chọn màu sắc sản phẩm</span>
                                    </div>
                                    <div class="group-color-box pb-2" style="border-bottom: 1px dashed #8e8e8e;">
                                        <div ng-click="updateColorProduct('#FFFFFF')" class="color-box" ng-class="{'active': colorProduct == '#FFFFFF'}" style="background-color: #FFFFFF; border: 1px solid #8e8e8e; width: 30px; height: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Màu trắng"></div>
                                        <div ng-click="updateColorProduct('#000000')" class="color-box" ng-class="{'active': colorProduct == '#000000'}" style="background-color: #000000; border: 1px solid #8e8e8e; width: 30px; height: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Màu đen"></div>
                                        <div ng-click="updateColorProduct('#800000')" class="color-box" ng-class="{'active': colorProduct == '#800000'}" style="background-color: #800000; border: 1px solid #8e8e8e; width: 30px; height: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Màu đỏ đô"></div>
                                        <div ng-click="updateColorProduct('#FFA500')" class="color-box" ng-class="{'active': colorProduct == '#FFA500'}" style="background-color: #FFA500; border: 1px solid #8e8e8e; width: 30px; height: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Màu cam"></div>
                                        <div ng-click="updateColorProduct('#FFD700')" class="color-box" ng-class="{'active': colorProduct == '#FFD700'}" style="background-color: #FFD700; border: 1px solid #8e8e8e; width: 30px; height: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Màu vàng"></div>
                                        <div ng-click="updateColorProduct('#D4AF37')" class="color-box" ng-class="{'active': colorProduct == '#D4AF37'}" style="background-color: #D4AF37; border: 1px solid #8e8e8e; width: 30px; height: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Màu vàng gold"></div>
                                        <div ng-click="updateColorProduct('#000080')" class="color-box" ng-class="{'active': colorProduct == '#000080'}" style="background-color: #000080; border: 1px solid #8e8e8e; width: 30px; height: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Màu xanh navy"></div>
                                        <div ng-click="updateColorProduct('#90EE90')" class="color-box" ng-class="{'active': colorProduct == '#90EE90'}" style="background-color: #90EE90; border: 1px solid #8e8e8e; width: 30px; height: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Màu xanh lá nhạt"></div>
                                        <div ng-click="updateColorProduct('#8B4513')" class="color-box" ng-class="{'active': colorProduct == '#8B4513'}" style="background-color: #8B4513; border: 1px solid #8e8e8e; width: 30px; height: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Màu nâu"></div>
                                    </div>
                                    <div class="title-color-product mb-2 mt-2">
                                        <span><span class="text-danger">(*)</span> Kích thước (cm)</span>
                                    </div>
                                    <div class="group-size-box d-flex flex-wrap" style="gap: 10px;">
                                        <div class="form-group width-45">
                                            <label for="size-product">Chiều dài</label>
                                            <input type="number" class="form-control" ng-model="sizeProduct['length']" min="0">
                                        </div>
                                        <div class="form-group width-45">
                                            <label for="size-product">Chiều rộng</label>
                                            <input type="number" class="form-control" ng-model="sizeProduct['width']" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group width-100 mb-2 pb-2" style="gap: 10px; border-bottom: 1px dashed #8e8e8e;">
                                        <label for="size-product">Chiều cao (đối với túi hộp)</label>
                                        <input type="number" class="form-control" ng-model="sizeProduct['height']" min="0">
                                    </div>
                                    <div class="title-color-product mb-2 mt-2">
                                        <span><span class="text-danger">(*)</span> Thuộc tính của dép</span>
                                    </div>
                                    <div class="form-group width-100">
                                        <label for="size-product">Mũ (quai dép) + Thân (tẩy)</label>
                                        <select class="form-control select2" ng-model="product_attributes['hat_and_shoe_body']">
                                            <option value="">Chọn loại vải</option>
                                            <option value="Tery">Tery</option>
                                            <option value="Visa">Visa</option>
                                            <option value="Coral">Coral</option>
                                            <option value="Nhung">Nhung</option>
                                            <option value="Mex">Mex</option>
                                            <option value="Kaki">Kaki</option>
                                        </select>
                                    </div>
                                    <div class="form-group width-100">
                                        <label for="size-product">Lót</label>
                                        <select class="form-control select2" ng-model="product_attributes['footwear_lining']">
                                            <option value="">Chọn chất liệu</option>
                                            <option value="Lót bìa giấy">Lót bìa giấy (tái sử dụng 2-3 lần)</option>
                                            <option value="Lót EVA">Lót EVA (tái sử dụng 5-8 lần)</option>
                                        </select>
                                    </div>
                                    <div class="form-group width-100">
                                        <label for="size-product">Loại đế dép</label>
                                        <select class="form-control select2" ng-model="product_attributes['shoe']">
                                            <option value="">Chọn loại đế</option>
                                            <option value="Vân sóng">Vân sóng</option>
                                            <option value="Vân sóng">Vân sóng</option>
                                            <option value="Caro">Caro</option>
                                            <option value="Chấm nhựa">Chấm nhựa</option>
                                            <option value="Ép nhiệt">Đế ép nhiệt siêu bền, êm</option>
                                        </select>
                                    </div>
                                    <div class="form-group width-100">
                                        <label for="size-product">Độ dày đế dép</label>
                                        <select class="form-control select2" ng-model="product_attributes['shoe_thickness']">
                                            <option value="">Chọn độ dày</option>
                                            <option value="1.5mm">1.5mm</option>
                                            <option value="2mm">2mm</option>
                                            <option value="2.5mm">2.5mm</option>
                                            <option value="3mm">3mm</option>
                                            <option value="3.5mm">3.5mm</option>
                                            <option value="4mm">4mm</option>
                                            <option value="4.5mm">4.5mm</option>
                                            <option value="5mm">5mm</option>
                                            <option value="5.5mm">5.5mm</option>
                                            <option value="6mm">6mm</option>
                                            <option value="6.5mm">6.5mm</option>
                                            <option value="7mm">7mm</option>
                                        </select>
                                    </div>
                                    <div class="form-group width-100 mb-2 pb-2" style="border-bottom: 1px dashed #8e8e8e;">
                                        <label for="size-product">Loại viền</label>
                                        <select class="form-control select2" ng-model="product_attributes['shoe_border']">
                                            <option value="">Chọn loại viền</option>
                                            <option value="Tex">Tex</option>
                                            <option value="Mex">Mex</option>
                                            <option value="Thun">Thun</option>
                                        </select>
                                    </div>
                                    {{-- <div class="title-color-product mb-2 mt-2">
                                        <span><span class="text-danger">(*)</span> Size</span>
                                    </div>
                                    <div class="group-size-box d-flex flex-wrap mb-2 pb-2" style="gap: 10px; border-bottom: 1px dashed #8e8e8e;">
                                        <div class="form-group width-30">
                                            <label for="size-product">S</label>
                                            <input type="number" class="form-control" ng-model="sizeProduct['S']" min="0">
                                        </div>
                                        <div class="form-group width-30">
                                            <label for="size-product">M</label>
                                            <input type="number" class="form-control" ng-model="sizeProduct['M']" min="0">
                                        </div>
                                        <div class="form-group width-30">
                                            <label for="size-product">L</label>
                                            <input type="number" class="form-control" ng-model="sizeProduct['L']" min="0">
                                        </div>
                                        <div class="form-group width-30">
                                            <label for="size-product">XL</label>
                                            <input type="number" class="form-control" ng-model="sizeProduct['XL']" min="0">
                                        </div>
                                        <div class="form-group width-30">
                                            <label for="size-product">XXL</label>
                                            <input type="number" class="form-control" ng-model="sizeProduct['XXL']" min="0">
                                        </div>
                                        <div class="form-group width-30">
                                            <label for="size-product">XXXL</label>
                                            <input type="number" class="form-control" ng-model="sizeProduct['XXXL']" min="0">
                                        </div>
                                        <div class="form-group width-30">
                                            <label for="size-product">XXXXL</label>
                                            <input type="number" class="form-control" ng-model="sizeProduct['XXXXL']" min="0">
                                        </div>
                                    </div> --}}
                                    <div class="mt-2 text-center">
                                        <button class="btn btn-default btn-buy-product-now" ng-click="orderDesign()"><i class="fa-solid fa-cart-shopping"></i> Đặt hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="select-font" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 14px; font-weight: 400; line-height: 18px;">Chọn font</h5>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 list-fonts">
                            <a class="box-font" href="javascript:void(0)" ng-click="selectFont(font)" ng-repeat="font in fonts">
                                <h2 class="margin-0" style="font-family:'<% font %>', sans-serif;">abc zyz</h2><%font%>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="select-product" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 14px; font-weight: 400; line-height: 18px;">Chọn sản phẩm</h5>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="search-product">Danh mục</label>
                                <select id="search-product" style="width: 70%;" class="form-control select2-in-modal" ng-model="cate_id" ng-change="searchCateProduct()">
                                    <option value="">Chọn danh mục</option>
                                    <option ng-repeat="category in categories" value="<% category.id %>"><% category.name %></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3" ng-if="products.length > 0">
                        <div class="col-6 col-md-3" ng-repeat="product in products">
                            <a class="box-category" href="javascript:void(0)" ng-click="selectProduct(product)">
                                <img src="<% product.image.path %>" alt="Hình ảnh" style="width: 100%; height: 100%; object-fit: cover;">
                                <h5 class="mt-1 mb-4 text-center" style="font-size: 15px; font-weight: 400; line-height: 18px;"><% product.name %></h5>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-3" ng-if="products.length == 0">
                        <div class="col-md-12">
                            <h5 class="text-center" style="font-size: 16px; font-weight: 400; line-height: 18px;">Không có sản phẩm nào</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-export-file" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 14px; font-weight: 400; line-height: 18px;">Chọn xuất file</h5>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="export-file"><span class="text-danger">(*)</span> Chọn định dạng xuất file</label>
                                <div class="d-flex mt-4 mb-4" style="gap: 10px; justify-content: space-evenly;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="export-file" id="export-file-png" value="image/png" ng-model="exportFileType" ng-selected="exportFileType == 'image/png'">
                                        <label class="form-check-label" for="export-file-png">PNG</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="export-file" id="export-file-jpg" value="image/jpeg" ng-model="exportFileType" ng-selected="exportFileType == 'image/jpeg'">
                                        <label class="form-check-label" for="export-file-jpg">JPG</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="export-file" id="export-file-pdf" value="application/pdf" ng-model="exportFileType" ng-selected="exportFileType == 'application/pdf'">
                                        <label class="form-check-label" for="export-file-pdf">PDF</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group float-end">
                                <button class="btn btn-default btn-export-file" ng-click="exportDesign()">Xuất file</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-order-design" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 14px; font-weight: 400; line-height: 18px;">Đặt hàng</h5>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Họ tên khách hàng</label>
                                <input type="text" class="form-control" ng-model="formCustom.name">
                                <div class="invalid-feedback d-block error" role="alert">
                                    <span ng-if="errors && errors.name">
                                        <% errors.name[0] %>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" ng-model="formCustom.phone">
                                <div class="invalid-feedback d-block error" role="alert">
                                    <span ng-if="errors && errors.phone">
                                        <% errors.phone[0] %>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" ng-model="formCustom.email">
                                <div class="invalid-feedback d-block error" role="alert">
                                    <span ng-if="errors && errors.email">
                                        <% errors.email[0] %>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" ng-model="formCustom.address">
                                <div class="invalid-feedback d-block error" role="alert">
                                    <span ng-if="errors && errors.address">
                                        <% errors.address[0] %>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note">Ghi chú</label>
                                <textarea class="form-control" ng-model="formCustom.note"></textarea>
                                <div class="invalid-feedback d-block error" role="alert">
                                    <span ng-if="errors && errors.note">
                                        <% errors.note[0] %>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group float-end mt-2">
                                <button class="btn btn-default btn-buy-product-now" ng-click="submitOrderDesign()" ng-disabled="isLoading">
                                    <span ng-if="!isLoading">Gửi đặt hàng</span>
                                    <span ng-if="isLoading"><i class="fa fa-spinner fa-spin"></i> Đang gửi đặt hàng</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@push('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/konva/8.3.5/konva.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/konva@9.2.3/konva.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    $(document).on("show.bs.modal", ".modal", function() {
        let modal = $(this).find(".modal-content");
        $(this)
            .find(".select2-in-modal")
            .each(function() {
                $(this).select2({
                    dropdownParent: modal
                });
            });
    });
    $(document).ready(function() {
        $('.select2').select2();

        $('#edit-text .btn-close').click(function() {
            $('#edit-text').removeClass('active');
        });

        $('[data-bs-toggle="tooltip"]').tooltip(); // Kích hoạt tooltip
    });
</script>
<script>
app.controller("DesignController", function($scope, $http) {
    $scope.fonts = [];
    $scope.selectedText = null;
    $scope.selectedFont = null;
    $scope.fontSize = 42;
    $scope.textColor = "#000";
    $scope.borderColor = "#000";
    $scope.borderWidth = 0;
    $scope.textAlign = "left";
    $scope.textStyle = "normal";
    $scope.rotateText = 0;
    $scope.distanceText = 0;
    $scope.colorProduct = '#fff';
    $scope.selectedElement = null; // Phần tử được chọn
    $scope.isFrontLayer = true;
    $scope.exportFileType = null;
    $scope.categories = @json(\App\Model\Admin\Category::getForSelect());
    $scope.cate_id = "";
    $scope.products = [];
    $scope.product_id = null;
    $scope.product = {};

    $http.get("https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCdacIhmU-RaY5caSAFqWyaupl4tbfOxE4")
        .then(function (response) {
            let vietnameseFonts = response.data.items.filter(font => font.subsets.includes("vietnamese"));

            $scope.fonts = vietnameseFonts.map(font => font.family);
            let fonts = vietnameseFonts.map(font => font.family.replace(/ /g, "+"));
            let fontUrl = `https://fonts.googleapis.com/css2?family=${fonts.join("&family=")}`;

            let link = document.createElement("link");
            link.rel = "stylesheet";
            link.href = fontUrl;
            document.head.appendChild(link);
        })
        .catch(function (error) {
            console.error("Lỗi lấy font:", error);
        });

    // Khởi tạo stage
    var stage = new Konva.Stage({
        container: 'konva-container',
        // width: 500,
        // height: 500
        width: document.getElementById('konva-container').offsetWidth,
        height: document.getElementById('konva-container').offsetHeight
    });

    var frontLayer = new Konva.Layer();
    var backLayer = new Konva.Layer();
    stage.add(frontLayer);
    stage.add(backLayer);

    // Transformer giúp chỉnh sửa kích thước
    var transformer = new Konva.Transformer({
        nodes: [],
        rotateAnchorOffset: 0, // Điều chỉnh khoảng cách nút xoay
        anchorSize: 6, // Kích thước nút điều chỉnh
        anchorCornerRadius: 0, // Bo góc nút
        anchorStroke: "#707070", // Màu viền nút
        anchorFill: "#fff", // Màu nền nút
        borderStroke: "#707070", // Màu viền khung
        borderStrokeWidth: 2, // Độ dày viền khung
        borderDash: [3, 3], // Định dạng nét đứt
    });

    // Thêm Transformer vào nhóm
    frontLayer.add(transformer);
    backLayer.add(transformer);

    // Mặc định hiển thị mặt trước
    backLayer.hide();
    stage.draw();

    // Chuyển đổi giữa mặt trước và mặt sau
    $scope.toggleSide = function() {
        if ($scope.isFrontLayer) {
            frontLayer.hide();
            backLayer.show();
        } else {
            backLayer.hide();
            frontLayer.show();
        }
        $scope.isFrontLayer = !$scope.isFrontLayer;
        updateLayerList();
        stage.draw();
    };

     // Thêm chữ
    $scope.addText = function () {
        $('#edit-text').addClass('active');
        var text = new Konva.Text({
            x: Math.random() * 400,
            y: Math.random() * 300,
            text: "Hello",
            fontSize: 42,
            fontFamily: "Alata",
            fill: "#000000",
            stroke: "#000000",
            strokeWidth: 0,
            rotation: 0,
            align: "left",
            fontStyle: "normal",
            opacity: 0.7,
            draggable: true, // Kéo thả được
        });

        // Bắt sự kiện click để chọn chữ
        text.on("click", function () {
            $scope.$applyAsync(function () {
                $('#edit-text').addClass('active');
            });

            $scope.selectedText = this;
            $scope.inputText = this.text(); // Cập nhật input với nội dung hiện tại
            $scope.selectedFont = this.fontFamily();
            $scope.textColor = this.fill();
            $scope.fontSize = this.fontSize();
            $scope.borderColor = this.stroke();
            $scope.borderWidth = this.strokeWidth();
            $scope.textAlign = this.align();
            $scope.textStyle = this.fontStyle();
            $scope.rotateText = this.rotation();
            $scope.$applyAsync();
            transformer.nodes([$scope.selectedText]); // Hiển thị khung chỉnh sửa
            // transformer.moveToTop();
            if ($scope.isFrontLayer) {
                transformer.moveTo(frontLayer);
                frontLayer.draw();
            } else {
                transformer.moveTo(backLayer);
                backLayer.draw();
            }
        });
        transformer.nodes([text]);
        $scope.selectedText = text;
        $scope.selectedElement = text;
        $scope.inputText = text.text(); // Gán nội dung cho input
        $scope.selectedFont = text.fontFamily();
        $scope.textColor = text.fill();
        $scope.fontSize = text.fontSize();
        $scope.borderColor = text.stroke();
        $scope.borderWidth = text.strokeWidth();
        $scope.textAlign = text.align();
        $scope.textStyle = text.fontStyle();
        $scope.rotateText = text.rotation();
        if ($scope.isFrontLayer) {
            transformer.moveTo(frontLayer);
            frontLayer.add(text);
            frontLayer.draw();
        } else {
            transformer.moveTo(backLayer);
            backLayer.add(text);
            backLayer.draw();
        }

        addLayer('text', $scope.selectedText.text(), $scope.selectedText, $scope.isFrontLayer);
    };

    // Chỉnh sửa nội dung chữ
    $scope.updateText = function () {
        if ($scope.selectedText) {
            if ($scope.isFrontLayer) {
                frontLayers.find(layer => layer.text === $scope.selectedText.text()).text = $scope.inputText;
                $scope.selectedText.text($scope.inputText);
                frontLayer.draw();
            } else {
                backLayers.find(layer => layer.text === $scope.selectedText.text()).text = $scope.inputText;
                $scope.selectedText.text($scope.inputText);
                backLayer.draw();
            }
            updateLayerList();
        }
    };

    // Xóa chữ
    $scope.deleteText = function () {
        if ($scope.selectedText) {
            if ($scope.isFrontLayer) {
                frontLayers.find(layer => layer.text === $scope.selectedText.text()).node.destroy();
                $scope.selectedText.destroy();
                transformer.nodes([]); // Xóa transformer
                frontLayer.draw();
                frontLayers.splice(frontLayers.findIndex(layer => layer.text === $scope.selectedText.text()), 1);
            } else {
                backLayers.find(layer => layer.text === $scope.selectedText.text()).node.destroy();
                $scope.selectedText.destroy();
                transformer.nodes([]); // Xóa transformer
                backLayer.draw();
                backLayers.splice(backLayers.findIndex(layer => layer.text === $scope.selectedText.text()), 1);
            }

            updateLayerList();
            $scope.selectedText = null;
            $('#edit-text').removeClass('active');
        } else {
            alert("Vui lòng chọn chữ cần xóa.");
        }
    };

    // Chọn font
    $scope.selectFontFamily = function() {
        $('#select-font').modal('show');
    }

    $scope.selectFont = function(font) {
        $('#select-font').modal('hide');
        $scope.selectedFont = font;
        if ($scope.selectedText) {
            $scope.selectedText.fontFamily($scope.selectedFont);
        }
        if ($scope.isFrontLayer) {
            frontLayer.draw();
        } else {
            backLayer.draw();
        }
        $scope.$applyAsync();
    }

    $scope.updateBorderColor = function() {
        if ($scope.selectedText) {
            $scope.selectedText.stroke($scope.borderColor);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.updateBorderWidth = function() {
        if ($scope.selectedText) {
            $scope.selectedText.strokeWidth($scope.borderWidth);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.updateFontSize = function() {
        if ($scope.selectedText) {
            $scope.selectedText.fontSize($scope.fontSize);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.updateTextAlign = function(align) {
        if ($scope.selectedText) {
            $scope.textAlign = align;
            $scope.selectedText.align(align);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.updateTextStyle = function(style) {
        if ($scope.selectedText) {
            $scope.textStyle = style;
            $scope.selectedText.fontStyle(style);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.updateRotateText = function() {
        if ($scope.selectedText) {
            $scope.selectedText.rotation($scope.rotateText);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.resetRotateText = function() {
        if ($scope.selectedText) {
            $scope.selectedText.rotation(0);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    // Cập nhật màu chữ
    $scope.updateTextColor = function() {
        if ($scope.selectedText) {
            $scope.selectedText.fill($scope.textColor);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    };

    // Xóa chọn khi click ra ngoài
    stage.on('click', function (e) {
        $('#edit-text').removeClass('active');
        if (e.target === stage || e.target.isBaseImage) {
            $scope.selectedElement = null;
            transformer.nodes([]);
            frontLayer.draw();
            return;
        }

        $scope.selectedElement = e.target;
        transformer.nodes([$scope.selectedElement]);
        // Chuyển transformer vào đúng layer hiện tại
        if ($scope.isFrontLayer) {
            transformer.moveTo(frontLayer);
            frontLayer.draw();
        } else {
            transformer.moveTo(backLayer);
            backLayer.draw();
        }

    });

    // Upload ảnh
    $scope.uploadImage = function() {
        var input = document.createElement('input');
        input.type = 'file';
        input.onchange = function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(event) {
                var imageObj = new Image();
                imageObj.src = event.target.result;
                imageObj.onload = function() {
                    var img = new Konva.Image({
                        x: 100,
                        y: 100,
                        width: 100,
                        height: 100,
                        image: imageObj,
                        opacity: 0.8,
                        draggable: true
                    });
                    transformer.nodes([img]);
                    if ($scope.isFrontLayer) {
                        transformer.moveTo(frontLayer);
                        frontLayer.add(img);
                        frontLayer.draw();
                    } else {
                        transformer.moveTo(backLayer);
                        backLayer.add(img);
                        backLayer.draw();
                    }
                    $scope.selectedElement = img;

                    addLayer('image', 'Hình ảnh', img, $scope.isFrontLayer);
                };
            };
            reader.readAsDataURL(file);
        };
        input.click();
    };

    $scope.changeProduct = function(category) {
        $('#select-product').modal('show');
    }

    $scope.searchCateProduct = function() {
        $http.get(`/search-product?cate_id=${$scope.cate_id}&type=response`)
            .then(function (response) {
                $scope.products = response.data.products;
            });
    }

    $scope.searchCateProduct();

    $scope.selectProduct = function(product) {
        if (!product.image && !product.image_back) return;
        $('#select-product').modal('hide');
        $scope.product_id = product.id;
        $scope.product = product;

        // Mặt trước
        if (product.image) {
            var imageObj = new Image();
            imageObj.crossOrigin = "anonymous";
            imageObj.src = product.image.path;
            var img = new Konva.Image({
                x: 0,
                y: 0,
                // width: 500,
                // height: 500,
                width: document.getElementById('konva-container').offsetWidth,
                height: document.getElementById('konva-container').offsetHeight,
                image: imageObj,
                draggable: false
            });
            img.isBaseImage = true;
            addLayer('image', 'Ảnh sản phẩm (mặt trước)', img, true);
            frontLayer.add(img);
            frontLayer.draw();
        }

        // Mặt sau
        if (!product.image_back) return;
        var imageObjBack = new Image();
        imageObjBack.crossOrigin = "anonymous";
        imageObjBack.src = product.image_back.path;
        var imgBack = new Konva.Image({
            x: 0,
            y: 0,
            // width: 500,
            // height: 500,
            width: document.getElementById('konva-container').offsetWidth,
            height: document.getElementById('konva-container').offsetHeight,
            image: imageObjBack,
            draggable: false
        });
        imgBack.isBaseImage = true;
        addLayer('image', 'Ảnh sản phẩm (mặt sau)', imgBack, false);
        backLayer.add(imgBack);
        backLayer.draw();
    }

    $scope.updateColorProduct = function(color) {
        $scope.colorProduct = color;
        if (frontLayers.length == 0 || !$scope.product_id || !frontLayers.find(layer => layer.node.isBaseImage)) return;

        // Tìm ảnh sản phẩm trong layers
        let productFrontLayer = frontLayers.find(layer => layer.node.isBaseImage);
        let productBackLayer = backLayers.find(layer => layer.node.isBaseImage);
        if (!productFrontLayer) return;
        let imgNode = productFrontLayer.node;
        let imgNodeBack = null;
        if (productBackLayer) {
            imgNodeBack = productBackLayer.node;
        }

        // Nếu chọn màu trắng, quay lại ảnh gốc
        if (color === "#fff") {
            if ($scope.colorOverlay) {
                $scope.colorOverlay.destroy(); // Xóa lớp màu
                $scope.colorOverlay = null;
            }
            if ($scope.maskOverlay) {
                $scope.maskOverlay.destroy(); // Xóa lớp mask
                $scope.maskOverlay = null;
            }
            frontLayer.draw();
            backLayer.draw();
            return;
        }

        // Nếu chưa có lớp màu, tạo mới
        if (!$scope.colorOverlay) {
            $scope.colorOverlay = new Konva.Rect({
                x: imgNode.x(),
                y: imgNode.y(),
                width: imgNode.width(),
                height: imgNode.height(),
                fill: color,
                globalCompositeOperation: "multiply", // Hòa màu tự nhiên
                listening: false
            });
            frontLayer.add($scope.colorOverlay);

            if (imgNodeBack) {
                $scope.colorOverlayBack = new Konva.Rect({
                    x: imgNodeBack.x(),
                    y: imgNodeBack.y(),
                    width: imgNodeBack.width(),
                    height: imgNodeBack.height(),
                    fill: color,
                    globalCompositeOperation: "multiply", // Hòa màu tự nhiên
                    listening: false
                });
                backLayer.add($scope.colorOverlayBack);
            }
        }

        // Nếu chưa có lớp mask, tạo mới
        if (!$scope.maskOverlay) {
            $scope.maskOverlay = new Konva.Image({
                x: imgNode.x(),
                y: imgNode.y(),
                width: imgNode.width(),
                height: imgNode.height(),
                image: imgNode.image(),
                globalCompositeOperation: "destination-in", // Giữ nét gốc
                listening: false
            });
            frontLayer.add($scope.maskOverlay);

            if (imgNodeBack) {
                $scope.maskOverlayBack = new Konva.Image({
                    x: imgNodeBack.x(),
                    y: imgNodeBack.y(),
                    width: imgNodeBack.width(),
                    height: imgNodeBack.height(),
                    image: imgNodeBack.image(),
                globalCompositeOperation: "destination-in", // Giữ nét gốc
                    listening: false
                });
                backLayer.add($scope.maskOverlayBack);
            }
        }

        // Cập nhật màu
        $scope.colorOverlay.fill(color);
        $scope.colorOverlayBack.fill(color);
        frontLayer.draw();
        backLayer.draw();
    }

    let frontLayers = []; // Mảng chứa danh sách layer
    let backLayers = []; // Mảng chứa danh sách layer

    // Hiển thị sản phẩm gốc được chuyển từ chi tiết sản phẩm
    $scope.productOriginal = @json($product);
    if ($scope.productOriginal) {
        $scope.selectProduct($scope.productOriginal);
    }

    function addLayer(type, text = "", node = null, isFront = true) {
        let id = `layer-${frontLayers.length}`;
        let item = {
            id: id,
            type: type,
            text: text,
            node: node,
            isFront: isFront
        };

        if (isFront) {
            frontLayers.push(item);
        } else {
            backLayers.push(item);
        }
        updateLayerList();
    }

    function deleteLayer(index, isFront) {
        let item = isFront ? frontLayers[index] : backLayers[index];

        if (!item || !item.node) return;

        if (item.type == 'image' && item.node.isBaseImage) {
            $scope.product_id = null;
            $scope.colorProduct = null;
            $scope.sizeProduct = null;
            if ($scope.colorOverlay) {
                $scope.colorOverlay.destroy();
            }
            if ($scope.maskOverlay) {
                $scope.maskOverlay.destroy();
            }
        }
        // Xóa khỏi Konva
        item.node.destroy();
        transformer.nodes([]);
        if (isFront) {
            frontLayer.draw();
            frontLayers.splice(index, 1);
        } else {
            backLayer.draw();
            backLayers.splice(index, 1);
        }

        updateLayerList();
    }

    new Sortable(document.getElementById("layer-list"), {
        animation: 150,
        onEnd: function (evt) {
            let oldIndex = evt.oldIndex;
            let newIndex = evt.newIndex;

            if ($scope.isFrontLayer) {
                let movedItem = frontLayers.splice(oldIndex, 1)[0];
                frontLayers.splice(newIndex, 0, movedItem);
                frontLayers.forEach((item, index) => {
                    item.node.zIndex(index);
                });
            } else {
                let movedItem = backLayers.splice(oldIndex, 1)[0];
                backLayers.splice(newIndex, 0, movedItem);
                backLayers.forEach((item, index) => {
                    item.node.zIndex(index);
                });
            }
            updateLayerList();
        },
    });

    // Hàm cập nhật danh sách
    function updateLayerList() {
        let list = document.getElementById("layer-list");
        list.innerHTML = "";

        if ($scope.isFrontLayer) {
            frontLayers.forEach((layer, index) => {
                let li = document.createElement("li");
                li.innerHTML = `
                    <div class="layer-item" style="width: 100%;">${layer.type == 'text' ? '<i class="fa-solid fa-font"></i>' : '<img src="' + layer.node.image().src + '" alt="Ảnh" style="width: 20px; height: 20px; margin-right: 6px;">'} ${layer.text}</div>
                    <i class="fa-solid fa-up-down-left-right" draggable="true"></i>
                    <i class="fa-solid fa-trash delete-btn"></i>
                `;
                li.setAttribute("data-index", index);
                list.appendChild(li);
            });
        } else {
            backLayers.forEach((layer, index) => {
                let li = document.createElement("li");
                li.innerHTML = `
                    <div class="layer-item" style="width: 100%;">${layer.type == 'text' ? '<i class="fa-solid fa-font"></i>' : '<img src="' + layer.node.image().src + '" alt="Ảnh" style="width: 20px; height: 20px; margin-right: 6px;">'} ${layer.text}</div>
                    <i class="fa-solid fa-up-down-left-right" draggable="true"></i>
                    <i class="fa-solid fa-trash delete-btn"></i>
                `;
                li.setAttribute("data-index", index);
                list.appendChild(li);
            });
        }

        document.querySelectorAll(".delete-btn").forEach((btn, idx) => {
            btn.addEventListener("click", () => deleteLayer(idx, $scope.isFrontLayer));
        });
    }

    $scope.moveUpLayerSelected = function() {
        if ($scope.selectedElement) {
            let currentY = $scope.selectedElement.y();
            $scope.selectedElement.y(currentY - 10);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.moveDownLayerSelected = function() {
        if ($scope.selectedElement) {
            let currentY = $scope.selectedElement.y();
            $scope.selectedElement.y(currentY + 10);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.moveLeftLayerSelected = function() {
        if ($scope.selectedElement) {
            let currentX = $scope.selectedElement.x();
            $scope.selectedElement.x(currentX - 10);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.moveRightLayerSelected = function() {
        if ($scope.selectedElement) {
            let currentX = $scope.selectedElement.x();
            $scope.selectedElement.x(currentX + 10);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.deleteLayerSelected = function() {
        if ($scope.selectedElement) {
            if ($scope.isFrontLayer) {
                let index = frontLayers.findIndex(layer => layer.node === $scope.selectedElement);
                frontLayers.splice(index, 1);
            } else {
                let index = backLayers.findIndex(layer => layer.node === $scope.selectedElement);
                backLayers.splice(index, 1);
            }
            $scope.selectedElement.destroy();
            frontLayer.draw();
            backLayer.draw();
            $scope.selectedElement = null;
            transformer.nodes([]);
            $('#edit-text').removeClass('active');
            updateLayerList();
            // if ($scope.selectedElement.node.isBaseImage) {
            //     $scope.product_id = null;
            //     $scope.colorProduct = null;
            //     $scope.sizeProduct = null;
            //     $scope.colorOverlay.destroy();
            //     $scope.maskOverlay.destroy();
            // }
        }
    }

    $scope.resetLayerSelected = function() {
        frontLayers.forEach(layer => {
            layer.node.destroy();
            if (layer.type == 'image' && layer.node.isBaseImage) {
                $scope.product_id = null;
                $scope.colorProduct = null;
                $scope.sizeProduct = null;
                if ($scope.colorOverlay) {
                    $scope.colorOverlay.destroy();
                }
                if ($scope.maskOverlay) {
                    $scope.maskOverlay.destroy();
                }
            }
        });
        backLayers.forEach(layer => {
            layer.node.destroy();
            if (layer.type == 'image' && layer.node.isBaseImage) {
                $scope.product_id = null;
                $scope.colorProduct = null;
                $scope.sizeProduct = null;
                if ($scope.colorOverlay) {
                    $scope.colorOverlay.destroy();
                }
                if ($scope.maskOverlay) {
                    $scope.maskOverlay.destroy();
                }
            }
        });
        frontLayers = [];
        backLayers = [];
        transformer.nodes([]);
        frontLayer.draw();
        backLayer.draw();
        updateLayerList();
    }

    $scope.copyLayerSelected = function() {
        if ($scope.selectedElement) {
            if ($scope.isFrontLayer) {
                let originalLayer = frontLayers.find(layer => layer.node == $scope.selectedElement);
            }else{
                let originalLayer = backLayers.find(layer => layer.node == $scope.selectedElement);
            }
            if (!originalLayer) return;

            // Clone node từ Konva
            let newNode = originalLayer.node.clone();
            newNode.x(originalLayer.node.x() + 20); // Dịch sang phải một chút để dễ nhận biết
            newNode.y(originalLayer.node.y() + 20);
            newNode.draggable(true);

            // Thêm vào stage
            if ($scope.isFrontLayer) {
                frontLayer.add(newNode);
                frontLayer.draw();
            } else {
                backLayer.add(newNode);
                backLayer.draw();
            }
            addLayer(originalLayer.type, originalLayer.text, newNode, $scope.isFrontLayer);
        }
    }

    $scope.rotateRightLayerSelected = function() {
        if ($scope.selectedElement) {
            $scope.selectedElement.rotation($scope.selectedElement.rotation() + 5);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.rotateLeftLayerSelected = function() {
        if ($scope.selectedElement) {
            $scope.selectedElement.rotation($scope.selectedElement.rotation() - 5);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.flipHorizontalLayerSelected = function() {
        if ($scope.selectedElement) {
            let currentScaleX = $scope.selectedElement.scaleX();
            $scope.selectedElement.scaleX(-currentScaleX);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    $scope.flipVerticalLayerSelected = function() {
        if ($scope.selectedElement) {
            let currentScaleY = $scope.selectedElement.scaleY();
            $scope.selectedElement.scaleY(-currentScaleY);
            if ($scope.isFrontLayer) {
                frontLayer.draw();
            } else {
                backLayer.draw();
            }
        }
    }

    // Xuất file
    $scope.exportDesign = function() {
        // Ẩn mặt sau, chỉ hiển thị mặt trước
        backLayer.hide();
        stage.draw();
        let frontDataURL = stage.toDataURL({ mimeType: $scope.exportFileType });

        // Ẩn mặt trước, hiển thị mặt sau
        frontLayer.hide();
        backLayer.show();
        stage.draw();
        let backDataURL = stage.toDataURL({ mimeType: $scope.exportFileType });

        // Khôi phục trạng thái ban đầu
        frontLayer.show();
        backLayer.hide();
        stage.draw();

        // Tạo một canvas mới để ghép ảnh
        let combinedCanvas = document.createElement('canvas');
        let ctx = combinedCanvas.getContext('2d');

        let img1 = new Image();
        let img2 = new Image();

        img1.src = frontDataURL;
        if (backDataURL) {
            img2.src = backDataURL;
        }

        const { jsPDF } = window.jspdf;
        let pdfWidth = 280;
        let pdfHeight = 150;
        img1.onload = function () {
            if (backDataURL) {
                img2.onload = function () {
                    // Set kích thước canvas đủ chứa cả hai ảnh
                    combinedCanvas.width = img1.width;
                    combinedCanvas.height = img1.height + img2.height;
                    pdfWidth = img1.width;
                    pdfHeight = img1.height + img2.height;
                    // Vẽ mặt trước lên canvas
                    ctx.drawImage(img1, 0, 0);

                    // Vẽ mặt sau bên dưới mặt trước
                    ctx.drawImage(img2, 0, img1.height);

                    // Xuất ảnh ghép
                    if ($scope.exportFileType != 'application/pdf') {
                        let combinedDataURL = combinedCanvas.toDataURL({ mimeType: $scope.exportFileType });

                        let link = document.createElement('a');
                        link.href = combinedDataURL;
                        link.download = `${$scope.product.name}.${$scope.exportFileType === 'image/png' ? 'png' : 'jpg'}`;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    } else {
                        let dataURL = combinedCanvas.toDataURL({ mimeType: 'image/png' });

                        let pdf = new jsPDF({
                            orientation: pdfWidth > pdfHeight ? 'landscape' : 'portrait',
                            unit: 'px',
                            format: [pdfWidth, pdfHeight] // Đảm bảo kích thước đúng
                        });

                        pdf.addImage(dataURL, 'PNG', 0, 0, pdfWidth, pdfHeight);
                        pdf.save(`${$scope.product.name}.pdf`);
                    }
                };
            } else {
                pdfWidth = img1.width;
                pdfHeight = img1.height;
                let dataURL = stage.toDataURL({ mimeType: $scope.exportFileType });

                if ($scope.exportFileType != 'application/pdf') {
                    let link = document.createElement('a');
                    link.href = dataURL;
                    link.download = `${$scope.product.name}.${$scope.exportFileType === 'image/png' ? 'png' : 'jpg'}`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } else {
                    let pdf = new jsPDF({
                        orientation: pdfWidth > pdfHeight ? 'landscape' : 'portrait',
                        unit: 'px',
                        format: [pdfWidth, pdfHeight] // Đảm bảo kích thước đúng
                    });

                    pdf.addImage(dataURL, 'PNG', 0, 0, pdfWidth, pdfHeight);
                    pdf.save(`${$scope.product.name}.pdf`);
                }
            }
        };
    };

    $scope.exportFile = function() {
        $scope.exportFileType = 'image/png';
        $('#modal-export-file').modal('show');
    };

    $scope.isLoading = false;
    $scope.formCustom = {
        name: '',
        phone: '',
        email: '',
        address: '',
        note: '',
        product_id: '',
        product_name: '',
        product_price: '',
        product_quantity: '',
        product_color: '',
        product_size: '',
        product_attributes: '',
    };
    $scope.errors = {};
    $scope.orderDesign = function() {
        $scope.errors = {};
        $scope.formCustom = {
            name: '',
            phone: '',
            email: '',
            address: '',
            note: '',
        };
        $('#modal-order-design').modal('show');
    };

    function base64ToFile(base64String, filename) {
        let arr = base64String.split(',');
        let mime = arr[0].match(/:(.*?);/)[1]; // Lấy định dạng (image/png, image/jpeg,...)
        let bstr = atob(arr[1]); // Giải mã Base64
        let n = bstr.length;
        let u8arr = new Uint8Array(n);

        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }

        return new File([u8arr], filename, { type: mime });
    }

    $scope.submitOrderDesign = function() {
        let frontDataURL = null;
        let backDataURL = null;
        if ($scope.isFrontLayer) {
            // Ẩn mặt sau, chỉ hiển thị mặt trước
            backLayer.hide();
            stage.draw();
            frontDataURL = stage.toDataURL({ mimeType: "image/png"  });

            // Ẩn mặt trước, hiển thị mặt sau
            frontLayer.hide();
            backLayer.show();
            stage.draw();
            backDataURL = stage.toDataURL({ mimeType: "image/png" });
        } else {
            // Ẩn mặt sau, chỉ hiển thị mặt trước
            frontLayer.hide();
            stage.draw();
            backDataURL = stage.toDataURL({ mimeType: "image/png"  });

            // Ẩn mặt trước, hiển thị mặt sau
            frontLayer.show();
            backLayer.hide();
            stage.draw();
            frontDataURL = stage.toDataURL({ mimeType: "image/png" });
        }

        // Khôi phục trạng thái ban đầu
        frontLayer.show();
        backLayer.hide();
        stage.draw();

        // Chuyển Base64 thành file ảnh
        let frontImageFile = base64ToFile(frontDataURL, `${$scope.product.name}_front.png`);
        let backImageFile = base64ToFile(backDataURL, `${$scope.product.name}_back.png`);

        $scope.isLoading = true;
        $scope.formCustom.product_id = $scope.product.id;
        $scope.formCustom.product_name = $scope.product.name;
        $scope.formCustom.product_price = $scope.product.price;
        $scope.formCustom.product_quantity = 1;
        $scope.formCustom.product_color = $scope.colorProduct;
        $scope.formCustom.product_size = $scope.sizeProduct;
        $scope.formCustom.product_attributes = $scope.product_attributes;

        console.log(frontLayers);
        console.log(backLayers);
        let dataFront = frontLayers.filter(layer => !layer.node.isBaseImage).map(layer => {
            if (layer.type == 'text') {
                return {
                    group: 1,
                    type: layer.type,
                    design_text: layer.text,
                    design_color: layer.node.fill(),
                    design_font: layer.node.fontFamily(),
                    design_font_size: layer.node.fontSize(),
                    design_font_style: layer.node.fontStyle(),
                };
            }
            if (layer.type == 'image') {
                let imageNode = layer.node.image();
                let imageSrc = imageNode ? imageNode.src : null;

                return {
                    group: 1,
                    type: layer.type,
                    design_text: layer.text,
                    design_image: imageSrc ? base64ToFile(imageSrc, `${layer.text}.png`) : null,
                };
            }
        });
        let dataBack = backLayers.filter(layer => !layer.node.isBaseImage).map(layer => {
            if (layer.type == 'text') {
                return {
                    group: 2,
                    type: layer.type,
                    design_text: layer.text,
                    design_color: layer.node.fill(),
                    design_font: layer.node.fontFamily(),
                    design_font_size: layer.node.fontSize(),
                    design_font_style: layer.node.fontStyle(),
                };
            }
            if (layer.type == 'image') {
                let imageNode = layer.node.image();
                let imageSrc = imageNode ? imageNode.src : null;

                return {
                    group: 2,
                    type: layer.type,
                    design_text: layer.text,
                    design_image: imageSrc ? base64ToFile(imageSrc, `${layer.text}.png`) : null,
                };
            }
        });

        let formData = new FormData();
        formData.append('formCustom', JSON.stringify($scope.formCustom));
        formData.append("imageFront", frontImageFile);
        formData.append("imageBack", backImageFile);

        // Thêm ảnh vào FormData riêng biệt
        dataFront.forEach((layer, index) => {
            if (layer.type === 'image' && layer.design_image) {
                formData.append(`dataFrontImage[${index}]`, layer.design_image); // Gửi file riêng
            }
        });

        dataBack.forEach((layer, index) => {
            if (layer.type === 'image' && layer.design_image) {
                formData.append(`dataBackImage[${index}]`, layer.design_image); // Gửi file riêng
            }
        });

        // Chuyển mảng object thành JSON string
        formData.append('dataFront', JSON.stringify(dataFront.map(layer => {
            if (layer.type === 'image') {
                delete layer.design_image; // Xóa file để không bị mất khi JSON.stringify
            }
            return layer;
        })));

        formData.append('dataBack', JSON.stringify(dataBack.map(layer => {
            if (layer.type === 'image') {
                delete layer.design_image;
            }
            return layer;
        })));

        $.ajax({
            url: '{{ route("front.design_order") }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#modal-order-design').modal('hide');
                } else {
                    $scope.isLoading = false;
                    $scope.errors = response.errors
                    toastr.warning('Thao tác thất bại!');
                    $scope.$applyAsync()
                }
            },
            error: function(response) {
                $scope.isLoading = false;
                toastr.error('Đã có lỗi xảy ra');
                console.log(response);
            },
            complete: function() {
                $scope.isLoading = false;
                $scope.$applyAsync()
            }
        });
    };
});

</script>
@endpush
