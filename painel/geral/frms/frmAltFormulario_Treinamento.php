    
<?php
//Informações do Formalário
$nomedoformulario = 'Alterar Informações do formulário de treinamento';
$acaodoformulario = 'index.php?acao=alterar&ctrl=formulario_treinamento';
$avisodoformulario = 'Esta página você altera as informações do formulário de treinamento';


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