<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "vanelles");

if(!isset($_GET['pid'])){
    header("Location: ../blog.php");
} else {
    $pid = $_GET['pid'];
    $sql = "DELETE FROM blog WHERE blog_id=$pid";
    mysqli_query($db, $sql);
    header("Location: ../blog.php");
}
?>