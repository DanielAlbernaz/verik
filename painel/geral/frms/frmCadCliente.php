<?php

//Informações do Formalário
$nomedoformulario = 'Cadastrar Clientes';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=cliente';
$avisodoformulario = 'Esta página você cadastra os clientes.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Nome','nome','',true,'Aqui você o nome do cliente.');

$objForm->sk_formTextCNPJ('CNPJ','cnpj','',true,'Aqui você coloca o CNPJ.');

$objForm->sk_formTextEmail('E-mail','email','',true,'E-mail do cliente.');

$objForm->sk_formTextTelefone('Telefone','telefone','',true,'Aqui você coloca o telefone.');

//Cria um input text
$objForm->sk_formTextPassword('Senha','senha','',true,'Senha do cliente.');


//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>