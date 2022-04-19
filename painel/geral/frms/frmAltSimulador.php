    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar o simulador financeiro';
$acaodoformulario = 'index.php?acao=alterar&ctrl=simulador';
$avisodoformulario = 'Esta página você altera os simuladores financeiros.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Titulo','titulo','',false,'Aqui você altera o titulo.',$simuladorForm->titulo);

$objForm->sk_formText('Simulador','url','',false,'Aqui você altera o link.',$simuladorForm->url);

$objForm->sk_formFile("Imagem",'imagem',false,'Tamanho 247px x 76px',$simuladorForm->imagem);

//Cria um input hidden
$objForm->sk_formHidden('id',$simuladorForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$simuladorForm->imagem);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>