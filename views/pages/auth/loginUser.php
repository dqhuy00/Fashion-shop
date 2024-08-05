<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>auth</title>
    <link rel="stylesheet" href="public/assets/css-web/auth.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container" id="container">
        <div class="form-container register-container">
            <form action="?controller=auth&action=register" method="post">
                <h1>Tạo tài khoản</h1>
                <div class="form-control">
                    <input type="text" id="username" placeholder="tên đăng nhập" name="username" />
                    <small id="username-error"></small>
                    <span></span>
                </div>
                <div class="form-control">
                    <input type="text" id="text" placeholder="tên" name="name" />
                    <small id="name-error"></small>
                    <span></span>
                </div>
                <div class="form-control">
                    <input type="password" id="password" placeholder="mật khẩu" name="password" />
                    <small id="password-error"></small>
                    <span></span>
                </div>
                <button type="submit" value="submit">đăng ký</button>
                <span>Hoặc sử dụng tài khoản của bạn</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </form>
        </div>

        <div class="form-container login-container">
            <form class="form-lg" action="?controller=auth&action=login_user" method="post">
                <h1>Đăng Nhập</h1>
                <div class="form-control2">
                    <input type="text" class="username-2" placeholder="tài khoản" name="username" />
                    <small class="username-error-2"></small>
                    <span></span>
                </div>
                <div class="form-control2">
                    <input type="password" class="password-2" placeholder="mật khẩu" name="password" />
                    <small class="password-error-2"></small>
                    <span></span>
                </div>

                <div class="content">
                    <div class="checkbox">
                        <input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="">Nhớ mật khẩu</label>
                    </div>
                    <div class="pass-link">
                        <a href="#">Quên mật khẩu</a>
                    </div>
                </div>
                <button type="submit" value="submit" style="width: max-content;">đăng nhập</button>
                <span>Hoặc sử dụng tài khoản của bạn</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <button class="ghost" id="login" style="width: max-content;">
                        Đăng nhập
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                </div>

                <div class="overlay-panel overlay-right">
                    <button class="ghost" id="register">
                        Đăng kí
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="public/assets/js-web/auth.js"></script>

</html>