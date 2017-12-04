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

    $posts = "";

    $dir = 'images/blog/';

    $files = glob("plates/*.{png,jpg,jpeg}", GLOB_BRACE);

    $query1 = $db->prepare('SELECT * FROM blog ORDER BY blog_id DESC');

    $query1->execute();

    while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
        $row['blog_id'];
        $img_name = $row['img_name'];
        $title = $row['title'];
        $inhoud = $row['inhoud'];

        echo "<form>
        <p>$title</p>
        <p><img height='250' width='250' src='$dir/$img_name'></p>
        <p>$inhoud</p>
        </form>";
    }
    require_once 'includes/footer.php';
?>
</body>
</html>