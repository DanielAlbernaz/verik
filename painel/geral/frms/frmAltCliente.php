    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Cliente';
$acaodoformulario = 'index.php?acao=alterar&ctrl=cliente';
$avisodoformulario = 'Esta página você altera o cliente cadastrado.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Nome','nome','',true,'Aqui você o nome do cliente.',$clienteForm->nome);

$objForm->sk_formTextCNPJ('CNPJ','cnpj','',false,'Aqui você alterar o CNPJ da empresa.',$clienteForm->cnpj);

$objForm->sk_formTextEmail('E-mail','email','',true,'Aqui você alterar o e-mail.',$clienteForm->email);

$objForm->sk_formTextTelefone('Telefone','telefone','',false,'Aqui você o telefone cliente.',$clienteForm->telefone);

$objForm->sk_formTextPassword('Senha','senha','',false,'Aqui você alterar a senha.');


//Cria um input hidden
$objForm->sk_formHidden('id',$clienteForm->id);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>