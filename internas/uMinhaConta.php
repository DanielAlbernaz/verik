<link type="text/css" rel="stylesheet" href="<?= $path["site"] ?>assets/css/minha-conta/dashboard-style.css">
<link rel="stylesheet" href="<?= $path["site"] ?>assets/fonts/fontawesome-pro/css/all.css">
<link   href="<?= $path["site"] ?>assets/css/minha-conta/progress-wizard.min.css" rel="stylesheet">
<?php	include("header.php");?>
<div class="bor-top-area"></div>
<section class="job-details bg-area-associado">
    <div class="container-ar">
        <div class="row">
            <!-- menu área associado -->
            <?php	include("uAreaMenu.php");?>                                   
            <!--/fim menu área associado -->
            <!-- conteudo área associado -->
            <div class="col-md-10" style="padding: 0px 0px;">
                <div class="dashboard-content">
                    <div class="container dasboard-container">                                
                        <div class="fl-wrap">
                            <div class="box-minha-conta-bem">
                                <span>Bem-vindo, Lucas Dias Da Silva</span>
                                <p><i class="fas fa-envelope"></i> luca.dias.silva@gmail.com</p>
                                <a class="btn-editar-inf" href="#">
                                    <i class="far fa-user-edit"></i> Editar seus dados
                                </a>
                            </div>
                            <?php	include("uAreaSair.php");?>                            
                        </div>
                        <!-- conteudo  perfil -->
                        <div class="dasboard-wrapper fl-wrap">
                            <div class="dasboard-listing-box fl-wrap">                    
                                <div class="dashboard-listings-wrap fl-wrap">
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <h3 class="titulo-meus-pedidos"><i class="fas fa-shopping-cart"></i> SEU ÚLTIMO PEDIDO</h3>
                                        </div>                                    
                                        <div class="col-12 col-md-12 box-ultimo-pedido">
                                            <!--  informações do pedido -->
                                            <div class="row">
                                                <!-- numero do pedido -->
                                                <div class="col-6 col-md-3">
                                                    <span>NÚMERO DO PEDIDO</span>
                                                    <p>#29206566</p>
                                                </div>                   
                                                <!--/fim numero do pedido -->   
                                                <!-- status do pedido -->
                                                <div class="col-6 col-md-3">
                                                    <span>STATUS DO PEDIDO</span>
                                                    <p>Cancelado</p>
                                                </div>                   
                                                <!--/fim status do pedido -->   
                                                <!-- Data do pedido -->
                                                <div class="col-6 col-md-3">
                                                    <span>DATA DO PEDIDO</span>
                                                    <p>15/05/2022</p>
                                                </div>                   
                                                <!--/fim Data do pedido -->   
                                                <!-- Pagamento do pedido -->
                                                <div class="col-6 col-md-3">
                                                    <span>PAGAMENTO</span>
                                                    <p>Boleto Bancário</p>
                                                </div>                   
                                                <!--/fim Pagamento do pedido -->      
                                            </div>                         
                                            <!-- /fim informações do pedido -->  
                                            <div class="esp-linha-box-ultimo-pedido"></div>
                                            <!--Endereço -->
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <span>ENDEREÇO</span>
                                                    <p>
                                                        Rua 15<br/>
                                                        Número sn, Vila Morais<br/>
                                                        CEP 74620400 - Goiânia, GO
                                                    </p>
                                                </div>                                    
                                            </div>                                    
                                            <!--/fim Endereço -->
                                            <div class="esp-linha-box-ultimo-pedido"></div>
                                            <!--STATUS DO PEDIDO -->
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <span class="titulo-barra-progresso">STATUS DO PEDIDO</span>                                                    
                                                    <ul class="progress-indicator pdSta">                                                    
                                                        <li class="completed">
                                                            <span class="bubble"></span>
                                                            <i class="fas fa-shopping-basket"></i>
                                                            <p>
                                                                Pedido recebido
                                                            </p> 
                                                        </li>
                                                        <li class="warning">
                                                            <span class="bubble"></span>
                                                            <i class="fas fa-truck"></i> 
                                                            <p>
                                                                Enviado para a Transportadora
                                                            </p>
                                                        </li>
                                                        <li class="">
                                                            <span class="bubble"></span> 
                                                            <i class="fas fa-truck"></i>
                                                            <p>
                                                                Recebido pela Transportadora
                                                            </p>
                                                        </li>
                                                        <li class="">
                                                            <span class="bubble"></span> 
                                                            <i class="fas fa-truck"></i>
                                                            <p>
                                                                Mercadoria em Trânsito
                                                            </p>
                                                        </li>
                                                        <li class="">
                                                            <span class="bubble"></span> 
                                                            <i class="fas fa-truck"></i>
                                                            <p>
                                                                Saiu para entrega
                                                            </p>
                                                        </li>   
                                                        <li class="">
                                                            <span class="bubble"></span> 
                                                            <i class="fas fa-times-circle"></i>
                                                            <p>
                                                                Pedido cancelado
                                                            </p>
                                                        </li>                                                    
                                                    </ul>                                        
                                                    <div style="clear: both;"></div> 
                                                </div>                                    
                                            </div>                                    
                                            <!--/fim STATUS DO PEDIDO -->
                                            <div class="esp-linha-box-ultimo-pedido"></div>
                                            <!-- ver todos os pedidos -->
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <a class="btn-pagamento-carrinho btn-cor" href="http://localhost/verik/pagamento">
                                                        VER TODOS OS PEDIDOS
                                                    </a>                                            
                                                </div>                                    
                                            </div>                                    
                                            <!--/fim ver todos os pedidos -->
                                        </div>                                    
                                    </div>
                                </div>
                                <!-- dashboard-listings-wrap end-->
                            </div>                    
                        </div>
                    </div> 
                </div> 
            </div> 
        </div>
    </div>
</section>
<?php	include("footer.php");?>





























<!-- wrapper end -->



<?php	include("footer.php");?>
<script src="<?= $path["site"] ?>assets/js/minha-conta/dashboard.js"></script>