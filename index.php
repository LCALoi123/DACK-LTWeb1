<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Trang chủ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
require_once 'init.php';
require_once 'function.php';
$posts = findAllPost();
$bl = findAllBL();
foreach($posts as $p)
{
  $ippost = $p['id'];
  if(isset($_POST[$ippost]))
  { 
    $userId = $currentUser['id'];
    $Binhluan = $_POST['Binhluan'];
    if($Binhluan != "")
    {
    NewBL($userId,$Binhluan,$ippost);
    header('Location: index.php');
    $success = true;
    }
  }
}
?>

<?php include 'header.php'; ?>
<tr>
	<div class="alert alert-primary" role="alert">
	<h2>Trang chủ</h2>
	</div>
</tr>
<p> <?php if ($currentUser): ?>
<?php else:?>
chào mừng bạn đến với mạng xã hội
</p>
<?php endif;?>
<p> <?php if ($currentUser): ?>
<?php foreach ($posts as $post) : ?>
<div class="card" style="border:2px soid black;">
  <div class="card-body">
    <h5 class="card-title">
    <a href = "profile.php?id=<?php echo $post['userId'];?>">
    <h5><img name="image1" width="100x" src="anhdaidien/<?php echo $post['image1']?>">
    <?php echo $post['fullname'];?></h5> </a>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $post['createdAt'];?></h6>
    <p class="card-text"><?php echo $post['content']; ?></p>
    <td>
         <div class="tbody-thumb">
          <img name="image" width="500px" src="anhtrangthai/<?php echo $post['image']?>" alt="">
          </div>
      </td>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">
 <form action="index.php" method="POST">
    <p>
      <input  type = "text" name="Binhluan" class="form-control" id="Binhluan" placeholder="Bình luận" />
    </p>
  <h2></h2>
  <button type="submit" name = <?php echo $post['id'];?> class="btn btn-primary">Binh luận</button>
</form>
<p></p>
<?php?>
<?php foreach($bl as $binhluan):?>
<?php if($binhluan ['ippost'] == $post['id']): ?>
<h6>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">
<a href = "profile.php?id=<?php echo $binhluan['userId'];?>">
    <h5><img name="image1" width="30x" src="anhdaidien/<?php echo $binhluan['image1']?>">
    <?php echo $binhluan['fullname'];?></h5> </a>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $binhluan['createdAt'];?></h6>
    <p class="card-text"><?php echo $binhluan['Binhluan']; ?></p>
    </div>
    </div>
</h6>
<?php endif;?>
<?php endforeach;?>
  </div>
</div>
</body>
<?php endforeach; ?>
<?php else:?>
<?php echo 'Bạn phải đăng nhập';?>
<?php endif;?>
<?php include 'footer.php';?>  