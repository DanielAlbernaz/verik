<?php

//Informações do Formalário
$nomedoformulario = 'Cadastrar Redes Sociais';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=social';
$avisodoformulario = 'Esta página você cadastra as Redes Sociais do site.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario, $acaodoformulario, $avisodoformulario);

//Cria um input text

$objForm->sk_formText('Título','titulo','',true,'Aqui você coloca o titulo.');

$objForm->sk_formTextUrl('Link','url','',true,'Aqui você coloca o link.');

$objForm->sk_formText('Icone','icone','',true,'Aqui você coloca o icone da rede social.');

//Verfica se o usuário e Administrador
if ($permissao->cadastrar == 1) {
	//Cria um input submit
	$objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>