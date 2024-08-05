<div class="modal fade" id="<?= $id ?? '' ?>" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Tải ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="min-height: 500px;">
                <div class="nav-align-top mb-4" style="box-shadow: none;">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                                tất cả
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-upload-images" aria-controls="navs-top-upload-images" aria-selected="false">
                                tải ảnh lên
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content shadow-none ">
                        <div class="tab-pane fade active show " id="navs-top-home" role="tabpanel">
                            <div class="d-flex modal-images-list flex-wrap ">
                            </div>
                        </div>
                        <div class="tab-pane fade " id="navs-top-upload-images" role="tabpanel">
                            <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                                <div class="alert d-none" role="alert"></div>
                                <form action="?controller=file&action=upload" method="POST" class="form-upload-images w-25 text-center   m-auto" enctype="multipart/form-data">
                                    <i class='bx bx-cloud-upload ' style="font-size:7rem ;"></i>
                                    <p class="card-text">tải ảnh ở đây</p>
                                    <input class="form-control" type="file" name="upload[]" multiple>
                                    <p class="text-muted mb-0">Được phép JPG, GIF hoặc PNG. Kích thước tối đa 800K</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-close_modal" data-bs-dismiss="modal">
                    hủy
                </button>
                <button type="button" class="btn btn-primary btn-save-change">lưu</button>
            </div>
        </div>
    </div>
</div>
<script></script>
<script>
    const formUpload = document.querySelector('.form-upload-images');
    const modal = document.querySelector("#<?= $id ?? '' ?>");
    const imagesList = document.querySelector('.modal-images-list');
    const btnInputFile = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#<?= $id ?? '' ?>"]');
    btnInputFile.forEach(item => {
        item.onclick = (e) => {
            document.querySelector('.active[data-bs-toggle="modal"][data-bs-target="#<?= $id ?? '' ?>"]')?.classList.remove('active');
            e.currentTarget.classList.add('active');
        }
    });
    formUpload.querySelector('input[type="file"]').onchange = function(e) {
        if (e.target.files) {
            uploadFile()
        }
        e.target.value = '';
    }

    function uploadFile() {
        const formData = new FormData(formUpload);
        const alert = document.querySelector('#navs-top-upload-images .alert');
        fetch('?controller=file&action=upload', {
                method: 'post',
                body: formData,
            })
            .then(res => res.json())
            .then(function(data) {
                alert.classList.remove('d-none', 'alert-danger', 'd-block');
                alert.classList.add('alert-success', 'd-block');
                alert.innerHTML = "tải ảnh thành công " + data.join(', ');
            })
            .catch(function(error) {
                console.log(error);
                alert.classList.remove('d-none', 'alert-success', 'd-block');
                alert.classList.add('alert-danger', 'd-block');
                alert.innerHTML = "tải ảnh thất bại ".error;
            });
    }
    modal.addEventListener('shown.bs.modal', function(e) {
        fetch('?controller=file')
            .then((res) => res.json())
            .then(function(data) {
                const htmlImages = Object.values(data).map(function(images, index) {
                    return `
            <div class="form-check position-relative p-0 mx-2 mb-3 modal-images-item" style="max-width: 100px;">
                <label class="form-check-label" for="images-${index}">
                    <img  src="${images}" class="img-thumbnail" alt="...">
                </label>
                <input class="form-check-input position-absolute end-0 z-4 " value="${images}" type="checkbox" value="" id="images-${index}">
            </div>
            `;
                });

                imagesList.innerHTML = htmlImages.join('\n');
            })
            .catch(function(error) {
                console.log(error);
            })
    });

    modal.querySelector('.btn-save-change').onclick = function() {
        const btnModal = document.querySelector('.active[data-bs-toggle="modal"][data-bs-target="#<?= $id ?? '' ?>"] input');
        const inputCheckboxChecked = imagesList.querySelectorAll('.modal-images-item input:checked');
        if (btnModal) {
            let pathImagesList;
            if (btnModal.multiple === true) {
                console.log(1);
                pathImagesList = JSON.stringify(Array.from(inputCheckboxChecked).map((input) => {
                    return input.value;
                }));
            } else {
                pathImagesList = inputCheckboxChecked[inputCheckboxChecked.length - 1].value;
            }
            btnModal.value = pathImagesList;
            btnModal.click();
            inputCheckboxChecked.forEach(input => {
                input.checked = false;
            })
            modal.querySelector('.btn-close_modal').click();
            document.querySelector('.active[data-bs-toggle="modal"][data-bs-target="#<?= $id ?? '' ?>"]')?.classList.remove('active');
        }
    }
</script>