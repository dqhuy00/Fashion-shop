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
    document.querySelector('#modal-products-list').forms['update-order-item'].submit();
}