<div class="modal fade " id="modal-product" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">chi tiết sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="demo-inline-spacing ">
                            <ul class="list-group" id="info-products">

                            </ul>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="mb-3 w-100 mt-3">
                            <img src="store/images/ea3aad0be7150a57d12fff4057f02a9f.webp" class="img-thumbnail feature_image" alt="...">
                        </div>
                        <div class="mb-3 w-100 d-flex" id="images-description">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    const productModal = document.getElementById('modal-product')

    productModal.addEventListener('shown.bs.modal', () => {
        const btnActiveShow = document.querySelector('.active[data-bs-toggle="modal"][data-bs-target="#modal-product"]');
        fetch('?controller=product&action=detail&id=' + btnActiveShow.dataset.value)
            .then(res => res.json())
            .then((data) => {
                renderInfoProductDetails(data);
                productModal.querySelector('.feature_image').src = data.feature_image;
                productModal.querySelector('#images-description').innerHTML = data.images.map((image) => `
                    <div class="w-25 px-2 ">
                        <img src="${image.image_url}" class="img-thumbnail" alt="${image.alt}">
                    </div>
                `).join('\n');
            })
    })

    function renderInfoProductDetails(data) {
        const infoProduct = document.querySelector('#info-products')
        infoProduct.innerHTML = `
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">tên sản phẩm:</span>
            <p class="ms-1 mb-0">${data.name}</p>
        </li>
        <li class="list-group-item">
            <span class="fw-bold flex-1">mô tả sản phẩm : </span>
            <div class="mt-2"> ${data.description}</div>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">danh mục: </span>
            <p class="ms-1 mb-0"> ${data.category_name}</p>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">giá sản phẩm : </span>
            <p class="ms-1 mb-0">${data.price} đ</p>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">giá sản phẩm giảm giá: </span>
            <p class="ms-1 mb-0">${data.discount} đ</p>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">tồn kho: </span>
            <p class="ms-1 mb-0">${data.quantity}</p>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">vốn : </span>
            <p class="ms-1 mb-0">${data.quantity * data.price} đ</p>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">đã bán: </span>
            <p class="ms-1 mb-0">${data.count_buy}</p>
        </li>

        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">danh thu: </span>
            <p class="ms-1 mb-0">500,000đ</p>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">số lượng like :</span>
            <p class="ms-1 mb-0">${data.count_likes}</p>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">số lượt try cập :</span>
            <p class="ms-1 mb-0">${data.count_views}</p>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">số lượt comment :</span>
            <p class="ms-1 mb-0">${data.count_comments}</p>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">người tạo:</span>
            <a href=""><p class="ms-1 mb-0">${data.user_name}</p></a>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">ngày tạo :</span>
            <p class="ms-1 mb-0">${data.created_at}</p>
        </li>
        <li class="list-group-item d-flex align-items-center">
            <span class="fw-bold flex-1">ngày cập nhập :</span>
            <p class="ms-1 mb-0">${data.updated_at}</p>
        </li>
        `;
    }
</script>