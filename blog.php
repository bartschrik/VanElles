<?php
    session_start();
    include_once('includes/header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
</head>
<body>
<?php
    require_once 'admin/classes/connection.class.php';
    $db = new Connection();
    $db = $db->databaseConnection();

    $dir = 'images/blog/';

    $query1 = $db->prepare('SELECT * FROM blog ORDER BY blog_id DESC');

    $query1->execute();

    while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['blog_id'];
        $img_name = $row['img_name'];
        $title = $row['title'];
        $subtitel = $row["subtitle"];

        echo "<form id='blog'>
        <p>$title</p>
        <p>$subtitel</p>
        <p><img height='250' width='250' src='$dir/$img_name'></p>
        <a href='blog_det.php?pid=$id' title='Details'>Details</a>
        </form>";
    }
    require_once 'includes/footer.php';
?>
</body>
</html>