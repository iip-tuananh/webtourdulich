<style>
    .gallery-item {
        padding: 5px;
        padding-bottom: 0;
        border-radius: 2px;
        border: 1px solid #bbb;
        min-height: 100px;
        height: 100%;
        position: relative;
    }

    .gallery-item .remove {
        position: absolute;
        top: 5px;
        right: 5px;
    }

    .gallery-item .drag-handle {
        position: absolute;
        top: 5px;
        left: 5px;
        cursor: move;
    }

    .gallery-item:hover {
        background-color: #eee;
    }

    .gallery-item .image-chooser img {
        max-height: 150px;
    }

    .gallery-item .image-chooser:hover {
        border: 1px dashed green;
    }
</style>
<div class="row">
    <div class="col-sm-8">
        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Danh mục</label>
            <ui-select class="" remove-selected="true" ng-model="form.cate_id" theme="select2" ng-change="changeCategory(form.cate_id)">
                <ui-select-match placeholder="Chọn danh mục">
                    <% $select.selected.name %>
                </ui-select-match>
                <ui-select-choices repeat="t.id as t in (form.all_categories | filter: $select.search)">
                    <span ng-bind="t.name"></span>
                </ui-select-choices>
            </ui-select>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.cate_id[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Tiêu đề</label>
            <input class="form-control " type="text" ng-model="form.title_short">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.title_short[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label">Tiêu đề mở rộng</label>
            <input class="form-control " type="text" ng-model="form.title">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.title[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Thời gian</label>
            <input class="form-control " type="text" ng-model="form.times">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.times[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Khởi hành</label>
            <input class="form-control " type="text" ng-model="form.start_off">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.start_off[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Lịch</label>
            <input class="form-control " type="text" ng-model="form.schedule">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.schedule[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Phương tiện</label>
            <input class="form-control " type="text" ng-model="form.vehicle">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.vehicle[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Điểm đến</label>
            <input class="form-control " type="text" ng-model="form.destination">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.destination[0] %>
                </strong>
            </span>
        </div>


        <div>
            <!-- Danh sách Tab -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="lichtrinh-tab" data-toggle="tab" href="#lichtrinh" role="tab" aria-controls="lichtrinh" aria-selected="true">
                        Lịch trình
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="chuy-tab" data-toggle="tab" href="#chuy" role="tab" aria-controls="chuy" aria-selected="false">
                        Chú ý
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="hinhanh-tab" data-toggle="tab" href="#hinhanh" role="tab" aria-controls="hinhanh" aria-selected="false">
                        Hình ảnh
                    </a>
                </li>
            </ul>
            <!-- Nội dung Tab -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active p-3" id="lichtrinh" role="tabpanel" aria-labelledby="lichtrinh-tab">
                    <h4>Lịch trình</h4>
                    <div class="form-group custom-group mb-4">
                        <textarea class="form-control ck-editor" ck-editor rows="5" ng-model="form.itinerary"></textarea>
                        <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.itinerary[0] %>
                </strong>
            </span>
                    </div>

                </div>
                <div class="tab-pane fade p-3" id="chuy" role="tabpanel" aria-labelledby="chuy-tab">
                    <h4>Chú ý</h4>
                    <div class="form-group custom-group mb-4">
                        <textarea class="form-control ck-editor" ck-editor rows="5" ng-model="form.beware"></textarea>
                        <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.beware[0] %>
                </strong>
            </span>
                    </div>
                </div>
                <div class="tab-pane fade p-3" id="hinhanh" role="tabpanel" aria-labelledby="hinhanh-tab">
                    <h4>Hình ảnh</h4>
                    <div class="form-group custom-group mb-4">
                        <textarea class="form-control ck-editor" ck-editor rows="5" ng-model="form.photos"></textarea>
                        <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.photos[0] %>
                </strong>
            </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-4">
        {{-- <div class="form-group custom-group mb-4">
            <label class="form-label">Giá trước giảm</label>
            <input class="form-control " type="text" ng-model="form.base_price">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.base_price[0] %>
                </strong>
            </span>
        </div> --}}
        <div class="form-group custom-group mb-4">
            <label class="form-label">Giá tour</label>
            <input class="form-control " type="text" ng-model="form.price">
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.price[0] %>
                </strong>
            </span>
        </div>

        <div class="form-group custom-group mb-4">
            <label class="form-label required-label">Trạng thái</label>
            <select id="my-select" class="form-control custom-select" ng-model="form.status">
                <option value="">Chọn trạng thái</option>
                <option value="2">Lưu nháp</option>
                <option value="1">Xuất bản</option>
            </select>
            <span class="invalid-feedback d-block" role="alert">
                <strong>
                    <% errors.status[0] %>
                </strong>
            </span>
        </div>


        <div class="card mb-4">
            <div class="card-header text-center ">
                <h5>Ảnh đại diện & Ảnh bìa</h5>
            </div>
            <div class="card-body">
                <!-- Ảnh đại diện -->
                <div class="form-group text-center">
                    <div class="main-img-preview">
                        <label class="required-label">Ảnh đại diện</label>
                        <p class="help-block-img">* Ảnh định dạng: jpg, png</p>
                        <img class="thumbnail img-preview" ng-src="<% form.image.path %>">
                    </div>
                    <div class="input-group" style="width: 100%; text-align: center">
                        <div class="input-group-btn" style="margin: 0 auto">
                            <div class="fileUpload fake-shadow cursor-pointer">
                                <label class="mb-0" for="<% form.image.element_id %>">
                                    <i class="glyphicon glyphicon-upload"></i> Chọn ảnh đại diện
                                </label>
                                <input class="d-none" id="<% form.image.element_id %>" type="file" class="attachment_upload" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                    </div>
                    <span class="invalid-feedback d-block" role="alert">
        <strong><% errors.image[0] %></strong>
      </span>
                </div>

                <hr>

                <!-- Ảnh bìa -->
                <div class="form-group text-center">
                    <div class="main-img-preview">
                        <label class="required-label">Ảnh bìa</label>
                        <p class="help-block-img">* Ảnh định dạng: jpg, png</p>
                        <img class="thumbnail img-preview" ng-src="<% form.image_back.path %>">
                    </div>
                    <div class="input-group" style="width: 100%; text-align: center">
                        <div class="input-group-btn" style="margin: 0 auto">
                            <div class="fileUpload fake-shadow cursor-pointer">
                                <label class="mb-0" for="<% form.image_back.element_id %>">
                                    <i class="glyphicon glyphicon-upload"></i> Chọn ảnh bìa
                                </label>
                                <input class="d-none" id="<% form.image_back.element_id %>" type="file" class="attachment_upload" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                    </div>
                    <span class="invalid-feedback d-block" role="alert">
        <strong><% errors.image_back[0] %></strong>
      </span>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="text-right">
    <button type="submit" class="btn btn-success btn-cons" ng-click="submit()" ng-disabled="loading.submit">
        <i ng-if="!loading.submit" class="fa fa-save"></i>
        <i ng-if="loading.submit" class="fa fa-spin fa-spinner"></i>
        Lưu
    </button>
    <a href="{{ route('Category.index') }}" class="btn btn-danger btn-cons">
        <i class="fa fa-remove"></i> Hủy
    </a>
</div>
