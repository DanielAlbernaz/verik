<?php	include("header.php");?>

<main class="main__content_wrapper">
        
        <!-- Inicio breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Dicas e novidades</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="<?= $path["site"] ?>">Página inicial</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Dicas e novidades</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/fim breadcrumb section -->

        <!-- Start blog section -->
        <section class="blog__section section--padding">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xxl-9 col-xl-8 col-lg-8">
                        <div class="blog__wrapper blog__wrapper--sidebar">
                            <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-sm-u-2 row-cols-1 mb--n30">

                            <?php for($i=0; $i < $blogs['num']; $i++){ 
                                // print_rpre();
                                ?>                                
                                <div class="col mb-30">
                                    <div class="blog__items">
                                        <div class="blog__thumbnail">
                                            <a class="blog__thumbnail--link" href="<?= $path["site"] ?>detalhes-blog"><img class="blog__thumbnail--img" src="<?= $path["site"] . $path['geral'] ?>sistema/<?= $blogs[$i]->imagem ?>" alt="Título notícias - Verik - Dicas e novidades"></a>
                                        </div>
                                        <div class="blog__content">
                                            <span class="blog__content--meta"><?=$objUteis->converteDataExtenso($blogs[$i]->dhcadastro)?></span>
                                            <h3 class="blog__content--title titulo_dicas_novidades"><a href="<?= $path["site"] ?>detalhes-blog"><?= $blogs[$i]->titulo ?></a></h3>
                                            <a class="blog__content--btn primary__btn" href="<?= $path["site"] ?>detalhes-blog">Saiba mais </a>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>

                            </div>
                            <div class="pagination__area bg__gray--color">
                                <nav class="pagination">
                                    <ul class="pagination__wrapper d-flex align-items-center justify-content-center">
                                        <li class="pagination__list">
                                            <a href="blog.html" class="pagination__item--arrow  link ">
                                                <svg xmlns="http://www.w3.org/2000/svg"  width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292"/></svg>
                                                <span class="visually-hidden">pagination arrow</span>
                                            </a>
                                        <li>
                                        <li class="pagination__list"><span class="pagination__item pagination__item--current">1</span></li>
                                        <li class="pagination__list"><a href="blog.html" class="pagination__item link">2</a></li>
                                        <li class="pagination__list"><a href="blog.html" class="pagination__item link">3</a></li>
                                        <li class="pagination__list"><a href="blog.html" class="pagination__item link">4</a></li>
                                        <li class="pagination__list">
                                            <a href="blog.html" class="pagination__item--arrow  link ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100"/></svg>
                                                <span class="visually-hidden">pagination arrow</span>
                                            </a>
                                        <li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <?php	include("blogBarraLateral.php");?>
                </div>
            </div>
        </section>
        <!-- End blog section -->
                    
    </main>

<?php	include("footer.php");?>