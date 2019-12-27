<?php 
require_once 'init.php';
require_once 'function.php';
unset($_SESSION['userId']);
header('Location: login.php');