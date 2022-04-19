
<?php

//Informações do Formalário
$nomedoformulario = 'Alterar Serviço';
$acaodoformulario = 'index.php?acao=alterar&ctrl=servico';
$avisodoformulario = 'Esta página você altera os serviços cadastrados.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario, $acaodoformulario, $avisodoformulario);

//Cria um input text

$objForm->sk_formText('Titulo','titulo','',true,'Aqui você altera o titulo.',$servicoForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',false,'Aqui você alterar o texto.',$servicoForm->texto);

//Cria um input hidden
$objForm->sk_formHidden('id', $servicoForm->id);

//Verfica se o usuário e Administrador
if ($permissao->alterar == 1) {
	//Cria um input submit
	$objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>