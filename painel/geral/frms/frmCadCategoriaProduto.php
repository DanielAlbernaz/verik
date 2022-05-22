<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar Categorias Produto';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=categoriaproduto';
$avisodoformulario = 'Esta página você cadastra as categoria.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Categoria','nome','',true,'Aqui você um titulo para o categoria.');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.');

//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>