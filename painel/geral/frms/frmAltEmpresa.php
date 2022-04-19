
<?php

//Informações do Formalário
$nomedoformulario = 'Alterar Quem Somos';
$acaodoformulario = 'index.php?acao=alterar&ctrl=empresa';
$avisodoformulario = 'Esta página você altera as informações do quem somos.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario, $acaodoformulario, $avisodoformulario);

//Cria um input text

$objForm->sk_formText('Titulo','titulo','',true,'Aqui você altera o titulo.',$empresaForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',false,'Aqui você alterar o texto.',$empresaForm->texto);

$objForm->sk_formFile("Imagem",'imagem',false,'Tamanho 501px x 334px',$empresaForm->imagem);

$objForm->sk_formTextUrl('Link vídeo','video','',false,'Informe o link para o vídeo.', $empresaForm->video);

//Cria um input hidden
$objForm->sk_formHidden('id',$empresaForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$empresaForm->imagem);

//Verfica se o usuário e Administrador
if ($permissao->alterar == 1) {
	//Cria um input submit
	$objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>