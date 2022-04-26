<?php	include("header.php");?>

    <main class="main__content_wrapper">
        
        <!-- Inicio breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Dúvidas frequentes</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="<?= $path["site"] ?>">Página inicial</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Dúvidas frequentes</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/fim breadcrumb section -->

        <section class="faq__section section--padding">
            <div class="container">

            <div class="row">
                <div class="section__heading text-center mb-40">
                    <h2 class="section__heading--maintitle">Como podemos te ajudar?</h2>
                    <p>Confira abaixo as nossas Perguntas Fequentes e esclareça as suas dúvidas!</p>
                </div>

                <div class="col-lg-12 mr-busca-faq">
                    <form class="widget__search--form" action="#">
                        <label>
                            <input class="widget__search--form__input" placeholder="Qual a sua dúvida?" type="text">
                        </label>
                        <button class="widget__search--form__btn" aria-label="Pesquise button" type="button">
                            <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path></svg>
                        </button>
                    </form>
                </div>
                <!-- Div oculta, se não encontrar resultado exibir ela -->
                <div class="col-lg-12 mr-busca-faq">
                    <h3 class="section__heading--maintitle">Desculpe!! Não foi possível obter uma resposta para sua dúvida fale com a nossa <a href="<?= $path["site"] ?>fale-conosco">EQUIPE</a></h3>
                </div>
                <!--/fim Div oculta, se não encontrar resultado exibir ela -->
            </div>


                <div class="faq__section--inner">
                    <div class="face__step one border-bottom" id="accordionExample">
                        <h2 class="face__step--title h3 mb-30">Meus pedidos</h2>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="accordion__container">
                                    <div class="accordion__items">
                                        <h2 class="accordion__items--title">
                                            <button class="faq__accordion--btn accordion__items--button">Posso alterar o endereço de entrega com o objeto em transporte?
                                                <svg class="accordion__items--button__icon" xmlns="http://www.w3.org/2000/svg" width="20.355" height="13.394" viewBox="0 0 512 512"><path d="M98 190.06l139.78 163.12a24 24 0 0036.44 0L414 190.06c13.34-15.57 2.28-39.62-18.22-39.62h-279.6c-20.5 0-31.56 24.05-18.18 39.62z" fill="currentColor"/></svg>
                                            </button>
                                        </h2>
                                        <div class="accordion__items--body">
                                            <p class="accordion__items--body__desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim felis.</p>
                                        </div>
                                    </div>
                                    <div class="accordion__items">
                                        <h2 class="accordion__items--title">
                                            <button class="faq__accordion--btn accordion__items--button">Qual é o prazo para confirmação de pagamento?
                                                <svg class="accordion__items--button__icon" xmlns="http://www.w3.org/2000/svg" width="20.355" height="13.394" viewBox="0 0 512 512"><path d="M98 190.06l139.78 163.12a24 24 0 0036.44 0L414 190.06c13.34-15.57 2.28-39.62-18.22-39.62h-279.6c-20.5 0-31.56 24.05-18.18 39.62z" fill="currentColor"/></svg>
                                            </button>
                                        </h2>
                                        <div class="accordion__items--body">
                                            <p class="accordion__items--body__desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim felis.</p>
                                        </div>
                                    </div>
                                    <div class="accordion__items">
                                        <h2 class="accordion__items--title">
                                            <button class="faq__accordion--btn accordion__items--button">Como acionar o Direito de Arrependimento?
                                                <svg class="accordion__items--button__icon" xmlns="http://www.w3.org/2000/svg" width="20.355" height="13.394" viewBox="0 0 512 512"><path d="M98 190.06l139.78 163.12a24 24 0 0036.44 0L414 190.06c13.34-15.57 2.28-39.62-18.22-39.62h-279.6c-20.5 0-31.56 24.05-18.18 39.62z" fill="currentColor"/></svg>
                                            </button>
                                        </h2>
                                        <div class="accordion__items--body">
                                            <p class="accordion__items--body__desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim felis.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="face__step one border-bottom" id="accordionExample2">
                        <h3 class="face__step--title mb-30">Informações de pagamento</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="accordion__container">
                                    <div class="accordion__items">
                                        <h2 class="accordion__items--title">
                                            <button class="faq__accordion--btn accordion__items--button">Como comprar pelo PIX?
                                                <svg class="accordion__items--button__icon" xmlns="http://www.w3.org/2000/svg" width="20.355" height="13.394" viewBox="0 0 512 512"><path d="M98 190.06l139.78 163.12a24 24 0 0036.44 0L414 190.06c13.34-15.57 2.28-39.62-18.22-39.62h-279.6c-20.5 0-31.56 24.05-18.18 39.62z" fill="currentColor"/></svg>
                                            </button>
                                        </h2>
                                        <div class="accordion__items--body">
                                            <p class="accordion__items--body__desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim felis.</p>
                                        </div>
                                    </div>
                                    <div class="accordion__items">
                                        <h2 class="accordion__items--title">
                                            <button class="faq__accordion--btn accordion__items--button">Como realizar parcelamento?
                                                <svg class="accordion__items--button__icon" xmlns="http://www.w3.org/2000/svg" width="20.355" height="13.394" viewBox="0 0 512 512"><path d="M98 190.06l139.78 163.12a24 24 0 0036.44 0L414 190.06c13.34-15.57 2.28-39.62-18.22-39.62h-279.6c-20.5 0-31.56 24.05-18.18 39.62z" fill="currentColor"/></svg>
                                            </button>
                                        </h2>
                                        <div class="accordion__items--body">
                                            <p class="accordion__items--body__desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim felis.</p>
                                        </div>
                                    </div>
                                    <div class="accordion__items">
                                        <h2 class="accordion__items--title">
                                            <button class="faq__accordion--btn accordion__items--button">Como solicitar o cancelamento?
                                                <svg class="accordion__items--button__icon" xmlns="http://www.w3.org/2000/svg" width="20.355" height="13.394" viewBox="0 0 512 512"><path d="M98 190.06l139.78 163.12a24 24 0 0036.44 0L414 190.06c13.34-15.57 2.28-39.62-18.22-39.62h-279.6c-20.5 0-31.56 24.05-18.18 39.62z" fill="currentColor"/></svg>
                                            </button>
                                        </h2>
                                        <div class="accordion__items--body">
                                            <p class="accordion__items--body__desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim felis.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="face__step one" id="accordionExample3">
                        <h3 class="face__step--title mb-30">Rastreio</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="accordion__container">
                                    <div class="accordion__items">
                                        <h2 class="accordion__items--title">
                                            <button class="faq__accordion--btn accordion__items--button">Como realizar o rastreio na Azul?
                                                <svg class="accordion__items--button__icon" xmlns="http://www.w3.org/2000/svg" width="20.355" height="13.394" viewBox="0 0 512 512"><path d="M98 190.06l139.78 163.12a24 24 0 0036.44 0L414 190.06c13.34-15.57 2.28-39.62-18.22-39.62h-279.6c-20.5 0-31.56 24.05-18.18 39.62z" fill="currentColor"/></svg>
                                            </button>
                                        </h2>
                                        <div class="accordion__items--body">
                                            <p class="accordion__items--body__desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim felis.</p>
                                        </div>
                                    </div>
                                    <div class="accordion__items">
                                        <h2 class=" accordion__items--title">
                                            <button class="faq__accordion--btn accordion__items--button">Como realizar o rastreio na Dia Entregue?
                                                <svg class="accordion__items--button__icon" xmlns="http://www.w3.org/2000/svg" width="20.355" height="13.394" viewBox="0 0 512 512"><path d="M98 190.06l139.78 163.12a24 24 0 0036.44 0L414 190.06c13.34-15.57 2.28-39.62-18.22-39.62h-279.6c-20.5 0-31.56 24.05-18.18 39.62z" fill="currentColor"/></svg>
                                            </button>
                                        </h2>
                                        <div class="accordion__items--body">
                                            <p class="accordion__items--body__desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim felis.</p>
                                        </div>
                                    </div>
                                    <div class="accordion__items">
                                        <h2 class="accordion__items--title">
                                            <button class="faq__accordion--btn accordion__items--button">Como realizar o rastreio na Favorita?
                                                <svg class="accordion__items--button__icon" xmlns="http://www.w3.org/2000/svg" width="20.355" height="13.394" viewBox="0 0 512 512"><path d="M98 190.06l139.78 163.12a24 24 0 0036.44 0L414 190.06c13.34-15.57 2.28-39.62-18.22-39.62h-279.6c-20.5 0-31.56 24.05-18.18 39.62z" fill="currentColor"/></svg>
                                            </button>
                                        </h2>
                                        <div class="accordion__items--body">
                                            <p class="accordion__items--body__desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim felis.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>   
            </div>     
        </section>
       
    </main>

<?php	include("footer.php");?>