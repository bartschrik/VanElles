<meta name="description" content="<?php echo $pageContent['description']; ?>">
<meta name="keywords" content="<?php echo $pageContent['kernwoorden']; ?>">
<meta name="author" content="Van Elles">
<title>VanElles | <?php echo $pageContent['pagetitle']; ?></title>
</head>
<body>
<header id="main-header">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="icon-list">
                        <li><a target="_blank" href="<?php echo constant("facebook_vanelles"); ?>"><i class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="<?php echo constant("twitter_vanelles"); ?>"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="<?php echo constant("linkedin_elles"); ?>"><i class="fa fa-linkedin"></i></a></li>
                        <li><a target="_blank" href="<?php echo constant("instagram_vanelles"); ?>"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a href="<?php echo constant("local_url"); ?>" id="main-logo"><img src="<?php echo constant("local_url"); ?>images/vanelles.jpg" alt=""></a>
                    <?php require_once 'menu.php'; ?>
                </div>
            </div>
        </div>
    </div>
</header>