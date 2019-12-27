
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Login V17</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!--===============================================================================================-->
    </head>
    <?php
    require_once 'init.php';
    require_once 'function.php';
    $page = 'register';
    $success = false;
    ?>

    <?php
    if(isset($_POST['email']) && isset($_POST['fullname']) && isset($_POST['password']))
    {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $passwordHash = password_hash($password,PASSWORD_DEFAULT);
        $user = findUserByemail($email);
        if ($email == "" || $password == "" || $fullname == "")
        {
            echo "bạn vui lòng nhập đầy đủ thông tin";
        }
        else
        {
            if($user['email'] == $_POST['email'])
            {
                echo "Tài khoản đã tồn tại";
            }
            else
            {
                $userId = createUser($email,$passwordHash,$fullname);
                $_SESSION['userId'] = $userId;
                echo 'Đăng ký thành công';
                $success = true;
                header('Location: login.php');

            }
        }
    }
    ?>

    <?php /*include 'header.php'; */?>
    <?php if(!$success) : ?>
    <body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="register.php" method="post">
					<span class="login100-form-title p-b-34">
						Account Login
					</span>

                    <div class="wrap-input100" data-validate="Type user name">
                        <input id="email" class="input100" type="text" name="email" placeholder="User name">
                        <span class="focus-input100"></span>
                    </div>
                    <br>
                    <br>
                    <div class="wrap-input100" data-validate="Type password">
                        <input class="input100" type="password" name="password" id="password" placeholder="Password">
                        <span class="focus-input100"></span>
                    </div>
                    <br>
                    <br>
                    <div class="wrap-input100">
                        <input class="input100" type="text" name="fullname" id="fullname" placeholder="Full Name">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Dang Ky
                        </button>
                    </div>
                    <br>

                    <div class="w-full text-center">
                        <a href="login.php" class="txt3">
                            Dang Nhap
                        </a>
                    </div>

                </form>

                <div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
            </div>
        </div>
    </div>



    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <script>
        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });
    </script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

    </body>
    </html>

<?php endif ; ?>

<?php include 'footer.php';?>   