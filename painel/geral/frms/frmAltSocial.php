
<?php

//Informações do Formalário
$nomedoformulario = 'Alterar Redes Sociais';
$acaodoformulario = 'index.php?acao=alterar&ctrl=social';
$avisodoformulario = 'Esta página você altera as Redes Sociais cadastradas.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario, $acaodoformulario, $avisodoformulario);

//Cria um input text

$objForm->sk_formText('Titulo','titulo','',true,'Aqui você altera o titulo.',$socialForm->titulo);

$objForm->sk_formTextUrl('Link','url','',true,'Aqui você altera o link.',$socialForm->url);

$objForm->sk_formText('Icone','icone','',true,'Aqui você altera o icone.',$socialForm->icone);


//Cria um input hidden
$objForm->sk_formHidden('id', $socialForm->id);

//Verfica se o usuário e Administrador
if ($permissao->alterar == 1) {
	//Cria um input submit
	$objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>