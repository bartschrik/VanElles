<?php
//Include de connection en de page class
include_once('admin/classes/connection.class.php');
include_once('admin/classes/page.class.php');
include_once('admin/classes/validate.class.php');
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

//Include module
include_once('module/'.$pageContent['path']);

//Include footer
include_once('includes/footer.php');