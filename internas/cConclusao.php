<link rel="stylesheet" href="<?= $path["site"] ?>assets/fonts/fontawesome-pro/css/all.css">
<?php	include("cHeader.php");?>
<main class="main__content_wrapper">                
        
<!-- Barra de progresso -->
<section class="breadcrumb__section ocultar-mobile">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-2 barra-progresso-circular">                    
                        <div class="progress-circle over50 p100">
                            <span>100%</span>
                            <div class="left-half-clipper">
                                <div class="first50-bar"></div>
                                <div class="value-bar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-10 barra-progresso">                        
                            <div class="box-barra-progresso">
                                <i class="fas fa-shopping-cart icon-barra-progresso barra-progresso-ativo"></i>
                                <span class="descricao-progresso barra-progresso-ativo">Carrinho</span>
                            </div>
                            <div class="box-barra-progresso">
                                <i class="fal fa-arrow-right icon-barra-progresso"></i>
                            </div>

                            <div class="box-barra-progresso">
                                <i class="fas fa-user icon-barra-progresso barra-progresso-ativo"></i>
                                <span class="descricao-progresso barra-progresso-ativo">Identificação</span>
                            </div>
                            <div class="box-barra-progresso">
                                <i class="fal fa-arrow-right icon-barra-progresso"></i>
                            </div>

                            <div class="box-barra-progresso">
                                <i class="fas fa-credit-card-front icon-barra-progresso barra-progresso-ativo"></i>
                                <span class="descricao-progresso barra-progresso-ativo">Pagamento</span>
                            </div>

                            <div class="box-barra-progresso">
                                <i class="fal fa-arrow-right icon-barra-progresso"></i>
                            </div>

                            <div class="box-barra-progresso">
                                <i class="fas fa-thumbs-up icon-barra-progresso barra-progresso-ativo"></i>
                                <span class="descricao-progresso barra-progresso-ativo">Confirmação</span>
                            </div>
                            
                            <div class="box-barra-progresso">
                                <i class="fal fa-arrow-right icon-barra-progresso"></i>
                            </div>

                            <div class="box-barra-progresso">
                                <i class="fas fa-check-circle icon-barra-progresso barra-progresso-ativo"></i>
                                <span class="descricao-progresso barra-progresso-ativo">Conclusão</span>
                            </div>

                        
                    </div>                                       
                </div>
            </div>
        </section>
        <!-- Barra de progresso -->

        <!-- cart section start -->
        <section class="cart__section section--padding">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-12 box-valor-pagamento-carrinho">
                            <h3><i class="far fa-check-circle"></i> PEDIDO REALIZADO COM SUCESSO!</h3>
                        </div>                         
                        <div class="col-12 col-md-12 box-valor-pagamento-carrinho">
                            <h4>O número do seu pedido é: <strong>29206032</strong></h4>
                        </div>                         
                        <div class="col-12 col-md-6"></div> 
                        <div class="col-12 col-md-3">
                            <a class="btn-continuar-comprando-carrinho mob-esp-mb-20" href="<?= $path["site"] ?>meus-pedidos">
                                VER MEUS PEDIDOS
                            </a>
                        </div> 
                        <div class="col-12 col-md-3">
                            <a class="btn-pagamento-carrinho" href="<?= $path["site"] ?>">
                                CONTINUAR NAVEGANDO
                            </a> 
                        </div> 
                    </div> 

                   

                    

                    <div style="clear:both"></div>
            </div>     
        </section>
        <!-- cart section end -->
    </main>    
<?php	include("cFooter.php");?>
<script src="<?= $path["site"] ?>assets/fonts/fontawesome-pro/js/all.js"></script>