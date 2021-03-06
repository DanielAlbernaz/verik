<?php	include("header.php");?>
    <main class="main__content_wrapper bg-fundo-pre-carrinho ">        
        <section class="product__details--section section--padding">
            <div class="container">
                <div class="row row-cols-lg-2 row-cols-md-2">
                    <!-- informações produtos pre carrinho -->
                    <div class="col-md-12 background-inf-pre-carrinho">
                        <div class="row">
                            <!-- imagem do produto -->
                            <div class="col-md-3">
                                <img class="product__items--img product__primary--img" src="<?=$path["site"]?>assets/img/produtos/camera-ip-dome-vip-1220-d-g3.png" alt="Nome do produto - Marca do produto - Verik">
                            </div>
                            <!--/fim imagem do produto -->
                            <!-- marca e nome do produto -->
                            <div class="col-md-7">                                
                                <div class="descricao-produto-precarrinho">
                                    <p class="borderR">                                    
                                        <strong class="marca-produto-precarrinho">Samsung</strong><br/>
                                        Smart TV 50 4k QLED Samsung 50Q80A, HDMI, USB, Modo Game, Processador IA, Pontos Quânticos, Alexa e Google Assistant, Preto - QN50Q80AAGXZD
                                    </p>
                                </div>                                
                            </div>
                            <!--/fim marca e nome do produto -->
                            <!--  Preço do produto -->
                            <div class="col-md-2">
                                <div class="preco-precarrinho">
                                    R$ 3.609,05
                                </div>
                            </div>
                            <!--/fim Preço do produto -->
                            <!-- status do produto -->
                            <div class="col-md-12 status-precarrinho">
                                <h5><i class="icofont-check-circled"></i> PRODUTO ADICIONADO NO CARRINHO</h5>
                            </div>
                        </div>
                    </div>
                    <!--/fim informações produtos pre carrinho -->
                    <!-- opções rápidas -->
                    <div class="col-12 col-md-6 poL mobL">
                        <a class="continuar_comprando__btn" href="<?= $path["site"] ?>busca">
                            CONTINUAR COMPRANDO
                        </a>
                    </div>
                    <div class="col-12 col-md-6 poR mobL">
                        <a class="ir_carrinho__btn" href="<?= $path["site"] ?>carrinho">
                            IR PARA O CARRINHO
                        </a>    
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php	include("footer.php");?>