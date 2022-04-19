
<?php

//Informações do Formalário
$nomedoformulario = 'Alterar links apps';
$acaodoformulario = 'index.php?acao=alterar&ctrl=link_app';
$avisodoformulario = 'Esta página você altera os links apps.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario, $acaodoformulario, $avisodoformulario);

$objForm->sk_formText('Titulo','titulo','',true,'Aqui você altera o titulo.',$linksForm->titulo);

$objForm->sk_formTextUrl('Link','url','',true,'Aqui você altera o link.',$linksForm->url);


//Cria um input hidden
$objForm->sk_formHidden('id', $linksForm->id);

//Verfica se o usuário e Administrador
if ($permissao->alterar == 1) {
	//Cria um input submit
	$objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>