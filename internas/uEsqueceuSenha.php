<?php	include("header.php");?>

    <main class="main__content_wrapper">
        
        <!-- Inicio breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Esqueceu senha?</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="<?= $path["site"] ?>">Página inicial</a></li>
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="<?= $path["site"] ?>login">Login</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Esqueceu senha?</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/fim breadcrumb section -->

        <div class="login__section section--padding">
            <div class="container">
                <form action="#">
                    <div class="login__section--inner">
                        <div class="row row-cols-md-2 row-cols-1">
                            <div class="col box-login">
                                <div class="account__login">
                                    <div class="account__login--header mb-25">
                                        <h2 class="account__login--header__title h3 mb-10">Trocar a senha</h2>
                                        <p class="account__login--header__desc">Identifique-se para receber um e-mail com as instruções com a nova senha.</p>
                                    </div>
                                    <div class="account__login--inner">
                                        <input class="account__login--input" placeholder="E-mail" type="text">
                                                                                
                                        <button class="account__login--btn login__btn" type="submit">Enviar senha</button>
                                        <p class="account__login--signup__text login-m20-top">Cancelar: <a href="<?= $path["site"] ?>login">Faça seu login</a></p>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>
                </form>
            </div>     
        </div>
        
    </main>

<?php	include("footer.php");?>