<?php
//Include de connection en de page class
include_once('admin/classes/connection.class.php');
include_once('admin/classes/page.class.php');
include_once('admin/classes/validate.class.php');
include_once('admin/functions.php');
require_once 'config.php';

//Openen van de page class
//Page id defineren voor gebruik in pagina waarin een detail page bevindt.
$page = new Page();
$pageId = "";

//Checken of er een page parameter is gevonden in de url
if(isset($_GET['page'])) {
    //De page opvragen in de page class, bij page parameter.
    $pageContent = $page->getPageByUrl(htmlentities($_GET['page']));
    if(!$pageContent) {
        //Als er geen pagina is gevonden in de database dan een 404 pagina laten zien met de inhoud hieronder.
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
    //Geen page parameter dan de eerste pagina laten zien, vaak is dit de homepage.
    $pageContent = $page->getFirstPageBy();
}
//Als pid is gevonden in de url dan deze opslaan in de pageid variable.
if(isset($_GET['pid'])) {
    $pageId = $_GET['pid'];
}


//Hier worden 2 headers geinclude, dit omdat de ene later moet worden geinclude om zo de meta content goed te hebben per pagina.
include_once('includes/header.php');
ob_start();
include_once('includes/header2.php');
$buffer=ob_get_contents();
ob_end_clean();

//Include module - bepaald bij path in database
include_once('module/'.$pageContent['path']);

//Zet alle meta content in de header
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1Van Elles | ' . $pageContent['pagetitle'] . '$3', $buffer);
$buffer = preg_replace('/(<meta name="keywords" content=")(.*?)(">)/i', '$1' . $pageContent['kernwoorden'] . '$3', $buffer);
$buffer = preg_replace('/(<meta name="description" content=")(.*?)(">)/i', '$1' . $pageContent['description'] . '$3', $buffer);
echo $buffer;

//Include footer
include_once('includes/footer.php');