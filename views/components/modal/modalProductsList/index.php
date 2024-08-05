<div class="modal fade " id="modal-products-list" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">danh sách sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" placeholder="tìm kiếm..." aria-label="Search..." aria-describedby="basic-addon-search31" fdprocessedid="p320kk">
                        </div>
                    </div>
                </div>
                <form action="?controller=order&action=update-order-item&id=<?= $_GET['id'] ?>" method="post" name="update-order-item">
                    <div class="row" id="product-list">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    hủy
                </button>
                <button type="button" class="btn btn-primary" onclick="clickSaveProductModal()">lưu</button>
            </div>
        </div>
    </div>
</div>
<script>
    const modal = document.querySelector('#modal-products-list');
    modal.addEventListener('shown.bs.modal', function(e) {
        fetch('?controller=product&action=products_attributes')
            .then(req => req.json())
            .then(function(data) {
                const products = document.querySelector('#product-list');
                products.innerHTML = data.map(function(product) {
                    return ` <div class="col-6 mb-3">
                    <div class="row w-100">
                        <div class="col-12">
                            <div class="card mb-3 position-relative ">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <label for="product-${product.id}">
                                            <img class="card-img card-img-left" src="${product.product_feature_image}" alt="Card image">
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <label for="product-${product.id}">
                                            <div class="card-body py-3 w-100">
                                                <h6 class="card-title">${product.product_name} <span class="card-text mb-0 ms-auto ">#${product.id}</span>
                                                </h6>
                                                <div class="d-flex justify-content-between  align-items-center ">
                                                    <p class="card-text mb-0">
                                                       ${product.attributes.map(att => att.name).join('-')}
                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-between  align-items-center mt-auto">
                                                    <p class="card-text mb-0">số lượng :</p>
                                                    <input class="text-center " type="text" value="1" style="width: 50px; height: 30px;" name="quantity[${product.id}]">
                                                </div>
                                            </div>
                                        </label>
                                        <div class="form-check position-absolute end-0 top-0 ">
                                            <input class="form-check-input" type="checkbox" value="${product.id}" id="product-${product.id}" name="product_customization_id[]">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>`;
                }).join('\n');
            })
    });

    function clickSaveProductModal(e) {
        document.querySelector('#modal-products-list form[name="update-order-item"]').submit();
    }
</script>