    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Informações serviços conta corrente';
$acaodoformulario = 'index.php?acao=alterar&ctrl=servicos_conta_corrente';
$avisodoformulario = 'Esta página você altera as Informações de serviços conta corrente';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text

$objForm->sk_formText('Título','titulo','',true,'Aqui digita um título.', $servicosContaCorrenteForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.', $servicosContaCorrenteForm->texto);


//Cria um input hidden
$objForm->sk_formHidden('id',$servicosContaCorrenteForm->id);


//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>