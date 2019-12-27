<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cá Nhân</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
require_once 'init.php';
require_once 'function.php';
$page = 'personal';
if(!$currentUser)
{
    header('Location: personal.php');
    exit(0);
}
if(isset($_POST['fullname']) && isset($_POST['sdt']) && isset($_POST['email']))
{
    $mail = $_POST['email'];
    $fullname = $_POST['fullname'];
    $sdt = $_POST['sdt'];
    $id = $currentUser['id'];
    $image = $_FILES["avatar"]["name"];
    $fileanhtam = $_FILES["avatar"]["tmp_name"];
    $result = move_uploaded_file($fileanhtam,'./anhdaidien/'.$image);
    $post = Update($fullname,$sdt,$id,$image);
    header('Location: personal.php');
}
?>
<?php include 'header.php'; ?>
<tr>
	<div class="alert alert-primary" role="alert">
	<h2>Quản lý thông tin</h2>
	</div>
</tr>
<?php if(!isset($_POST['personal'])): ?>
<form action="personal.php" method="POST"enctype="multipart/form-data">
    <h3 style="padding: 0px 100px 100px 100px;"><img name="image1" width="200x" src="anhdaidien/<?php echo $user['image1']?>" alt="">
        <div class="form-group" style="padding-bottom: 10px">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-size: 20px">Chon ảnh đại diện</label>
            <div class="col-md-9 col-sm-9 col-xs-12" style="font-size: 20px">
                <input type="file" name="avatar" id="avatar">
            </div>
        <p>
            <label for="input" style="font-size: 20px">Email</label>
            <BR>
            <input  type = "text" name="email" class="form-control" id="email" value="<?php echo $currentUser['email'];?>"/>
        </p>
    <p>
      <label for="input " style="font-size: 20px">Tên</label>
      <BR>
      <input  type = "text" name="fullname" class="form-control" id="fullname" value="<?php echo $currentUser['fullname'];?>"/>
    </p>
    <p>
      <label for="input" style="font-size: 20px">Số điện thoại</label>
      <BR>
      <input  type = "text" name="sdt" class="form-control" id="sdt"value="<?php echo $currentUser['sdt'];?>"/>
    </p>

  <h2></h2>
  <button type="submit" class="btn btn-primary">Cập nhập</button>
</form>
<?php endif; ?>
<?php include 'footer.php';?>  