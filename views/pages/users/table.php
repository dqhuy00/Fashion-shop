<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="card">
        <h5 class="card-header">Tài khoản người dùng</h5>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>hình</th>
                    <th>tên người dùng</th>
                    <th>tài khoản</th>
                    <th>trạng thái</th>
                    <th>ngày tạo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                foreach ($user_list as $key => $value) {
                    echo '<tr>
                <td>' . ++$key . '</td>
                <td> 
                    <div  class="position-relative" style="width: 40px;" >
                      <img src="' . $value['photo_url'] . '" class="rounded-circle w-100 h-100"  />
                      ' . ($value['locked'] ? '<i class="bx bx-lock-alt fs-6 position-absolute top-0 start-100 translate-middle"></i>' : '') . ' 
                    </div>
                </td>
                <td>' . $value['user_name'] . '</td>
                <td>' . $value['username'] . '</td>
                <td>' . $value['role_name'] . '</td>
                <td>' . $value['created_at'] . '</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?controller=users&action=update&id=' . $value['id'] . '"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                           ' . (!$value['locked'] ?
                        '<a id="btnShowModalBlock" data-value="?controller=users&action=lock_user&id=' . $value['id'] . '" class="dropdown-item" href="javascript:void(0);"data-bs-toggle="modal" data-bs-target="#blockAccount"><i class="bx bx-lock-alt me-1"></i>khóa tài khoản</a>' :
                        '<a id="btnShowModalBlock" data-value="?controller=users&action=unlock_user&id=' . $value['id'] . '" class="dropdown-item" href="javascript:void(0);"data-bs-toggle="modal" data-bs-target="#unblockAccount"><i class="bx bx-lock-open-alt me-1"></i>mở khóa tài khoản</a>'
                    ) . '
                        </div>
                    </div>
                </td>
            </tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
<?php View('components/modal/modalLink', ['id' => 'blockAccount', 'title' => 'khóa tài khoản', 'content' => 'bạn muốn khóa tài khoản này không', 'btnShowModal' => 'btnShowModalBlock']) ?>
<?php View('components/modal/modalLink', ['id' => 'unblockAccount', 'title' => 'mỡ khóa tài khoản', 'content' => 'bạn muốn mỡ khóa tài khoản này', 'btnShowModal' => 'btnShowModalBlock']) ?>