<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tìm kiếm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
	require_once 'init.php';
    require_once 'function.php';
    ?>
<?php include 'header.php'; ?>
<?php
	if(isset($_REQUEST['content']))
	{
		$nd = addslashes($_GET['content']);
		
		if (empty($nd)) 
		{
			echo "Yêu cầu nhập dữ liệu vào ô tìm kiếm";
        } 
		else
		{
			$search = searchUser($nd);
            $searchpost = searchPost($nd);

		}
	}
 ?>
<?php if (!empty($search)): ?>
    <?php foreach ($search as $s ) : ?>
        <div class="card"  style="border: solid; margin-bottom: 5%; ">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="profile.php?id=<?php echo $s['id']; ?> ">
                        <p>
                            <img style="width: 100px;height:100px;" src="anhdaidien/<?php echo $s['image1']; ?>" alt="..." class="img-circle">
                            <?php echo '<strong>Họ tên:</strong> '.$s['fullname'] . ' </br>';?>
                        </p>
                    </a>
                </h5>
                
            </div>
        </div>	
    <?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($searchpost)): ?>
    <?php foreach ($searchpost as $s1 ) : ?>
        <div class="card"  style="border: solid; margin-bottom: 5%; ">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="profile.php?id=<?php echo $s1['userId']; ?> ">
                        <p>
                            <img style="width: 100px;height:100px;" src="./anhdaidien/<?php echo $s1['image1']; ?>" alt="..." class="img-circle">
                            <?php echo '<strong>Họ tên:</strong> '.$s1['fullname'] . ' </br>';?>
                        </p>
                    </a>
                    <?php echo $s1['content']; ?>
                    <td>
                        <div class="tbody-thumb">
                        <img name="image" width="500px" src="anhtrangthai/<?php echo $s1['image']?>" alt="">
                        </div>
                    </td>
                </h5>
                
            </div>
        </div>	
    <?php endforeach; ?>
<?php endif; ?>
<?php include 'footer.php'; ?>