<?php 
require_once 'function.php';
session_start();
$db = new PDO('mysql:host=localhost;dbname=database;charset=utf8', 'root', '');
$currentUser = null;
if(isset($_SESSION['userId']))
{
    $user = findUserById($_SESSION['userId']);
    if($user)
    {
        $currentUser = $user;
    } 
}