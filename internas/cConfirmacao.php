<?php	include("cHeader.php");?>
<main class="main__content_wrapper bg-fundo-pre-carrinho">    
    
    <!-- Barra de progresso -->
    <section class="breadcrumb__section ocultar-mobile">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-2 barra-progresso-circular">                    
                        <div class="progress-circle over50 p77">
                            <span>80%</span>
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
                                <i class="fas fa-check-circle icon-barra-progresso"></i>
                                <span class="descricao-progresso">Conclusão</span>
                            </div>

                        
                    </div>                                       
                </div>
            </div>
        </section>
        <!-- Barra de progresso -->

        <!-- cart section start -->
        <section class="cart__section section--padding">
            <div class="container-fluid">
                <div class="cart__section--inner">
                    <form action="#"> 
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- box informações do pedido -->
                                <div class="endereco-carrinho">
                                    <h3><i class="far fa-shopping-cart"></i> Informações do seu pedido</h3>    
                                    
                                    <div class="row">
                                        <!-- dados pessoais -->
                                        <div class="col-12 col-md-6 col-lg-6 mr-top-30">
                                            <h4>Dados pessoais</h4>
                                            <p class="descricao-titulos-confirmacao">Informações que serão inseridas na nota fiscal do pedido.</p>
                                            <div class="box-inf-endereco-carrinho">
                                                <strong>Lucas Dias Da Silva</strong><br/>
                                                <strong>CPF/CNPJ:</strong> 03272909192<br/>
                                                <strong>RG:</strong> 5384426<br/>
                                                <strong>Telefone:</strong> 6291307570<br/>
                                                <strong>Celular:</strong> 6281855757<br/>
                                                <strong>E-mail:</strong> luca.dias.silva@gmail.com<br/>
                                            </div>
                                        </div>  
                                        <!--/fim dados pessoais -->
                                        <!-- dados endereço -->
                                        <div class="col-12 col-md-6 col-lg-6 mr-top-30">
                                            <h4>Endereço de entrega</h4>
                                            <p class="descricao-titulos-confirmacao">Este é o endereço onde seu pedido será enviado</p>
                                            <div class="box-inf-endereco-carrinho">
                                                <strong>Rua</strong> 15<br/>
                                                <strong>Número:</strong> sn<br/>
                                                <strong>Bairro:</strong> Vila Morais<br/>
                                                <strong>CEP:</strong> 74620400<br/>
                                                <strong>Cidade:</strong> Goiânia<br/>
                                                <strong>Complemento:</strong> qd.k, lt.04
                                            </div>
                                        </div> 
                                        <!--/fim dados endereço -->
                                        <!-- frete -->
                                        <div class="col-12 col-md-12 col-lg-12 mr-top-30">
                                            <h4>Frete</h4>
                                            <p class="descricao-titulos-confirmacao">Detalhes do frete escolhido</p>
                                            <div class="box-inf-endereco-carrinho">
                                                <ul>                                                    
                                                    <li>Sedex - até 3 dias úteis <span>R$ 31,94</span></li>                                                    
                                                </ul> 
                                            </div>
                                        </div> 
                                        <!--/fim frete -->
                                    </div>                                                                        
                                </div>
                                <!--/fim box informações do pedido -->
                                <!-- box produtos -->                                                                                 
                                <div class="cart__table box-carrinho">
                                    <table class="cart__table--inner">
                                        <thead class="cart__table--header">
                                            <tr class="cart__table--header__items">
                                                <th class="cart__table--header__list titulo-table-produtos-carrinho">Produto</th>
                                                <th class="cart__table--header__list">Quantidade</th>
                                                <th class="cart__table--header__list">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="cart__table--body">
                                            <!-- 1 -->
                                            <tr class="cart__table--body__items">
                                                <td class="cart__table--body__list descricao-table-produtos-carrinho">
                                                    <div class="cart__product d-flex align-items-center">
                                                        <div class="cart__thumbnail">
                                                            <a href="<?= $path["site"] ?>produto"><img class="border-radius-5" src="<?= $path["site"] ?>assets/img/produtos/product1.png" alt="Nome do produto - Marca do produto - verik"></a>
                                                        </div>
                                                        <div class="cart__content">
                                                            <h4 class="cart__content--title"><a href="<?= $path["site"] ?>produto">Headset Gamer HyperX Cloud Stinger, Drivers 50mm, Múltiplas Plataformas, P2 e P3 - HX-HSCS-BK/NA</a></h4>
                                                            <span class="cart__content--variant">Caracteristicas 220V</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__table--body__list quantidade-produto-confirmacao">
                                                    35
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <span class="cart__price end">R$ 1.500,00</span>
                                                </td>
                                            </tr>                                            
                                            <!-- 1 -->
                                            <tr class="cart__table--body__items">
                                                <td class="cart__table--body__list descricao-table-produtos-carrinho">
                                                    <div class="cart__product d-flex align-items-center">
                                                        <div class="cart__thumbnail">
                                                            <a href="<?= $path["site"] ?>produto"><img class="border-radius-5" src="<?= $path["site"] ?>assets/img/produtos/product1.png" alt="Nome do produto - Marca do produto - verik"></a>
                                                        </div>
                                                        <div class="cart__content">
                                                            <h4 class="cart__content--title"><a href="<?= $path["site"] ?>produto">Headset Gamer HyperX Cloud Stinger, Drivers 50mm, Múltiplas Plataformas, P2 e P3 - HX-HSCS-BK/NA</a></h4>
                                                            <span class="cart__content--variant">Caracteristicas 220V</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__table--body__list quantidade-produto-confirmacao">
                                                    2
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <span class="cart__price end">R$ 1.500,00</span>
                                                </td>
                                            </tr>                                        
                                            <!-- 1 -->
                                            <tr class="cart__table--body__items">
                                                <td class="cart__table--body__list descricao-table-produtos-carrinho">
                                                    <div class="cart__product d-flex align-items-center">
                                                        <div class="cart__thumbnail">
                                                            <a href="<?= $path["site"] ?>produto"><img class="border-radius-5" src="<?= $path["site"] ?>assets/img/produtos/product1.png" alt="Nome do produto - Marca do produto - verik"></a>
                                                        </div>
                                                        <div class="cart__content">
                                                            <h4 class="cart__content--title"><a href="<?= $path["site"] ?>produto">Headset Gamer HyperX Cloud Stinger, Drivers 50mm, Múltiplas Plataformas, P2 e P3 - HX-HSCS-BK/NA</a></h4>
                                                            <span class="cart__content--variant">Caracteristicas 220V</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__table--body__list quantidade-produto-confirmacao">
                                                    1
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <span class="cart__price end">R$ 1.500,00</span>
                                                </td>
                                            </tr>                                                                                                                                    
                                        </tbody>
                                    </table>                                     
                                </div>
                                <!--/fim box produtos -->
                            </div>
                            <div class="col-lg-4">
                                <div class="cart__summary border-radius-10">                                                                      
                                    <div class="cart__summary--total mb-20">
                                        <h3 class="coupon__code--title">Resumo do pedido</h3>
                                        <table class="cart__summary--total__table">
                                            <tbody>
                                                <tr class="cart__summary--total__list">
                                                    <td class="cart__summary--total__title text-left">Valor dos Produtos:</td>
                                                    <td class="cart__summary--amount text-right">R$ 1.500,00</td>
                                                </tr>
                                                <tr class="cart__summary--total__list">
                                                    <td class="cart__summary--total__title text-left">Frete:</td>
                                                    <td class="cart__summary--amount text-right">R$ 31,94</td>
                                                </tr>
                                                <tr class="cart__summary--total__list">
                                                    <td class="cart__summary--total__title text-left">Desconto:</td>
                                                    <td class="cart__summary--amount text-right">R$ -20,94</td>
                                                </tr>
                                                <tr class="cart__summary--total__list bg-preco-total-carrinho">
                                                    <td class="cart__summary--total__title text-left">Forma de pagamento: BOLETO BANCÁRIO</td>
                                                    <td class="cart__summary--amount text-right">R$ 1.511.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="cart__summary--footer">
                                        <ul>
                                            
                                            <li>                                                
                                                <a class="btn-pagamento-carrinho" href="<?= $path["site"] ?>concluir">
                                                    FINALIZAR
                                                </a>                                            
                                            </li>
                                            <li>
                                                <a class="btn-continuar-comprando-carrinho" href="<?= $path["site"] ?>pagamento">
                                                    VOLTAR
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                            </div>
                        </div> 
                    </form> 
                </div>
            </div>     
        </section>
        <!-- cart section end -->
    </main>    
<?php	include("cFooter.php");?>