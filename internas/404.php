<?php	include("header.php");?>

<main class="main__content_wrapper">
        <!-- Inicio breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Erro 404 - Página não encontrada!</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="<?= $path["site"] ?>">Página inicial</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Erro 404</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/fim breadcrumb section -->
        <!-- Start error section -->
        <section class="error__section section--padding">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="error__content text-center">
                            <img class="error__content--img mb-50" src="<?= $path["site"] ?>assets/img/other/404-thumb.png" alt="404 - Página não encontrada - Verik">
                            <h2 class="error__content--title">Ops ! Página não encontrada :( </h2>
                            <p class="error__content--desc">A página que você tentou acessar está indisponível ou não existe.</p>
                            <a class="error__content--btn primary__btn" href="<?= $path["site"] ?>">Ir para página inicial</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End error section -->
    </main>


<?php	include("footer.php");?>