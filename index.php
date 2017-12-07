<?php
//Include de connection en de page class
include_once('admin/classes/connection.class.php');
include_once('admin/classes/page.class.php');

$page = new Page();

if(isset($_GET['page'])) {
    $pageContent = $page->getPageByUrl(htmlentities($_GET['page']));
    if(!$pageContent) {
        //404 error page
        $pageContent = [
            "pagetitle"     => "Oepss 404",
            "title"         => "Oepss, 404",
            "subtitle"      => "Deze pagina bestaat helaas niet.",
            "inhoud"        => "",
            "description"   => "",
            "kernwoorden"   => "",
            "path"          => "404.php"
        ];
    }
} else {
    //Search for first page in db
    $pageContent = $page->getFirstPageBy();
}

//Include header
include_once('includes/header.php');

//Include module
include_once('module/'.$pageContent['path']);

//Include footer
include_once('includes/footer.php');