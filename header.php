<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="header.css">

<header id="header">
    <div class="container">

        <div id="logo" class="pull-left">
            <h1><a href="index.php" class="scrollto">THE SIMPLE</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li><a href="thongtincanhan.php">Danh sách bạn bè</a></li>
                <li><a href="posts.php">Trạng thái</a></li>
                <li><a href="personal.php"><?php echo $currentUser['fullname'];?></a></li>
                <!-- <li><a href="">Contact</a></li> -->
            </ul>
        </nav><!-- #nav-menu-container -->

    </div>
</header><!-- #header -->
