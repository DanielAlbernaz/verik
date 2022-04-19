    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Informações de termo de uso';
$acaodoformulario = 'index.php?acao=alterar&ctrl=termo';
$avisodoformulario = 'Esta página você altera as Informações de termo de uso';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text

$objForm->sk_formText('Título','titulo','',true,'Aqui digita um título.', $termoForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.', $termoForm->texto);


//Cria um input hidden
$objForm->sk_formHidden('id',$termoForm->id);


//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>