<?php
require_once 'init.php';
require_once 'function.php';    
$page = 'profile';
$user = findUserById($_GET['id']);
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
<h3 style="padding-top: 100px;padding-left: 100px"><img name="image1" width="200x" src="anhdaidien/<?php echo $user['image1']?>" alt="">
<?php echo $user['fullname']; ?></h3>
<?php if($user['id'] !== $currentUser['id']):?>
    <form action = "friends.php" method="post"> 
    <input type = "hidden" name = "id" value = "<?php echo $user['id'];?>">
<?php if($isfrends): ?>
    <input type="submit" name ="action" class="btn btn-danger" value = "Xóa bạn bè">
<?php elseif($noRelationship):?>
<div style="padding-left: 100px">
    <input type="submit" name ="action" class="btn btn-primary" value = "Gửi lời kết bạn">
</div>
<?php else:?>
    <?php if(!$isRequesting):?>
        <input type="submit" name ="action" class="btn btn-success" value = "Đồng ý yêu cầu kết bạn">
    <?php else: ?>
    <input type="submit" name ="action" class="btn btn-warning" value = "Hủy yêu cầu kết bạn">
        <?php endif; ?>
<?php endif; ?>
</form>
<?php endif ?>
<?php include 'footer.php';?>  