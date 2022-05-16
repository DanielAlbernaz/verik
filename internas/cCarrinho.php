<?php	include("cHeader.php");?>
<main class="main__content_wrapper bg-fundo-pre-carrinho">                
        
        <!-- Barra de progresso -->
        <section class="breadcrumb__section ocultar-mobile">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-2 barra-progresso-circular">                    
                        <div class="progress-circle p20">
                            <span>20%</span>
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
                                <i class="fas fa-user icon-barra-progresso"></i>
                                <span class="descricao-progresso">Identificação</span>
                            </div>
                            <div class="box-barra-progresso">
                                <i class="fal fa-arrow-right icon-barra-progresso"></i>
                            </div>

                            <div class="box-barra-progresso">
                                <i class="fas fa-credit-card-front icon-barra-progresso"></i>
                                <span class="descricao-progresso">Pagamento</span>
                            </div>

                            <div class="box-barra-progresso">
                                <i class="fal fa-arrow-right icon-barra-progresso"></i>
                            </div>

                            <div class="box-barra-progresso">
                                <i class="fas fa-thumbs-up icon-barra-progresso"></i>
                                <span class="descricao-progresso">Confirmação</span>
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
                                <!-- box endereço e frete -->
                                <div class="endereco-carrinho">
                                    <h3>Selecione o endereço</h3>
                                    <!-- informação quando o usuário não tiver feito o login -->
                                    <!-- <p>Para poder selecionar um endereço faça login ou crie sua conta <a href="#" class="coupon__code--field__btn primary__btn">Faça Login ou crie sua Conta</a></p> -->
                                    <!--/fim informação quando o usuário não tiver feito o login -->

                                    <!-- informação quando o usuário tiver feito o login -->
                                    <div class="box-inf-endereco-carrinho">
                                        <p>
                                            <strong>Casa Muro Verde, ao lado do consultório</strong><br/>
                                            Rua 15<br/>
                                            Número: sn, qd.k, lt.04<br/>
                                            CEP 74620400 - Goiânia, GO
                                        </p>
                                        <div class="box-link-endereco-carrinho">
                                            <a class="btn-editar-selecionar-endereco" href="#">EDITAR</a>
                                            <a class="btn-editar-selecionar-endereco" href="#">SELECIONAR OUTRO ENDEREÇO</a>
                                            <a class="btn-novo-endereco" href="#">NOVO ENDEREÇO</a>
                                        </div>
                                    </div>

                                    <div class="linha-endereco-carrinho"></div>

                                    <h3>Frete</h3>

                                    <div class="box-frete-carrinho">
                                        <ul>
                                            <li><input type="radio" id="html" name="fav_language" value="HTML"> Favorita - até 6 dias úteis <span>R$ 19,32</span></li>
                                            <li><input type="radio" id="html" name="fav_language" value="HTML"> Sedex - até 3 dias úteis <span>R$ 31,94</span></li>
                                            <li><input type="radio" id="html" name="fav_language" value="HTML"> Retirar na loja <span>Grátis</span></li>
                                        </ul>                                        
                                    </div>
                                    <!--/fim informação quando o usuário tiver feito o login -->                                
                                </div>
                                <!--/fim box endereço e frete -->
                                <!-- box produtos -->                                                                                 
                                <div class="cart__table box-carrinho">
                                    <table class="cart__table--inner">
                                        <thead class="cart__table--header">
                                            <tr class="cart__table--header__items">
                                                <th class="cart__table--header__list titulo-table-produtos-carrinho">Produto</th>
                                                <th class="cart__table--header__list">Preço</th>
                                                <th class="cart__table--header__list">Quantidade</th>
                                                <th class="cart__table--header__list">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="cart__table--body">
                                            <!-- 1 -->
                                            <tr class="cart__table--body__items">
                                                <td class="cart__table--body__list descricao-table-produtos-carrinho">
                                                    <div class="cart__product d-flex align-items-center">
                                                        <button class="cart__remove--btn" aria-label="search button" type="button">
                                                            <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="14px" height="16px"><path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/></svg>
                                                        </button>
                                                        <div class="cart__thumbnail">
                                                            <a href="<?= $path["site"] ?>produto"><img class="border-radius-5" src="<?= $path["site"] ?>assets/img/produtos/product1.png" alt="Nome do produto - Marca do produto - verik"></a>
                                                        </div>
                                                        <div class="cart__content">
                                                            <h4 class="cart__content--title"><a href="<?= $path["site"] ?>produto">Headset Gamer HyperX Cloud Stinger, Drivers 50mm, Múltiplas Plataformas, P2 e P3 - HX-HSCS-BK/NA</a></h4>
                                                            <span class="cart__content--variant">Caracteristicas 220V</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <span class="cart__price">R$ 42,86</span>
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <div class="quantity__box">
                                                        <button type="button" class="quantity__value quickview__value--quantity decrease" aria-label="quantity value" value="Decrease Value">-</button>
                                                        <label>
                                                            <input type="number" class="quantity__number quickview__value--number" value="1" data-counter/>
                                                        </label>
                                                        <button type="button" class="quantity__value quickview__value--quantity increase" aria-label="quantity value" value="Increase Value">+</button>
                                                    </div>
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <span class="cart__price end">R$ 1.500,00</span>
                                                </td>
                                            </tr>
                                            
                                            <!-- 1 -->
                                            <tr class="cart__table--body__items">
                                                <td class="cart__table--body__list descricao-table-produtos-carrinho">
                                                    <div class="cart__product d-flex align-items-center">
                                                        <button class="cart__remove--btn" aria-label="search button" type="button">
                                                            <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="14px" height="16px"><path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/></svg>
                                                        </button>
                                                        <div class="cart__thumbnail">
                                                            <a href="<?= $path["site"] ?>produto"><img class="border-radius-5" src="<?= $path["site"] ?>assets/img/produtos/product1.png" alt="Nome do produto - Marca do produto - verik"></a>
                                                        </div>
                                                        <div class="cart__content">
                                                            <h4 class="cart__content--title"><a href="<?= $path["site"] ?>produto">Headset Gamer HyperX Cloud Stinger, Drivers 50mm, Múltiplas Plataformas, P2 e P3 - HX-HSCS-BK/NA</a></h4>
                                                            <span class="cart__content--variant">Caracteristicas 220V</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <span class="cart__price">R$ 42,86</span>
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <div class="quantity__box">
                                                        <button type="button" class="quantity__value quickview__value--quantity decrease" aria-label="quantity value" value="Decrease Value">-</button>
                                                        <label>
                                                            <input type="number" class="quantity__number quickview__value--number" value="1" data-counter/>
                                                        </label>
                                                        <button type="button" class="quantity__value quickview__value--quantity increase" aria-label="quantity value" value="Increase Value">+</button>
                                                    </div>
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <span class="cart__price end">R$ 1.500,00</span>
                                                </td>
                                            </tr>
                                            
                                            <!-- 1 -->
                                            <tr class="cart__table--body__items">
                                                <td class="cart__table--body__list descricao-table-produtos-carrinho">
                                                    <div class="cart__product d-flex align-items-center">
                                                        <button class="cart__remove--btn" aria-label="search button" type="button">
                                                            <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="14px" height="16px"><path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/></svg>
                                                        </button>
                                                        <div class="cart__thumbnail">
                                                            <a href="<?= $path["site"] ?>produto"><img class="border-radius-5" src="<?= $path["site"] ?>assets/img/produtos/product1.png" alt="Nome do produto - Marca do produto - verik"></a>
                                                        </div>
                                                        <div class="cart__content">
                                                            <h4 class="cart__content--title"><a href="<?= $path["site"] ?>produto">Headset Gamer HyperX Cloud Stinger, Drivers 50mm, Múltiplas Plataformas, P2 e P3 - HX-HSCS-BK/NA</a></h4>
                                                            <span class="cart__content--variant">Caracteristicas 220V</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <span class="cart__price">R$ 42,86</span>
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <div class="quantity__box">
                                                        <button type="button" class="quantity__value quickview__value--quantity decrease" aria-label="quantity value" value="Decrease Value">-</button>
                                                        <label>
                                                            <input type="number" class="quantity__number quickview__value--number" value="1" data-counter/>
                                                        </label>
                                                        <button type="button" class="quantity__value quickview__value--quantity increase" aria-label="quantity value" value="Increase Value">+</button>
                                                    </div>
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
                                    <div class="coupon__code mb-30">
                                        <h3 class="coupon__code--title">Cupom de desconto</h3>
                                        <div class="coupon__code--field d-flex">
                                            <label>
                                                <input class="coupon__code--field__input border-radius-5" placeholder="Digite..." type="text">
                                            </label>
                                            <button class="coupon__code--field__btn primary__btn" type="submit">Aplicar Cupom</button>
                                        </div>
                                    </div>                                    
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
                                                    <td class="cart__summary--total__title text-left">Total:</td>
                                                    <td class="cart__summary--amount text-right">R$ 1.511.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="cart__summary--footer">
                                        <ul>
                                            
                                            <li>                                                
                                                <a class="btn-pagamento-carrinho" href="<?= $path["site"] ?>pagamento">
                                                    IR PARA O PAGAMENTO
                                                </a>                                            
                                            </li>
                                            <li>
                                                <a class="btn-continuar-comprando-carrinho" href="<?= $path["site"] ?>busca">
                                                    CONTINUAR COMPRANDO
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
