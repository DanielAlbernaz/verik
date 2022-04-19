<?php
    ob_start();
    include 'ctrl.php';
?>
<!doctype html>
<html lang="pt-br">

<head>


    <meta charset="utf-8">
    <!-- <meta name="description" content="<?=str_replace('<br/>',' ',$meta->og['description'])?>"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= $path["site"] ?>assets/img/favicon.ico">
    <base href="<?php print "http://".$_SERVER['SERVER_NAME'] . $path["site"]; ?>" />

    <!-- ======= Todos os plugins CSS aqui ======== -->
    <link rel="stylesheet" href="<?= $path["site"] ?>assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?= $path["site"] ?>assets/css/plugins/glightbox.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Plugin css -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css"> -->

    <!-- CSS de estilo personalizado -->
    <link rel="stylesheet" href="<?= $path["site"] ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= $path["site"] ?>assets/css/all.css">

    <!-- CSS -->
    <script>
        var pathSite = '<?= $path["site"] ?>';
    </script>
    <title><?=$titPag?></title>
</head>

<body>
    <!-- Inicio preloader -->
    <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="V" class="letters-loading">
                        V
                    </span>
                    <span data-text-preloader="E" class="letters-loading">
                        E
                    </span>
                    <span data-text-preloader="R" class="letters-loading">
                        R
                    </span>
                    <span data-text-preloader="I" class="letters-loading">
                        I
                    </span>
                    <span data-text-preloader="K" class="letters-loading">
                        K
                    </span>
                </div>
            </div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
    </div>
    <!--/fim preloader -->
    <?php
        include("$abrePag");
    ?>

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292" /></svg></button>

    <!-- All Script JS Plugins here  -->
    <!-- <script src="<?= $path["site"] ?>assets/js/vendor/popper.js" defer="defer"></script> -->
    <!-- <script src="<?= $path["site"] ?>assets/js/vendor/bootstrap.min.js" defer="defer"></script> -->

    <script src="<?= $path["site"] ?>assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="<?= $path["site"] ?>assets/js/plugins/glightbox.min.js"></script>

    <!-- Customscript js -->
    <script src="<?= $path["site"] ?>assets/js/script.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 5000,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</body>

</html>