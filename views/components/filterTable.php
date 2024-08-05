<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <?php if (isset($orderby)) : ?>
                <div class="col">
                    <div class="row">
                        <label for="html5-text-input" class="col-md-2 col-form-label" style="width: max-content;">xấp sếp </label>
                        <div class="col-md-8">
                            <select id="defaultSelect" class="form-select select-filter" fdprocessedid="8k2ey4">
                                <?php foreach ($orderby as $value) : ?>
                                    <option value="<?= currentRouter([...$_GET, 'order' => $value['value']]) ?>" <?= isset($_GET['order']) && $value['value'] == $_GET['order'] ? 'selected' : "" ?>><?= $value['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <label for="html5-text-input" class="col-md-2 col-form-label" style="width: max-content;">theo</label>
                        <div class="col-md-8">
                            <select id="defaultSelect" class="form-select select-filter" fdprocessedid="8k2ey4">
                                <option value="<?= currentRouter([...$_GET, 'direction' => 'DESC']) ?>" <?= !empty($_GET['direction']) && $_GET['direction'] == 'DESC' ? 'selected' : '' ?>>DESC (tăng dần)</option>
                                <option value="<?= currentRouter([...$_GET, 'direction' => 'ASC']) ?>" <?= !empty($_GET['direction']) && $_GET['direction'] == 'ASC' ? 'selected' : '' ?>>ASC (giảm dần)</option>
                            </select>
                        </div>
                    </div>
                </div>

            <?php endif ?>
            <?php if (!empty($filter)  && count($filter) > 0) : ?>
                <div class="col">
                    <div class="row">
                        <label for="html5-text-input" class="col-md-2 col-form-label ">lọc </label>
                        <div class="col-md-10">
                            <select id="defaultSelect " class="form-select select-filter" fdprocessedid="8k2ey4">
                                <option value="<?= currentRouter([...$_GET, 'filter' => 'all']) ?>" <?= !empty($_GET['filter']) && $_GET['filter'] == 'all' ? 'selected' : '' ?>>tất cả</option>
                                <?php foreach ($filter as $key => $value) : ?>
                                    <option value="<?= currentRouter([...$_GET, 'filter' => $value['value']]) ?>" <?= !empty($_GET['filter']) && $_GET['filter'] == $value['value'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <div class="col">
                <div class="row">
                    <form action="<?= currentRouter([...$_GET]) ?>" method="get">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="<?= $_GET['search'] ?? '' ?>" aria-label="Search..." aria-describedby="basic-addon-search31" fdprocessedid="r56tls">
                            <?php foreach ($_GET as $key => $value) : ?>
                                <?php if ($key != 'search') : ?>
                                    <input type="text" class="form-control" hidden name="<?= $key ?>" value="<?= $value ?>">
                                <?php endif ?>
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-primary active" fdprocessedid="2ula2">tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.select-filter').forEach(function(select) {
        select.onchange = function(e) {
            location.href = e.currentTarget.value;
        }
    });
</script>