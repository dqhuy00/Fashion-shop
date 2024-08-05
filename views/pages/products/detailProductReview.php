<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row flex-1">
        <div class="col-7">
            <div class="card h-100">
                <h4 class="card-header">
                    đánh giá người dùng
                </h4>
                <div class="card-body">
                    <div class="row">
                        <?php if (!empty($review) && count($review) > 0) : ?>
                            <?php foreach ($review as $value) : ?>
                                <div class="card mb-3 w-75">
                                    <div class="row g-0">
                                        <div class="col-md-2">
                                            <img class="card-img card-img-left" src="public/assets/img/elements/12.jpg" alt="Card image">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between ">
                                                    <h5 class="card-title">Card title</h5>
                                                    <ul class="d-flex" style="list-style: none;">
                                                        <li><i class='bx bx-star text-warning'></i></li>
                                                        <li><i class='bx bx-star text-warning'></i></li>
                                                        <li><i class='bx bx-star text-warning'></i></li>
                                                        <li><i class='bx bx-star text-warning'></i></li>
                                                        <li><i class='bx bx-star text-warning'></i></li>
                                                    </ul>
                                                </div>
                                                <p class="card-text">
                                                    This is a wider card with supporting text below as a natural lead-in to additional content.
                                                    This content is a little bit longer.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif; ?>
                    </div>
                    <form action="" class="d-flex w-100 ">
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="trả lời đánh giá" fdprocessedid="tdm8w">
                        <button type="button" class="btn btn-primary ms-4" fdprocessedid="fv99e"> gửi</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                ádsa
            </div>
        </div>
    </div>
</div>