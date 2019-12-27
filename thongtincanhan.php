<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bạn bè</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
require_once 'init.php';
require_once 'function.php';    
$page = 'profile';
$posts = findAllPost();
$ds = DanhSachBan();
if(!$currentUser)
{
    header('Location: index.php');
    exit(0);
}
$relationship = findRelationship( $currentUser['id'],$user['id']);
$isfrends = count($relationship) === 2 ;
$noRelationship = count($relationship) === 0;   
if(count($relationship) === 1)
{
    $isRequesting = $relationship[0]['user1id'] === $currentUser['id'];

}
?>
<?php include 'header.php'; ?>
<h3 style="padding-top: 100px"></h3>
<?php if($user['id'] !== $currentUser['id']):?>
    <form action = "friends.php" method="post"> 
    <input type = "hidden" name = "id" value = "<?php echo $user['id'];?>">
<?php if($isfrends): ?>
    <input type="submit" name ="action" class="btn btn-danger" value = "Xóa bạn bè">
<?php elseif($noRelationship):?>
    <input type="submit" name ="action" class="btn btn-primary" value = "Gửi lời kết bạn">
<?php else:?>
    <?php if(!$isRequesting):?>
        <input type="submit" name ="action" class="btn btn-success" value = "Đồng ý yêu cầu kết bạn">
        <?php endif; ?>
    <input type="submit" name ="action" class="btn btn-warning" value = "Hủy yêu cầu kết bạn">
<?php endif; ?>
</form>
<?php endif ?>
<h3 style="text-align: center">Danh sách bạn bè</h3>
<?php foreach ($ds as $Ds): ?>
<?php if($Ds['user2id'] == $user['id']): ?>
<a href="profile.php?id=<?php echo $Ds['id']; ?> ">
<h5 style="text-align: center;"><img name="image1" width="100x" src="anhdaidien/<?php echo $Ds['image1']?>">
    <br>
<?php echo $Ds['fullname']; ?>
<?php endif;?>
<?php endforeach;?>
<?php include 'footer.php';?>  