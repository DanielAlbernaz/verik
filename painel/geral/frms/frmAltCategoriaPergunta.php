    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Categoria';
$acaodoformulario = 'index.php?acao=alterar&ctrl=categoriapergunta';
$avisodoformulario = 'Esta página você altera as categorias cadastradas';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Categoria','nome','',true,'Aqui você um titulo para o categoria.',$categoriaForm->nome);

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($categoriaForm->dhcadastro));


//Cria um input hidden
$objForm->sk_formHidden('id',$categoriaForm->id);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>