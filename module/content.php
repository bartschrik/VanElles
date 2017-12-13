<div class="martop">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="ptitle">
                    <h1><?php echo $pageContent['title']; ?></h1>
                    <h2><?php echo $pageContent['subtitle']; ?></h2>
                </div>
                <?php echo $pageContent['inhoud']; ?>
            </div>
        </div>
    </div>
    <?php require_once 'includes/quote.php'; ?>
    <div class="container">
        <div class="row">
            <?php require_once 'includes/productenslide.php'; ?>
        </div>
    </div>
</div>