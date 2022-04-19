<?php

//Informações do Formalário
$nomedoformulario = 'Cadastrar Quem Somos';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=empresa';
$avisodoformulario = 'Esta página você cadastra o quem somos.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario, $acaodoformulario, $avisodoformulario);

//Cria um input text
$objForm->sk_formText('Título','titulo','',true,'Aqui você coloca o titulo.');

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.');

$objForm->sk_formFile("Imagem",'imagem',false,'Tamanho 501px x 334px');

$objForm->sk_formTextUrl('Link vídeo' ,'video','',false,'Informe o link para o vídeo.');

//Verfica se o usuário e Administrador
if ($permissao->cadastrar == 1) {
	//Cria um input submit
	$objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>