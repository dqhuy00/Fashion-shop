<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="w-100">
    </div>
    <div class="row ">
        <div class="col-md-12">
            <div class="card mb-4  h-100 position-sticky ">
                <div class="d-flex justify-content-between align-content-center card-header">
                    <h5 class="m-0 "><?= isset($menu['id']) ? 'cập nhập menus' : ' tạo menu' ?></h5>
                    <a href="?controller=menu" class="btn btn-icon btn-secondary" fdprocessedid="x31gvo">
                        <i class="bx bx-add-to-queue"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="?controller=menu&action=<?= isset($menu['id']) ? 'update&id=' . $menu['id'] : 'create' ?> " method="POST">
                        <div class="mb-3">
                            <label for="name_menu" class="form-label">tên menu</label>
                            <input id="name_menu" value="<?= $menu['name'] ?? old('name') ?>" name="name" class="form-control" type="text" placeholder="nhập tên menu" fdprocessedid="5dmahi">
                            <?php if (!empty($error['name'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['name']['message'] ?></p> <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <label for="menu_path" class="form-label">đường dẫn</label>
                            <input id="menu_path" value="<?= $menu['url'] ?? old('menu_url') ?>" name="menu_url" class="form-control" type="text" placeholder="đường dẫn menu" fdprocessedid="5dmahi">
                            <?php if (!empty($error['menu_url'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['menu_url']['message'] ?></p> <?php endif ?>

                        </div>
                        <div class="mb-3">
                            <label for="menus-description" class="form-label">mô tả menu</label>
                            <textarea class="form-control" id="menus-description" name="description" rows="3" spellcheck="false"><?= $menu['description'] ?? old('description') ?></textarea>
                            <?php if (!empty($error['description'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['description']['message'] ?></p> <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <label for="defaultSelect" class="form-label">menu cha</label>
                            <select id="defaultSelect" class="form-select" fdprocessedid="fwn97q" name="menus_parent">
                                <option value="0">chọn danh mục cha</option>
                                <?php if (isset($menusList) && count($menusList) > 0) : ?>
                                    <?php foreach ($menusList as $key => $value) : ?>
                                        <?php if ($value['id'] != $menu['id']) : ?>
                                            <option value="<?= $value['id'] ?>" <?= $value['id'] == old('menus_parent') || isset($menu['parent_id']) && $value['id'] == $menu['parent_id']  ? 'selected' : ''  ?>><?= $value['name'] ?? '' ?></option>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                <?php endif ?>
                            </select>
                            <?php if (!empty($error['menus_parent'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['menus_parent']['message'] ?></p> <?php endif ?>
                        </div>
                        <button type="submit" class="btn btn-primary" fdprocessedid="bnh72h"><?= isset($menu['id']) ? 'cập nhập' : ' tạo menu' ?></button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>