<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <?php View('components/alerts') ?>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex  align-items-center justify-content-between ">
                    <h5><?= isset($banner['id']) ? 'cập nhập banner' : 'tạo banner sản phẩm' ?> </h5>
                </div>
                <div class="card-body">
                    <form action="?controller=banner&action=<?= isset($banner['id']) ? 'update&id=' . $banner['id'] : 'create' ?>" method="POST">
                        <div class="form-wrapper">
                            <div class="form-item pb-5">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="d-flex justify-content-center flex-column  align-items-center  h-100">
                                            <label class="position-relative" for="banner-images" style="cursor: pointer;" tabindex="0" data-bs-toggle="modal" data-bs-target="#manager-file">
                                                <img src="<?= $banner['images'] ?? (old('banner-images') != '' ? old('banner-images') :  'public/assets/iconImages/th.jpeg') ?>" class="img-fluid" alt="...">
                                                <input class="input-images-banner" name="banner-images" value="<?= $banner['images'] ?? old('banner-images')  ?>" type="text" hidden id="banner-images">
                                            </label>
                                            <?php if (!empty($error['banner-images'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['banner-images']['message'] ?></p> <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="mb-3">
                                            <label for="banner-alt" class="form-label">tên banner</label>
                                            <input type="text" class="form-control" name="banner-name" value="<?= $banner['name'] ?? old('banner-name') ?>" id="banner-alt" placeholder="tên hình ảnh">
                                            <?php if (!empty($error['banner-name'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['banner-name']['message'] ?></p> <?php endif ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sub_title" class="form-label">tiêu đề phụ</label>
                                            <input type="text" class="form-control" name="sub_title" value="<?= $banner['sub_title'] ?? old('sub_title') ?>" id="sub_title" placeholder="tên hình ảnh">
                                            <?php if (!empty($error['sub_title'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['sub_title']['message'] ?></p> <?php endif ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="banner-path" class="form-label">đường dẫn </label>
                                            <input type="text" class="form-control" id="banner-path" name="banner-path" value="<?= $banner['url'] ??  old('url') ?>" placeholder="đường dẫn banner">
                                            <?php if (!empty($error['banner-path'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['banner-path']['message'] ?></p> <?php endif ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="defaultSelect" class="form-label">nhóm banner</label>
                                            <select id="defaultSelect" class="form-select" name="banner-group" fdprocessedid="806b3q">
                                                <option value="">chọn nhóm banner</option>
                                                <?php foreach ($bannerGroup as $key => $value) : ?>
                                                    <option value="<?= $value['id'] ?>" <?= isset($banner['banner_group_id']) && $banner['banner_group_id'] ==   $value['id'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <?php if (!empty($error['banner-group'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['banner-group']['message'] ?></p> <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button w-100" class="btn btn-primary" fdprocessedid="9wkysc"><?= isset($banner['id']) ? 'cập nhập ' : 'tạo banner ' ?> </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php View('components/modal/modalUploadFile', ['id' => 'manager-file']) ?>
<script>
    const inputImageList = document.querySelectorAll('.input-images-banner[type="text"]');
    const btnMore = document.querySelector('.btn-more');
    inputImageList.forEach(function(input) {
        input.onclick = function(e) {
            e.currentTarget.parentElement.querySelector('.img-fluid').src = e.target.value;
        }
    });
</script>