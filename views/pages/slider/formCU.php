<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <?php View('components/alerts') ?>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex  align-items-center justify-content-between ">
                    <h5>tạo slider sản phẩm</h5>
                </div>
                <div class="card-body">
                    <form action="?controller=slider&action=<?= isset($slider['id']) ? 'update&id=' . $slider['id'] : 'create' ?>" method="POST">
                        <div class="form-wrapper">
                            <div class="form-item pb-5">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="d-flex justify-content-center align-items-center flex-column  h-100">
                                            <label class="position-relative" for="slider-images" style="cursor: pointer;" tabindex="0" data-bs-toggle="modal" data-bs-target="#manager-file">
                                                <img src="<?= $slider['images'] ?? (old('slider-images') != '' ? old('slider-images') :  'public/assets/iconImages/th.jpeg') ?>" class="img-fluid" alt="...">
                                                <input class="input-images-slider" name="slider-images" value="<?= !empty($slider['images']) && json_encode($slider['images']) ?? old('slider-images') ?>" type="text" hidden id="slider-images">
                                            </label>
                                            <?php if (!empty($error['slider-images'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['slider-images']['message'] ?></p> <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="mb-3">
                                            <label for="slider-alt" class="form-label">tên slider</label>
                                            <input type="text" class="form-control" name="slider-name" value="<?= $slider['name'] ?? '' ?>" id="slider-alt" placeholder="tên hình ảnh">
                                            <?php if (!empty($error['slider-name'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['slider-name']['message'] ?></p> <?php endif ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="slider-path" class="form-label">đường dẫn </label>
                                            <input type="text" class="form-control" id="slider-path" name="slider-path" value="<?= $slider['url'] ?? '' ?>" placeholder="đường dẫn slider">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sub_title" class="form-label"> tiêu đề phụ</label>
                                            <input type="text" class="form-control" id="sub_title" name="sub_title" value="<?= $slider['sub_title'] ?? '' ?>" placeholder="tiêu đề phụ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button w-100" class="btn btn-primary" fdprocessedid="9wkysc"><?= isset($slider['id']) ? 'cập nhập slider' : 'tạo slider' ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php View('components/modal/modalUploadFile', ['id' => 'manager-file']) ?>
<script>
    const inputImageList = document.querySelectorAll('.input-images-slider[type="text"]');
    const btnMore = document.querySelector('.btn-more');
    inputImageList.forEach(function(input) {
        input.onclick = function(e) {
            e.currentTarget.parentElement.querySelector('.img-fluid').src = e.target.value;
        }
    });
</script>