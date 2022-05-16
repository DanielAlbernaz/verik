<?php	include("cHeader.php");?>
<main class="main__content_wrapper">                
        
    <!-- Barra de progresso -->
    <section class="breadcrumb__section ocultar-mobile">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-2 barra-progresso-circular">                    
                        <div class="progress-circle over50 p66">
                            <span>60%</span>
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
                    <h2 class="titulo-pagamento-carrinho"><i class="far fa-shopping-cart"></i> Forma de pagamento</h2>
                    <div class="tab">
                        <a class="tablinks" onclick="openCity(event, 'Pix')" id="defaultOpen">PIX</a>
                        <a class="tablinks" onclick="openCity(event, 'Boleto')"><i class="fas fa-barcode-alt"></i> BOLETO BANCÁRIO</a>
                        <a class="tablinks" onclick="openCity(event, 'Debito')"><i class="fas fa-credit-card-blank"></i> CARTÃO DE DÉBITO</a>
                        <a class="tablinks" onclick="openCity(event, 'Credito')"><i class="fas fa-credit-card-front"></i> CARTÃO DE CRÉDITO</a>
                    </div>

                    <div id="Pix" class="tabcontent">
                        <h3>Pix</h3>
                        <p>
                            <strong>A melhor opção para suas compras à vista</strong><br/><br/>
                            O que você precisa saber antes de pagar por PIX:

                            É necessário possuir uma chave PIX cadastrada no seu Banco;<br/>
                            Com o seu celular, basta escanear o QR Code ou copiar o código para efetivar a compra;<br/>
                            O pagamento é processado e debitado do valor em sua conta corrente;<br/>
                            Como padrão, o Banco Central limitou os pagamentos no período das 20h às 06h, a valores de até R$1.000. Mas você pode solicitar o aumento do limite deste período diretamente com o seu banco, pela Central de Atendimento ou APP. O prazo de liberação é de até 48h.
                        </p>
                        <div class="row">
                            <div class="col-12 col-md-12 box-valor-pagamento-carrinho">
                                <h4>TOTAL DA SUA COMPRA: R$ 1.553,85</h4>
                            </div> 
                            <div class="col-12 col-md-6">

                            </div> 
                            <div class="col-12 col-md-3">
                                <a class="btn-continuar-comprando-carrinho mob-esp-mb-20" href="<?= $path["site"] ?>carrinho">
                                    VOLTAR
                                </a>
                            </div> 
                            <div class="col-12 col-md-3">
                                <a class="btn-pagamento-carrinho" href="<?= $path["site"] ?>confirmacao">
                                    PAGAR COM PIX
                                </a> 
                            </div> 
                        </div>
                    </div>

                    <div id="Boleto" class="tabcontent">
                        <h3>Boleto Bancário</h3>
                        <p>
                            Boleto tem até 15% de desconto* na compra e é a forma de pagamento que recebe o maior desconto sob o valor total da compra. Esta é a forma mais vantajosa para quem deseja pagar à vista. Você poderá efetuar o pagamento do boleto em qualquer Banco ou Casa Lotérica em qualquer lugar do Brasil, sem necessidade de confirmação do pagamento. *O desconto poderá ser concedido ou não até o limite de 15%, podendo ser menor ou zero, de acordo com o detalhado nas descrições do produto e só será aplicado às vendas diretas e entregues pelo Verik, não se aplicando aos produtos de Marketplace.
                        </p>
                        <div class="row">
                            <div class="col-12 col-md-12 box-valor-pagamento-carrinho">
                                <h4>TOTAL DA SUA COMPRA: R$ 1.553,85</h4>
                            </div> 
                            <div class="col-12 col-md-6"></div> 
                            <div class="col-12 col-md-3">
                                <a class="btn-continuar-comprando-carrinho mob-esp-mb-20" href="<?= $path["site"] ?>carrinho">
                                    VOLTAR
                                </a>
                            </div> 
                            <div class="col-12 col-md-3">
                                <a class="btn-pagamento-carrinho" href="<?= $path["site"] ?>confirmacao">
                                    PAGAR COM BOLETO
                                </a> 
                            </div> 
                        </div> 
                    </div>

                    <div id="Debito" class="tabcontent">
                        <h3>Cartão débito</h3>
                        <p>
                            <strong>À vista com até 10% de desconto* ou tudo em até 10x sem juros!</strong><br/>
                            A Verik aceita as bandeiras de cartão VISA, MasterCard, ELO, HiperCard, American Express e Diners - Todos em até 10x sem juros ou com desconto em até 3x!<br/>
                            *O desconto poderá ser concedido ou não até o limite de 10%, podendo ser menor ou zero, de acordo com o detalhado nas descrições do produto e só será aplicado às vendas diretas e entregues pela Verik.
                        </p>
                        <!-- CARTÕES SALVOS -->
                        <div class="section__header mb-25">
                            <h3 class="section__header--title"><i class="fas fa-credit-card"></i> Cartões salvos</h3>
                        </div>
                        <div class="checkout__content--step checkout__contact--information2 border-radius-5">                            
                            <div class="checkout__review d-flex justify-content-between align-items-center">
                                <div class="checkout__review--inner d-flex align-items-center">
                                    <label class="checkout__review--label"><input class="shipping__radio--input__field" id="radiobox" name="checkmethod" type="radio"> Cartão Visa</label>
                                    <span class="checkout__review--content">5226 **** **** ****</span>
                                </div>
                                <div class="checkout__review--link">
                                    <button class="checkout__review--link__text" type="button"><i class="far fa-trash-alt"></i> Remover cartão</button>
                                </div>
                            </div> 
                            <div class="checkout__review d-flex justify-content-between align-items-center">
                                <div class="checkout__review--inner d-flex align-items-center">
                                <label class="checkout__review--label"><input class="shipping__radio--input__field" id="radiobox" name="checkmethod" type="radio"> Cartão Master</label>
                                    <span class="checkout__review--content">5206 **** **** ****</span>
                                </div>
                                <div class="checkout__review--link">
                                    <button class="checkout__review--link__text" type="button"><i class="far fa-trash-alt"></i> Remover cartão</button>  
                                </div>
                            </div>
                            <div class="checkout__review d-flex justify-content-between align-items-center">
                                <div class="checkout__review--inner d-flex align-items-center">
                                <label class="checkout__review--label"><input class="shipping__radio--input__field" id="radiobox" name="checkmethod" type="radio"> Cartão Virtual</label>
                                    <span class="checkout__review--content">5236 **** **** ****</span>
                                </div>
                                <div class="checkout__review--link">
                                    <button class="checkout__review--link__text" type="button"><i class="far fa-trash-alt"></i> Remover cartão</button>   
                                </div>
                            </div>
                        </div>
                        <!--/FIM CARTÕES SALVOS -->
                        
                        <!-- INFORMAÇÕES DO CARTÃO -->
                        <div class="checkout__content--step section__shipping--address">
                            <div class="section__header mb-25">
                                <h3 class="section__header--title"><i class="fas fa-credit-card"></i> Novo cartão de débito</h3>
                            </div>
                            <div class="checkout__content--step__inner3 border-radius-5">
                                <div class="checkout__address--content__header d-flex align-items-center justify-content-between">
                                    <span class="checkout__address--content__title">Informações do cartão</span>
                                    <span class="heckout__address--content__icon"><i class="fal fa-credit-card"></i></span>
                                </div>
                                <div class="checkout__content--input__box--wrapper ">
                                    <div class="row">
                                        <div class="col-12 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Nome impresso no cartão"  type="text">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-12">
                                            <div class="checkout__input--list position__relative">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Número do cartão"  type="text">
                                                </label>
                                                <button class="checkout__input--field__button" type="button">
                                                    
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.51" height="15.443" viewBox="0 0 512 512"><path d="M336 208v-95a80 80 0 00-160 0v95" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><rect x="96" y="208" width="320" height="272" rx="48" ry="48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Validade (MÊS / ANO)"  type="text">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-12">
                                            <div class="checkout__input--list position__relative">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Código de verificação (CVV)"  type="text">
                                                </label>                                                    
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="CPF do titular do cartão"  type="text">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Data de nascimento"  type="text">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-12">
                                            <div class="checkout__input--list checkout__input--select select">
                                                <label class="checkout__select--label" for="country">Forma de pagamento*</label>
                                                <select class="checkout__input--select__field border-radius-5" id="country">
                                                    <option value="1">À vista - R$ 1.400,92</option>                                                        
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6"></div> 
                                        <div class="col-12 col-md-3">
                                            <a class="btn-continuar-comprando-carrinho mob-esp-mb-20" href="<?= $path["site"] ?>carrinho">
                                                VOLTAR
                                            </a>
                                        </div> 
                                        <div class="col-12 col-md-3">
                                            <a class="btn-pagamento-carrinho" href="<?= $path["site"] ?>confirmacao">
                                                PAGAR COM CARTÃO
                                            </a> 
                                        </div> 

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/fim INFORMAÇÕES DO CARTÃO -->
                    </div>

                    <div id="Credito" class="tabcontent">
                        <h3>Cartão de crédito</h3>
                        <p>
                            <strong>À vista com até 10% de desconto* ou tudo em até 10x sem juros!</strong><br/>
                            A Verik aceita as bandeiras de cartão VISA, MasterCard, ELO, HiperCard, American Express e Diners - Todos em até 10x sem juros ou com desconto em até 3x!<br/>
                            *O desconto poderá ser concedido ou não até o limite de 10%, podendo ser menor ou zero, de acordo com o detalhado nas descrições do produto e só será aplicado às vendas diretas e entregues pela Verik.
                        </p>
                        <!-- CARTÕES SALVOS -->
                        <div class="section__header mb-25">
                            <h3 class="section__header--title"><i class="fas fa-credit-card"></i> Cartões salvos</h3>
                        </div>
                        <div class="checkout__content--step checkout__contact--information2 border-radius-5">                            
                            <div class="checkout__review d-flex justify-content-between align-items-center">
                                <div class="checkout__review--inner d-flex align-items-center">
                                    <label class="checkout__review--label"><input class="shipping__radio--input__field" id="radiobox" name="checkmethod" type="radio"> Cartão Visa</label>
                                    <span class="checkout__review--content">5226 **** **** ****</span>
                                </div>
                                <div class="checkout__review--link">
                                    <button class="checkout__review--link__text" type="button"><i class="far fa-trash-alt"></i> Remover cartão</button>
                                </div>
                            </div> 
                            <div class="checkout__review d-flex justify-content-between align-items-center">
                                <div class="checkout__review--inner d-flex align-items-center">
                                <label class="checkout__review--label"><input class="shipping__radio--input__field" id="radiobox" name="checkmethod" type="radio"> Cartão Master</label>
                                    <span class="checkout__review--content">5206 **** **** ****</span>
                                </div>
                                <div class="checkout__review--link">
                                    <button class="checkout__review--link__text" type="button"><i class="far fa-trash-alt"></i> Remover cartão</button>  
                                </div>
                            </div>
                            <div class="checkout__review d-flex justify-content-between align-items-center">
                                <div class="checkout__review--inner d-flex align-items-center">
                                <label class="checkout__review--label"><input class="shipping__radio--input__field" id="radiobox" name="checkmethod" type="radio"> Cartão Virtual</label>
                                    <span class="checkout__review--content">5236 **** **** ****</span>
                                </div>
                                <div class="checkout__review--link">
                                    <button class="checkout__review--link__text" type="button"><i class="far fa-trash-alt"></i> Remover cartão</button>   
                                </div>
                            </div>
                        </div>
                        <!--/FIM CARTÕES SALVOS -->
                        
                        <!-- INFORMAÇÕES DO CARTÃO -->
                        <div class="checkout__content--step section__shipping--address">
                            <div class="section__header mb-25">
                                <h3 class="section__header--title"><i class="fas fa-credit-card"></i> Novo cartão de débito</h3>
                            </div>
                            <div class="checkout__content--step__inner3 border-radius-5">
                                <div class="checkout__address--content__header d-flex align-items-center justify-content-between">
                                    <span class="checkout__address--content__title">Informações do cartão</span>
                                    <span class="heckout__address--content__icon"><i class="fal fa-credit-card"></i></span>
                                </div>
                                <div class="checkout__content--input__box--wrapper ">
                                    <div class="row">
                                        <div class="col-12 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Nome impresso no cartão"  type="text">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-12">
                                            <div class="checkout__input--list position__relative">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Número do cartão"  type="text">
                                                </label>
                                                <button class="checkout__input--field__button" type="button">
                                                    
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.51" height="15.443" viewBox="0 0 512 512"><path d="M336 208v-95a80 80 0 00-160 0v95" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><rect x="96" y="208" width="320" height="272" rx="48" ry="48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Validade (MÊS / ANO)"  type="text">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-12">
                                            <div class="checkout__input--list position__relative">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Código de verificação (CVV)"  type="text">
                                                </label>                                                    
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="CPF do titular do cartão"  type="text">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Data de nascimento"  type="text">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-12">
                                            <div class="checkout__input--list checkout__input--select select">
                                                <label class="checkout__select--label" for="country">Forma de pagamento*</label>
                                                <select class="checkout__input--select__field border-radius-5" id="country">
                                                    <option value="1">À vista - R$ 1.400,92</option>                                                        
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6"></div> 
                                        <div class="col-12 col-md-3">
                                            <a class="btn-continuar-comprando-carrinho mob-esp-mb-20" href="<?= $path["site"] ?>carrinho">
                                                VOLTAR
                                            </a>
                                        </div> 
                                        <div class="col-12 col-md-3">
                                            <a class="btn-pagamento-carrinho" href="<?= $path["site"] ?>confirmacao">
                                                PAGAR COM CARTÃO
                                            </a> 
                                        </div> 

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/fim INFORMAÇÕES DO CARTÃO -->
                    </div>

                    <div style="clear:both"></div>
            </div>     
        </section>
        <!-- cart section end -->
    </main>    
<?php	include("cFooter.php");?>
<script>
    function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
