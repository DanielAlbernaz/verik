<?php	include("header.php");?>

    <main class="main__content_wrapper">
        
        <!-- Inicio breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Quero me cadastrar</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="<?= $path["site"] ?>">Página inicial</a></li>
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="<?= $path["site"] ?>login">Login</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Quero me cadastrar</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/fim breadcrumb section -->

        <div class="login__section section--padding">
            <div class="container">
                <form id="frmCadastroUsurio" action="javascript:;" method="POST">
                    <div class="login__section--inner">
                        <div class="row row-cols-md-2 row-cols-1">
                            <div class="col box-login">
                                <div class="account__login">
                                    <div class="account__login--header mb-25">
                                        <h2 class="account__login--header__title h3 mb-10">Criar seu cadastro</h2>
                                        <p class="account__login--header__desc">Veja seus pedidos de forma fácil, compre mais rápido e tenha uma experiência personalizada :)</p>
                                    </div>
                                    <div class="account__login--inner">
                                        <input class="account__login--input validate[required,custom[email]" onblur="validaEmail()" id="email" name="email" placeholder="E-mail" type="text" required>
                                        <p id="valida_email"></p>

                                        <input class="account__login--input" placeholder="Crie sua senha" id="senha" name="senha" required type="password">

                                        <input class="account__login--input" placeholder="Confirme a senha" onblur="validaSenha()" id="confirmar_senha" name="confirmar_senha" required type="password">
                                        <p id="erro_senha"></p>

                                        <input class="account__login--input" placeholder="CPF ou CNPJ" mask-input="cpfCnpj" onblur="validaCpfCnpj(), VerificaCpf() " name="cpfCnpj" id="cpfCnpj" type="text">
                                        <p id="erro_cpfCnpj"></p>
                                        <div id="tipo_pessoa_valida"></div>
                                        <p id="valida_cpf"></p>

                                        <input class="account__login--input" placeholder="CEP" mask-input=cep id="cep" onblur="validaCep()" name="cep" type="text">
                                        <p id="erro_cep"></p>

                                        <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                            <div class="account__login--remember position__relative">
                                                <input class="checkout__checkbox--input" id="checkCiente" type="checkbox">
                                                <span class="checkout__checkbox--checkmark"></span>
                                                <label class="checkout__checkbox--label login__remember--label" for="checkCiente">Estou ciente do termo de uso.</label>
                                            </div>
                                        </div>
                                        <button class="account__login--btn login__btn" type="submit" id="botao_cadastrar">Cadastrar</button>
                                        <p class="account__login--signup__text login-m20-top">Já tem uma conta ? <a href="<?= $path["site"] ?>login">Faça seu login</a></p>
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