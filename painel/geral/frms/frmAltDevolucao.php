    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Informações';
$acaodoformulario = 'index.php?acao=alterar&ctrl=devolucao';
$avisodoformulario = 'Esta página você altera as Informações';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text

$objForm->sk_formText('Título','titulo','',true,'Aqui digita um título.', $devolucaoForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.', $devolucaoForm->texto);


//Cria um input hidden
$objForm->sk_formHidden('id',$devolucaoForm->id);


//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>