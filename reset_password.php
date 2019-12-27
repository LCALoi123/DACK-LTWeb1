<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thay đổi mật khẩu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
require_once 'init.php';
require_once 'function.php';
$page = 'reset_password';
$success = false;
?>

<?php include 'header.php'; ?>
<?php if(!$success) : ?>
</form>
     </nav>	<body>
	<form action="reset_password.php" method="post">
		<table>
			<tr>
				<div class="alert alert-primary" role="alert">
				<h2>Khôi phục mật khẩu</h2>
				</div>
            </tr>
                <p>
               <BR>
               <input name="secret" value ="<?php echo $_GET['secret'];?>" />
                </p>
                <p>
                <label for="input">Mật khẩu</label>
                <BR>
                <input type = "password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu để mới " />
                 </p>
		</table>
        <button type="submit" class="btn btn-primary">Đỗi mật khẩu</button>
	</form>
<?php endif ; ?>
<?php
if(isset($_POST['secret']) && isset($_POST['password']))
{
    $password = $_POST['password'];
    $sercet = $_POST['secret'];
    $passwordHash = password_hash($password,PASSWORD_DEFAULT);
    $reset = findResetPassword($sercet);

    if($reset && !$reset['used'])
    {
        $userid = $reset['userid'];
        markResetPassword($sercet);
        updatePassword($userid, $passwordHash);
        header('Location: rest_passd.php');
        $success = true;
    }
}
?>
<?php include 'footer.php';?>   