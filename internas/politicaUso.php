<?php	include("header.php");?>

    <main class="main__content_wrapper">
        
        <!-- Inicio breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25"><?= $termo->titulo ?></h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="<?= $path["site"] ?>">Página inicial</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Termo de uso</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/fim breadcrumb section -->
        <div class="privacy__policy--section section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="privacy__policy--content">
                            <h2 class="privacy__policy--content__title"><?= $termo->titulo ?></h2>
                            <p class="privacy__policy--content__desc"><?= $termo->texto ?></p>
                        </div>
                        
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php	include("footer.php");?>