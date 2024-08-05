<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="card ">
        <form class="row g-3 bg-while" action="<?= empty($_GET['id']) ? '?controller=users&action=create_user' : '?controller=users&action=update_user&id=' . $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="<?= $user['photo_url'] ?? 'public/assets/iconImages/user.png' ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" name="avatar" hidden="" accept="image/png, image/jpeg">
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" fdprocessedid="axbads">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="user_name" class="form-label">Tên tài khoản</label>
                        <input type="text" value="<?= $user['name'] ?? old('name')  ?>" class="form-control" id="user_name" placeholder="tên tài khoản" name="name">
                        <?php if (!empty($error['name'])) : ?> <p class="text-danger ms-1 mt-1 mb-0"><?= $error['name']['message'] ?></p> <?php endif ?>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="username" class="form-label">tài khoản</label>
                        <input id="username" type="text" value="<?= $user['username'] ?? old('username') ?>" class="form-control" name="username" placeholder="nhập tài khoản ">
                        <?php if (!empty($error['username'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['username']['message'] ?></p> <?php endif ?>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="user_password" class="form-label">mật khẩu</label>
                        <input type="password" <?= !empty($user['password']) ? 'disabled' : '' ?> class="form-control" id="user_password" name="password" value="<?= old('password') ?>" placeholder="nhập password">
                        <?php if (!empty($error['password'])) : ?> <p class="text-danger ms-1 mt-1 mb-0"><?= $error['password']['message'] ?></p> <?php endif ?>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="role_users" class="form-label">quyền hạng</label>
                        <select id="role_users" class="form-select" aria-label="Default select example" name="role">
                            <?php foreach ($role_list as $role) {
                                echo '<option value="' . $role['id'] . '" ' . ($user['role_id'] == $role['id'] ? 'selected' : '') . '>' . $role['name'] . ' </option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary"><?= !empty($_GET['id']) ? 'cập nhập' : 'Tạo tài khoản'  ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card mt-3">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
            <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                    <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                    <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
            </div>
            <form id="formAccountDeactivation" onsubmit="return false">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation">
                    <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                </div>
                <button type="submit" class="btn btn-danger deactivate-account" fdprocessedid="szttwj">Deactivate Account</button>
            </form>
        </div>
    </div>
</div>
<script src="public/assets/js/pages-account-settings-account.js">
</script>