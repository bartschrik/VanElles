<ul id="main-menu">
    <?php

    $menuitems = $page->getMenuItems();

    foreach ($menuitems as $item) {
        $title = $item['pagetitle'];
        $url = $item['url'];
        echo "<li><a href='$url'>$title</a></li>";
    }

    ?>
</ul>
<div class="menuBtn"><div id="menubtn"><div class="bar"></div></div></div>