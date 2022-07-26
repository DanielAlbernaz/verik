<?php	include("header.php");?>

    <main class="main__content_wrapper">
        
        <!-- Inicio breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Sobre nós</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="<?= $path["site"] ?>">Página inicial</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Sobre nós</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/fim breadcrumb section -->

        <!-- Start about section -->
        <section class="about__section section--padding mb-95">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about__thumb d-flex">                                                        
                        <img class="about__thumb--img border-radius-5 display-block" src="<?= $path["site"] . $path['geral'] ?>sistema/<?= $sobreNos->imagem ?>" alt="Sobre nós - Verik">                                                             
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about__content">
                            <span class="about__content--subtitle text__secondary mb-20"> Conheça nós</span>
                            <h2 class="about__content--maintitle mb-25"> <?= $sobreNos->titulo ?> </h2>
                            <p class="about__content--desc mb-20"> <?= $sobreNos->texto ?> </p>                                                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End about section -->
        
        <!-- Start counterup banner section -->
        <div class="counterup__banner--section backgroung_sobre_verik" id="funfactId">
            <div class="container">
                <div class="row row-cols-1 align-items-center">
                    <div class="col-6 tituloDestaque">
                        Assim como o mercado se <br/>
                        reinventa todos os dias, nós <br/>
                        continuamos nos reinventando.
                    </div>
                    <div class="col-6">
                        <a class="newsletter__subscribe--button ver_todos_produtos" href="#">VER TODOS OS PRODUTOS</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End counterup banner section -->

       <!-- Start about section -->
       <!-- <section class="about__section section--padding mb-95">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-6">
                        <div class="about__content">
                            <h2 class="about__content--maintitle mb-25"> <?= $missao->titulo ?> </h2>
                            <p class="about__content--desc mb-20"> <?= $missao->texto ?> </p>                                                        
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about__thumb d-flex">                                                        
                            <img class="about__thumb--img border-radius-5 display-block" src="<?= $path["site"] . $path['geral'] ?>sistema/<?= $missao->imagem ?>" alt="Sobre nós - Verik">                                                            
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End about section -->
        
        <!-- End brand logo section -->
    </main>

<?php	include("footer.php");?>