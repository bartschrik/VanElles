<?php require_once 'includes/header.php'; ?>
<div id="content">
    <div id="main-slider">
        <div>
            <div class="slide" style="background-image: url('images/hk-living-banner_2048x2048.jpg')">

            </div>
        </div>
        <div>
            <div class="slide" style="background-image: url('images/stbr.jpg')">

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <section class="col-md-8 col-sm-7 col-xs-12 marbot">
                <div class="ptitle">
                    <h1><?php echo $pageContent['title']; ?></h1>
                    <h2><?php echo $pageContent['subtitle']; ?></h2>
                </div>
                <?php echo $pageContent['inhoud']; ?>
            </section>
            <aside class="col-md-4 col-sm-5 col-xs-12 marbot">
                <div class="ptitle">
                    <h1>Volgende activiteit</h1>
                    <h2>Workshop</h2>
                </div>
                <div class="card">
                    <a href="#" style="background-image: url('images/stbr.jpg');" class="card-img"></a>
                    <div class="card-body">
                        <a href="#"><h4 class="card-title">Nieuw: STBR</h4></a>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores beatae commodi consectetur doloribus ducimus earum et eum hic inventore iusto magnam nam, nobis quas quasi recusandae repellendus saepe, soluta tempora.</p>
                        <div class="a-right"><a href="#" class="btn btn-primary">Lees meer</a></div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    <?php require_once 'includes/quote.php'; ?>
    <?php require_once 'includes/productenslide.php'; ?>

</div>
<?php require_once 'includes/footer.php'; ?>
