<?php
//Include de connection en de page class
include_once('admin/classes/connection.class.php');
include_once('admin/classes/page.class.php');
include_once('admin/classes/validate.class.php');
include_once('admin/functions.php');
require_once 'config.php';

$page = new Page();
$pageId = "";

if(isset($_GET['page'])) {
    $pageContent = $page->getPageByUrl(htmlentities($_GET['page']));
    if(!$pageContent) {
        //404 error page
        $pageContent = [
            "pagetitle"     => "Oeps, 404",
            "title"         => "Oeps, 404",
            "subtitle"      => "Deze pagina bestaat helaas niet.",
            "inhoud"        => "<a href='".constant('local_url')."'>Ga terug naar de home pagina</a>",
            "description"   => "",
            "kernwoorden"   => "",
            "path"          => "404.php"
        ];
    }
} else {
    //Search for first page in db
    $pageContent = $page->getFirstPageBy();
}
if(isset($_GET['pid'])) {
    $pageId = $_GET['pid'];
}


//Include header
include_once('includes/header.php');
ob_start();
include_once('includes/header2.php');
$buffer=ob_get_contents();
ob_end_clean();

//Include module
include_once('module/'.$pageContent['path']);

$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1Van Elles | ' . $pageContent['pagetitle'] . '$3', $buffer);
$buffer = preg_replace('/(<meta name="keywords" content=")(.*?)(">)/i', '$1' . $pageContent['kernwoorden'] . '$3', $buffer);
$buffer = preg_replace('/(<meta name="description" content=")(.*?)(">)/i', '$1' . $pageContent['description'] . '$3', $buffer);
echo $buffer;

//Include footer
include_once('includes/footer.php');