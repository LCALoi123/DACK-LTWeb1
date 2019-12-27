<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Khôi phục mật khẩu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
require_once 'init.php';
require_once 'function.php';
$page = 'passpassword';
$success = false;
if(isset($_POST['email']))
{

    $success = true;
    $email = $_POST['email'];
    $user = findUserByemail($email);
    if($user)
    {
        $sercet = createResetPassword($user['id']);
        sendEmail($user['email'],$user['fullname'],'Yeu cau doi mat khau','Click <a = href ="http://localhost:81/BTVN06/reset_password.php?secret='. $sercet .'">vao ');
    }
}
?>
<?php include 'header.php'; ?>
<?php if(!isset($_POST['email'])) : ?>
</form>
     </nav>	<body>
	<form action="passpassword.php" method="post">
		<table>
			<tr>
				<div class="alert alert-primary" role="alert">
				<h2>Quên mật khẩu</h2>
				</div>
            </tr>
                <p>
               <label for="input">Email</label>
               <BR>
               <input  type = "email" name="email" class="form-control" id="email" placeholder="Nhập email" />
                </p>
		</table>
        <button type="submit" class="btn btn-primary">Khôi phụ mật khẩu</button>
	</form>
<?php else:?>
<div class="alert alert-success" role="alert">
Đã gữi hướng dẩn va email vui lòng kiểm tra.
<?php endif ; ?>
<?php include 'footer.php';?>   