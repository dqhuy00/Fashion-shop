<?php
$query = new Query();
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header">
            <h5><?= !empty($role['id']) ? 'cập nhập quền' : 'cập nhập  quyền' ?> </h5>
        </div>
        <div class="card-body">
            <form action=" ?controller=role&action=<?= !empty($role['id']) ? 'update&id=' . $_GET['id'] : 'create' ?>" method="POST">
                <div class="d-flex align-items-center justify-content-start" style="max-width: 500px;">
                    <input class="form-control" type="text" name="name" value="<?= $role['name'] ?? '' ?>" placeholder="tên quyền" fdprocessedid="9loo6x" style="max-width: 300px;">
                    <button class="btn btn-primary ms-4"> <?= !empty($role['id']) ? 'cập nhập' : 'tạo' ?> </button>
                </div>
                <div class="row">
                    <?php if (!empty($permission) && count($permission) > 0) : ?>
                        <?php foreach ($permission as $value) : ?>
                            <div class="col-12 my-4">
                                <h6 class="mb-3"><?= $value['name'] ?></h6>
                                <div class="d-flex justify-content-between  align-items-center ">
                                    <?php foreach ($query->table('permission')->select()->where('parent_id', '=', $value['id'])->all() as $value) :  ?>
                                        <div class="form-check ">
                                            <input class="form-check-input" type="checkbox" name="permission[]" value="<?= $value['id'] ?>" id="permission<?= $value['id'] ?>" <?= !empty($role['permission_id']) && in_array($value['id'], $role['permission_id']) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="permission<?= $value['id'] ?>"><?= $value['name'] ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif ?>
                </div>
            </form>
        </div>
    </div>
</div>