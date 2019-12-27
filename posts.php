<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Trạng Thái</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
    require_once 'init.php';
    require_once 'function.php';
    $page = 'post';
    $success = false;
    if(!$currentUser)
    {
        header('Location: index.php');
        exit(0);
    }
?>
<?php include 'header.php';?>
<tr>
	<div class="alert alert-primary" role="alert" style="padding-top: 100px">
	<h2>Trạng thái</h2>
	</div>
</tr>
<?php if(!isset($_POST['posts'])): ?>
<form action="posts.php" method="POST"enctype="multipart/form-data">
    <div>
    <p>
      <label for="input">Cập nhập trạng thái</label>
      <BR>
      <input  type = "text" name="content" class="form-control" id="content" placeholder="bạn đang nghỉ gì" />
    </p>
    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Chon ảnh để đằng</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" name="avatar" id="avatar">
     </div>
  <h2></h2>
  <button type="submit" class="btn btn-primary">Đăng trạng thái</button>
    </div>
</form>
<?php
    if(!empty($_POST['content']))
    {
        $content = $_POST['content'];
        $idpost = $currentUser['id'];
        $userId = $idpost;
        $image = $_FILES["avatar"]["name"];
        $fileanhtam = $_FILES["avatar"]["tmp_name"];
        $result = move_uploaded_file($fileanhtam,'./anhtrangthai/'.$image);
        if($content != "")
        {
        NewPosts($content,$idpost,$userId,$image);
        }
        else
        {
            echo 'Bạn phải nhập trạng thái muốn đăng';
        }
        header('Location: index.php');
        $success = true;
    }
?>
<?php endif; ?>